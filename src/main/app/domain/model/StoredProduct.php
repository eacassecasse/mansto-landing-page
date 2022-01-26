<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StoredProduct
 *
 * @author edmilson.cassecasse
 */
class StoredProduct implements JsonSerializable {

    private $quantity;
    private $product;
    private $storage;

    public function __construct() {
        
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function getStorage(): Storage {
        return $this->storage;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }

    public function setStorage(Storage $storage) {
        $this->storage = $storage;
    }

    public function equals($object) {
        if ($object == null) {
            return false;
        }

        if ($this == $object) {
            return true;
        }

        if (!($object instanceof StoredProduct)) {
            return false;
        }

        return $object->getProduct()->getId() == $this->getProduct()->getId() &&
                $object->getStorage()->getId() == $this->getStorage()->getId() &&
                $object->getQuantity() == $this->getQuantity();
    }

    public function __toString() {
        return "StoredProduct {" . "Product = '" . $this->getProduct() . '\''
                . ", Storage = '" . $this->getStorage() . '\'' . ", Quantity = "
                . $this->getQuantity() . '}';
    }

    public function jsonSerialize() {
        return [
            'product' => $this->getProduct(),
            'storage' => $this->getStorage(),
            'quantity' => $this->getQuantity()
        ];
    }

}
