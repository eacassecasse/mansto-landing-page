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
class StoredProductRepository {

    private $factory;

    public function __construct() {
        $this->factory = new ConnectionFactory();
    }

    private function connect(): mysqli {

        $connection = $this->factory->build();

        if ($connection->connect_errno) {

            throw new ConnectionException("An Error occured when trying to "
            . "connect to database. \n"
            . "Please contact your Administrator");
        }

        return $connection;
    }

    private function getInsertion(int $inserted_product_id, int $inserted_storage_id) {
        $product = new Product();
        $product->setId($inserted_product_id);

        $storage = new Storage();
        $storage->setId($inserted_storage_id);

        $stored = new StoredProduct();
        $stored->setProduct($product);
        $stored->setStorage($storage);

        return $this->findOnStorage($stored);
    }

    private function checkRows(int $size, string $message) {
        if ($size === 0) {
            throw new Exception($message);
        }
    }

    public function deleteByProduct(StoredProduct $storedProduct) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        $productId = $storedProduct->getProduct()->getId();

        try {
            $sql = "DELETE FROM stored_products WHERE product_id = ?";


            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $productId);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not delete Stored Product ID = " . $productId);

            return true;
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
    }

    public function deleteFromStorage(StoredProduct $storedProduct) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        $productId = $storedProduct->getProduct()->getId();
        $storageId = $storedProduct->getStorage()->getId();

        try {
            $sql = "DELETE FROM stored_products WHERE product_id = ? AND storage_id = ?";


            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ii", $productId, $storageId);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not "
                    . "delete Stored Product ID = " . $productId
                    . " From Storage ID = " . $storageId);

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

    public function findByProduct(StoredProduct $stoProduct) {

        $connection = $this->connect();
        $productId = $stoProduct->getProduct()->getId();

        try {
            $sql = "SELECT * FROM stored_products WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $productId);
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

    public function findByStorage(StoredProduct $stoProduct) {

        $connection = $this->connect();

        $storageId = $stoProduct->getStorage()->getId();
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

    public function findOnStorage(StoredProduct $stoProduct) {

        $connection = $this->connect();

        $productId = $stoProduct->getProduct()->getId();
        $storageId = $stoProduct->getStorage()->getId();

        try {
            $sql = "SELECT * FROM stored_products WHERE product_id = ? AND storage_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ii", $productId, $storageId);
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

            $storedProduct = $this->getInsertion($productId, $storageId);
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
            $sql = "UPDATE stored_products SET quantity = ? ";
            $sql .= "WHERE product_id = ? AND storage_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("dii", $quantity, $productId, $storageId);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
                $storedProduct = null;
            }

            $storedProduct = $this->findOnStorage($object);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storedProduct;
    }

}
