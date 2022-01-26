<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 02-Jun-2021
 */
class SupplierRepository extends GenericRepository {

    public function __construct() {
        parent::__construct();
    }

    public function deleteById($id) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        try {
            $sql = "DELETE FROM supplier WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not delete Supplier ID = " . $id);

            return true;
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }
    }

    public function findAll() {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM supplier";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $suppliers = null;
            }

            $suppliers = array();
            while ($supplier = $result->fetch_assoc()) {
                array_push($suppliers, $supplier);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $suppliers;
    }

    public function findById($id) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM supplier WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $supplier = null;
            }

            $supplier = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplier;
    }

    public function findByVatNumber($vatNumber) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM supplier WHERE vatNumber = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $vatNumber);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $supplier = null;
            }

            $supplier = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplier;
    }

    public function findByName(string $name) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM supplier WHERE name = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("s", $name);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $supplier = null;
            }

            $supplier = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplier;
    }

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof Supplier)) {
            return "Unexpected type passed as param, while waiting to receive"
                    . " a Supplier instance!";
        }

        $name = $object->getName();
        $vatNumber = $object->getVatNumber();

        try {
            $sql = "INSERT INTO supplier (name, vatNumber) VALUES (?,?)";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("si", $name, $vatNumber);
            $preparedStatement->execute();

            $connection->commit();

            $supplier = $this->getInsertion($preparedStatement->insert_id);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplier;
    }

    public function update($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof Supplier)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "Supplier instance";
        }

        $id = $object->getId();
        $name = $object->getName();
        $vatNumber = $object->getVatNumber();

        try {
            $sql = "UPDATE supplier SET name = ?, vatNumber = ? WHERE id = ? ";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("sii", $name, $vatNumber, $id);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
                $supplier = null;
            }

            $supplier = $this->findById($object->getId());
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplier;
    }

}
