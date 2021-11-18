<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierPriceRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 03-Jun-2021
 */
class SupplierPriceRepository extends GenericRepository {

    public function __construct() {
        parent::__construct();
    }

    public function deleteById($id) {
        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        try {
            $sql = "DELETE FROM supplier_prices WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not delete Price ID = " . $id);

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
            $sql = "SELECT * FROM supplier_prices";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $prices = null;
            }

            $prices = array();
            while ($price = $result->fetch_assoc()) {
                array_push($prices, $price);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $prices;
    }

    public function findByActiveDate(DateTime $activeDate) {

        $connection = $this->connect();

        $datetime = date('Y-m-d H:i:s', $activeDate->getTimestamp());

        try {
            $sql = "SELECT * FROM supplier_prices WHERE entrance_date = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("s", $datetime);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $prices = null;
            }

            $prices = array();
            
            while ($price = $result->fetch_assoc()) {
                array_push($prices, $price);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $prices;
    }

    public function findById($id) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM supplier_prices WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $price = null;
            }

            $price = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $price;
    }

    public function findBySupplier(Supplier $supplier) {

        $connection = $this->connect();

        $supplierId = $supplier->getId();
        
        try {
            $sql = "SELECT * FROM supplier_prices WHERE supplier_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $supplierId);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $supplierPrices = null;
            }

            $supplierPrices = array();
            while ($price = $result->fetch_assoc()) {
                array_push($supplierPrices, $price);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplierPrices;
    }

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof SupplierPrice)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "SupplierPrice instance!";
        }

        $productId = $object->getProduct()->getId();
        $supplierId = $object->getSupplier()->getId();
        $price = $object->getPrice();
        $entranceDate = date('Y-m-d H:i:s', $object->getActiveDate()->getTimestamp());

        try {
            $sql = "INSERT INTO supplier_prices";
            $sql .= "(product_id, supplier_id, price, entrance_date) VALUES ";
            $sql .= "(?,?,?,?)";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("iids", $productId, $supplierId, $price, $entranceDate);
            $preparedStatement->execute();

            $connection->commit();

            $supplierPrice = $this->getInsertion($preparedStatement->insert_id);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplierPrice;
    }

    public function update($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof SupplierPrice)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "SupplierPrice instance";
        }

        $id = $object->getId();
        $productId = $object->getProduct()->getId();
        $supplierId = $object->getSupplier()->getId();
        $price = $object->getPrice();
        $entranceDate = date('Y-m-d H:i:s', 
                $object->getActiveDate()->getTimestamp());

        try {
            $sql = "UPDATE supplier_prices SET price = ?, entrance_date = ? ";
            $sql .= "WHERE id = ? AND product_id = ? AND supplier_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("dsiii", $price, $entranceDate, $id, $productId, $supplierId);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
                $supplierPrice = null;
            }

            $supplierPrice = $this->findById($object->getId());
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplierPrice;
    }

}
