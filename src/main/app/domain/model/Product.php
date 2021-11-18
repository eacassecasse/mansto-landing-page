<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author edmilson.cassecasse
 */
class Product {

    private $id;
    private $designation;
    private $unit;
    private $price;
    private $totalQuantity;
    private $suppliers;
    private $storages;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getDesignation() {
        return $this->designation;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getTotalQuantity() {
        return $this->totalQuantity;
    }

    public function getSuppliers() {
        return $this->suppliers;
    }

    public function getStorages() {
        return $this->storages;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDesignation($designation) {
        $this->designation = $designation;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setTotalQuantity($totalQuantity) {
        $this->totalQuantity = $totalQuantity;
    }

    public function setSuppliers($suppliers) {
        $this->suppliers = $suppliers;
    }

    public function setStorages($storages) {
        $this->storages = $storages;
    }

    public function equals($object) {
        if ($object == null) {
            return false;
        }

        if ($this == $object) {
            return true;
        }

        if (!($object instanceof Product)) {
            return false;
        }

        return $object->getDesignation() == $this->getDesignation() &&
                $object->getUnit() == $this->getUnit() &&
                $object->getPrice() == $this->getPrice() &&
                $object->getTotalQuantity() == $this->getTotalQuantity();
    }
    
    public function __toString() {
        return "Product {" . "ID = " . $this->getId() . ", Designation = '"
                . $this->getDesignation() . '\'' . ", Unit = '" . $this->getUnit()
                . '\'' . ", Price = " . $this->getPrice()
                . ", TotalStockQuantity = " . $this->getTotalQuantity() . '}';
    }

}
