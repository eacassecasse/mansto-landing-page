<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductValidity
 *
 * @author edmilson.cassecasse
 */
class ProductValidity {

    private $id;
    private $expirationDate;
    private $quantity;
    private $product;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getExpirationDate(): DateTime {
        return $this->expirationDate;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setExpirationDate(DateTime $expirationDate) {
        $this->expirationDate = $expirationDate;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }

    public function equals($object) {

        if ($object == null) {
            return false;
        }

        if ($this == $object) {
            return true;
        }

        if (!($object instanceof ProductValidity)) {
            return false;
        }

        return $object->getProduct()->getId() == $this->getProduct()->getId() &&
                $object->getExpirationDate() == $this->getExpirationDate() &&
                $object->getQuantity() == $this->getQuantity();
    }
    
    public function __toString() {
        return "ProductValidity {" . "ID = " . $this->getId() . ", Product = '"
                . $this->getProduct() . '\'' . ", ExpirationDate = '"
                . $this->getExpirationDate() . '\'' . ", Quantity = "
                . $this->getQuantity() . '}';
    }

}
