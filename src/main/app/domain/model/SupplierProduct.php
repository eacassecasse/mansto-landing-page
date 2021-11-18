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
class SupplierProduct {

    private $product;
    private $supplier;

    public function __construct() {
        
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function getSupplier(): Supplier {
        return $this->supplier;
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
                $object->getSupplier()->getId() == $this->getSupplier()->getId();
    }

    public function __toString() {
        return "SupplierProduct {" . "product = '" . $this->getProduct() . '\''
                . ", supplier = '" . $this->getSupplier() . '\'' . '}';
    }

}
