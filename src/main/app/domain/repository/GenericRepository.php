<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenericRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 03-Jun-2021
 */
abstract class GenericRepository implements Generic {

    private $factory;

    public function __construct() {
        $this->factory = new ConnectionFactory();
    }

    protected function connect(): mysqli {

        $connection = $this->factory->build();

        if ($connection->connect_errno) {

            throw new ConnectionException("An Error occured when trying to "
            . "connect to database. \n"
            . "Please contact your Administrator");
        }

        return $connection;
    }

    protected function getInsertion(int $inserted_id) {
        if ($inserted_id > 0) {
            return $this->findById($inserted_id);
        }
    }

    protected function checkRows(int $size, string $message) {
        if ($size === 0) {
            throw new Exception($message);
        }
    }

}
