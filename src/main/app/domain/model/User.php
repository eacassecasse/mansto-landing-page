<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 08-Jun-2021
 */
class User implements JsonSerializable {

    private $id;
    private $email;
    private $password;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function equals($object) {
        if ($object == null) {
            return false;
        }

        if ($this == $object) {
            return true;
        }

        if (!($object instanceof User)) {
            return false;
        }

        return $object->getEmail() == $this->getEmail();
    }

    public function __toString() {
        return "User {" . "ID = " . $this->getId() . ", Email = '"
                . $this->getEmail() . '\'' . ", Password = '"
                . $this->getPassword() . '\'' . '}';
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ];
    }

}
