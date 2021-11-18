<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductValidityRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 03-Jun-2021
 */
class ProductValidityRepository extends GenericRepository {

    public function __construct() {
        parent::__construct();
    }

    public function deleteById($id) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        try {
            $sql = "DELETE FROM product_validities WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not delete Product Validity ID = " . $id);

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
            $sql = "SELECT * FROM product_validities";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $validities = null;
            }

            $validities = array();
            while ($validity = $result->fetch_assoc()) {
                array_push($validities, $validity);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $validities;
    }

    public function findByExpirationDate(DateTime $expirationDate) {

        $connection = $this->connect();
        
        $expireDate = date('Y-m-d H:i:s', $expirationDate->getTimestamp());

        try {
            $sql = "SELECT * FROM product_validities WHERE expiration_date = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("s", $expireDate);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $validity = null;
            }

            $validity = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw $exception;
        } finally {
            $preparedStatement->close();
        }

        return $validity;
    }

    public function findById($id) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM product_validities WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $validity = null;
            }

            $validity = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $validity;
    }

    public function findByProduct(Product $product) {

        $connection = $this->connect();
        $productId = $product->getId();

        try {
            $sql = "SELECT * FROM product_validities WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $productId);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $product_validities = null;
            }

            $product_validities = array();
            while ($validity = $result->fetch_assoc()) {
                array_push($product_validities, $validity);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $product_validities;
    }

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof ProductValidity)) {
            return "Unexpected type passed as param, while waiting to receive"
                    . " a ProductValidity instance!";
        }

        $productId = $object->getProduct()->getId();
        $expirationDate = date('Y-m-d H:i:s', $object->getExpirationDate()->getTimestamp());
        $quantity = $object->getQuantity();

        try {
            $sql = "INSERT INTO product_validities ";
            $sql .= "(product_id, expiration_date, quantity) ";
            $sql .= "VALUES (?,?,?)";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("isd", $productId, $expirationDate, $quantity);
            $preparedStatement->execute();

            $connection->commit();

            $validity = $this->getInsertion($preparedStatement->insert_id);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw $exception;
        } finally {
            $preparedStatement->close();
        }

        return $validity;
    }

    public function update($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof ProductValidity)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "ProductValidity instance";
        }

        $id = $object->getId();
        $productId = $object->getProduct()->getId();
        $expirationDate = date('Y-m-d H:i:s', $object->getExpirationDate()->getTimestamp());
        $quantity = $object->getQuantity();

        try {
            $sql = "UPDATE product_validities SET expiration_date = ?, ";
            $sql .= "quantity = ? WHERE id = ? AND product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("sdii", $expirationDate, $quantity, $id, $productId);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
                $validity = null;
            }

            $validity = $this->findById($object->getId());
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $validity;
    }

}
