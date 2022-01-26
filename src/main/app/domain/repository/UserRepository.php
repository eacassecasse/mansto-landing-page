<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 08-Jun-2021
 */
class UserRepository extends GenericRepository {

    public function __construct() {
        parent::__construct();
    }

    public function deleteById($id) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();


        try {
            $sql = "DELETE FROM user WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not delete User ID = " . $id);

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
            $sql = "SELECT * FROM user";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $users = null;
            }

            $users = array();
            while ($user = $result->fetch_assoc()) {
                array_push($users, $user);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $users;
    }

    public function findByEmail(string $email) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE email = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("s", $email);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $user = null;
            }

            $user = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $user;
    }

    public function findById($id) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM user WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $user = null;
            }

            $user = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $user;
    }

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof User)) {
            return "Unexpected type passed as param, while waiting to receive"
                    . " a User instance!";
        }

        $email = $object->getEmail();
        $password = $object->getPassword();

        try {
            $sql = "INSERT INTO user(email, password) VALUES (?,?)";


            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ss", $email, $password);
            $preparedStatement->execute();

            $connection->commit();

            $user = $this->getInsertion($preparedStatement->insert_id);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $user;
    }

    public function update($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof User)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "User instance";
        }

        $id = $object->getId();
        $email = $object->getEmail();
        $password = $object->getPassword();

        try {
            $sql = "UPDATE user SET email = ?, password = ? WHERE id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ssi", $email, $password, $id);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
                $user = null;
            }

            $user = $this->findById($object->getId());
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new mysqli_sql_exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $user;
    }

}
