<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierPrice
 *
 * @author edmilson.cassecasse
 */
class SupplierPrice {

    private $id;
    private $price;
    private $activeDate;
    private $product;
    private $supplier;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getActiveDate(): DateTime {
        return $this->activeDate;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function getSupplier(): Supplier {
        return $this->supplier;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setActiveDate(DateTime $activeDate) {
        $this->activeDate = $activeDate;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }

    public function setSupplier(Supplier $supplier) {
        $this->supplier = $supplier;
    }

    public function equals($object) {

        if ($object == null) {
            return false;
        }

        if ($this == $object) {
            return true;
        }

        if (!($object instanceof SupplierPrice)) {
            return false;
        }

        return $object->getProduct()->getId() == $this->getProduct()->getId() &&
                $object->getSupplier()->getId() == $this->getSupplier()->getId() &&
                $object->getPrice() == $this->getPrice() &&
                $object->getActiveDate() == $this->getActiveDate();
    }

    public function __toString() {
        return "SupplierPrice {" . "ID = " . $this->getId() . ", Product = '"
                . $this->getProduct() . '\'' . ", Supplier = '"
                . $this->getSupplier() . '\'' . ", Price = "
                . $this->getPrice() . ", ActiveDate = '"
                . $this->getActiveDate() . '\'' . '}';
    }

}
