<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 02-Jun-2021
 */
class ProductRepository extends GenericRepository {

    public function __construct() {
        parent::__construct();
    }

    public function deleteById($id) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();


        try {
            $sql = "DELETE FROM product WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, 
                    "Could not deleted product ID = " . $id);

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
            $sql = "SELECT * FROM product";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $products = null;
            }

            $products = array();
            
            while ($product = $result->fetch_assoc()) {
                array_push($products, $product);
            }
            
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $products;
    }

    public function findByDesignation(string $designation) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM product WHERE designation = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("s", $designation);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $product = null;
            }

            $product = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $product;
    }

    public function findById($id) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM product WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $product = null;
            }

            $product = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $product;
    }

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof Product)) {
            return "Unexpected type passed as param, while waiting to receive"
                    . " a Product instance!";
        }

        $designation = $object->getDesignation();
        $unit = $object->getUnit();
        $price = $object->getPrice();
        $totalQuantity = $object->getTotalQuantity();

        try {
            $sql = "INSERT INTO product ";
            $sql .= "(designation, measure_unit, price, current_totalQuantity) ";
            $sql .= "VALUES (?,?,?,?)";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ssdd", $designation, $unit, $price, $totalQuantity);
            $preparedStatement->execute();

            $connection->commit();

            $product = $this->getInsertion($preparedStatement->insert_id);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $product;
    }

    public function update($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof Product)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "Product instance";
        }

        $id = $object->getId();
        $designation = $object->getDesignation();
        $unit = $object->getUnit();
        $price = $object->getPrice();
        $totalQuantity = $object->getTotalQuantity();

        try {
            $sql = "UPDATE product SET designation = ?, measure_unit = ?, ";
            $sql .= "price = ?, current_totalQuantity = ? WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ssddi", $designation, $unit, $price, $totalQuantity, $id);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
                $product = null;
            }

            $product = $this->findById($object->getId());
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $product;
    }
}
