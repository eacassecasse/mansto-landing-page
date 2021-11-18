<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConnectionFactory
 *
 * @author edmilson.cassecasse
 */
class ConnectionFactory {

    private $host;
    private $port;
    private $user;
    private $password;
    private $database;

    public function __construct() {
        $this->host = DBHOST;
        $this->user = DBUSER;
        $this->password = DBPASSWORD;
        $this->database = DBNAME;
        $this->port = DBPORT;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

    public function build(): mysqli {
        return new mysqli($this->getHost(), $this->getUser(), 
                $this->getPassword(), $this->getDatabase(), $this->getPort());
    }

}
