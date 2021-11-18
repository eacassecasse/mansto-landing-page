<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Supplier
 *
 * @author edmilson.cassecasse
 */
class Supplier {

    private $id;
    private $name;
    private $prices;
    private $products;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrices() {
        return $this->prices;
    }
    
    public function getProducts() {
        return $this->products;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrices($prices) {
        $this->prices = $prices;
    }
    
    public function setProducts($products) {
        $this->products = $products;
    }
    
    public function equals($object) {

        if ($object == null) {
            return false;
        }

        if ($this == $object) {
            return true;
        }

        if (!($object instanceof Supplier)) {
            return false;
        }

        return $object->getName() == $this->getName();
    }

    public function __toString() {
        return "Supplier {" . "ID = " . $this->getId() . ", Name = '"
                . $this->getName() . '\'' . '}';
    }

}
