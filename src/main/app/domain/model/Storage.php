<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Storage
 *
 * @author edmilson.cassecasse
 */
class Storage implements JsonSerializable {

    private $id;
    private $designation;
    private $code;
    private $products = array();

    public function __construct() {
        
    }

    public function addProduct(Product $product) {
        if (($key = array_search($product, $this->products)) === false) {
            array_push($this->products, $product);
        }
    }

    public function removeProduct(Product $product) {
        if (($key = array_search($product, $this->porducts)) !== false) {
            unset($this->products[$key]);
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getDesignation() {
        return $this->designation;
    }

    public function getCode() {
        return $this->code;
    }

    public function getProducts(): array {
        return $this->products;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDesignation($designation) {
        $this->designation = $designation;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setProducts(array $products) {
        $this->products = $products;
    }

    public function equals($object) {
        if ($object == null) {
            return false;
        }

        if ($this == $object) {
            return true;
        }

        if (!($object instanceof Storage)) {
            return false;
        }

        return $object->getDesignation() == $this->getDesignation() &&
                $object->getCode() == $this->getCode();
    }

    public function __toString(): string {
        return "Storage {" . "ID = " . $this->getId() . ", Designation = '"
                . $this->getDesignation() . '\'' . ", Code = '"
                . $this->getCode() . '\'' . '}';
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'description' => $this->getDesignation(),
            'code' => $this->getCode(),
            'products' => $this->getProducts()
        ];
    }

}
