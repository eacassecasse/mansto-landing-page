<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StorageRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 03-Jun-2021
 */
class StorageRepository extends GenericRepository {

    public function __construct() {
        parent::__construct();
    }

    public function deleteById($id) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        try {

            $sql = "DELETE FROM storage WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not delete Storage ID = " . $id);

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
            $sql = "SELECT * FROM storage";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $storages = null;
            }

            $storages = array();
            while ($storage = $result->fetch_assoc()) {
                array_push($storages, $storage);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storages;
    }

    public function findByCode(string $code) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM storage WHERE code = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("s", $code);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $storage = null;
            }

            $storage = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storage;
    }

    public function findById($id) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM storage WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $storage = null;
            }

            $storage = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storage;
    }

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof Storage)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "a Storage instance!";
        }

        $designation = $object->getDesignation();
        $code = $object->getCode();

        try {
            $sql = "INSERT INTO storage(designation, code) VALUES (?,?)";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ss", $designation, $code);
            $preparedStatement->execute();

            $connection->commit();

            $storage = $this->getInsertion($preparedStatement->insert_id);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storage;
    }

    public function update($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();


        if (!($object instanceof Storage)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "Storage instance!";
        }

        $id = $object->getId();
        $designation = $object->getDesignation();
        $code = $object->getCode();

        try {
            $sql = "UPDATE storage SET designation = ?, code = ? WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ssi", $designation, $code, $id);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
                $storage = null;
            }

            $storage = $this->findById($object->getId());
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $storage;
    }

}
