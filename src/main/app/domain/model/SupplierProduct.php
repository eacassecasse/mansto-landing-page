<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierProduct
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 05-Jun-2021
 */
class SupplierProduct implements JsonSerializable {

    private $product;
    private $supplier;
    private $price;

    public function __construct() {
        
    }

    public function getPrice() {
        return $this->price;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function getSupplier(): Supplier {
        return $this->supplier;
    }

    public function setPrice($price) {
        $this->price = $price;
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

        if (!($object instanceof SupplierProduct)) {
            return false;
        }

        return $object->getProduct()->getId() == $this->getProduct()->getId() &&
                $object->getSupplier()->getId() == $this->getSupplier()->getId() &&
                $object->getPrice() == $this->getPrice();
    }

    public function __toString() {
        return "SupplierProduct {" . "product = '" . $this->getProduct() . '\''
                . ", supplier = '" . $this->getSupplier() . '\'' . ", price = "
                . $this->getPrice() . '}';
    }

    public function jsonSerialize() {
        return [
            'product' => $this->getProduct(),
            'supplier' => $this->getSupplier(),
            'price' => $this->getPrice()
        ];
    }

}
