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
class Supplier implements JsonSerializable {

    private $id;
    private $name;
    private $vatNumber;
    private $products = array();

    public function __construct() {
        
    }

    public function addProduct(Product $product) {
        if (($key = array_search($product, $this->products)) === false) {
            array_push($this->products, $product);
        }
    }

    public function removeProduct(Product $product) {
        if (($key = array_search($product, $this->products)) !== false) {
            unset($this->products[$key]);
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getVatNumber() {
        return $this->vatNumber;
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

    public function setVatNumber($vatNumber) {
        $this->vatNumber = $vatNumber;
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

        return $object->getName() == $this->getName() &&
                $object->getVatNumber() == $this->getVatNumber();
    }

    public function __toString() {
        return "Supplier {" . "ID = " . $this->getId() . ", Name = '"
                . $this->getName() . '\'' . ", vatNumber = "
                . $this->getVatNumber() . '}';
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'vatNumber' => $this->getVatNumber(),
            'products' => $this->getProducts()
        ];
    }

}
