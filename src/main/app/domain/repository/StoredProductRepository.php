<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StoredProductRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 03-Jun-2021
 */
class StoredProductRepository extends GenericRepository {

    public function __construct() {
        parent::__construct();
    }

    public function deleteById($id) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        try {
            $sql = "DELETE FROM stored_products WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not delete Stored Product ID = " . $id);

            return true;
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
    }

    public function findAll() {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM stored_products";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $storedProducts = null;
            }

            $storedProducts = array();
            while ($storedProduct = $result->fetch_assoc()) {
                array_push($storedProducts, $storedProduct);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storedProducts;
    }

    public function findById($id) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM stored_products WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $storedProduct = null;
            }

            $storedProduct = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
        return $storedProduct;
    }

    public function findByStorage(Storage $storage) {

        $connection = $this->connect();

        $storageId = $storage->getId();
        try {
            $sql = "SELECT * FROM stored_products WHERE storage_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $storageId);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $storedProducts = null;
            }

            $storedProducts = array();
            while ($storedProduct = $result->fetch_assoc()) {
                array_push($storedProducts, $storedProduct);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
        return $storedProducts;
    }

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof StoredProduct)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "StoredProduct instance!";
        }

        $productId = $object->getProduct()->getId();
        $storageId = $object->getStorage()->getId();
        $quantity = $object->getQuantity();

        try {
            $sql = "INSERT INTO stored_products ";
            $sql .= "(product_id, storage_id, quantity) VALUES (?,?,?)";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("iid", $productId, $storageId, $quantity);
            $preparedStatement->execute();

            $connection->commit();

            $storedProduct = $this->getInsertion($productId);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storedProduct;
    }

    public function update($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof StoredProduct)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "StoredProduct instance!";
        }

        $productId = $object->getProduct()->getId();
        $storageId = $object->getStorage()->getId();
        $quantity = $object->getQuantity();

        try {
            $sql = "UPDATE stored_products SET quantity = ?, storage_id = ? ";
            $sql .= "WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("dii", $quantity, $storageId, $productId);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
               $storedProduct = null; 
            }
            
            $storedProduct = $this->findById($productId);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storedProduct;
    }

}
