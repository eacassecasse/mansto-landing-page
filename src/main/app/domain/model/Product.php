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
class Product implements JsonSerializable {

    private $id;
    private $description;
    private $unit;
    private $lowestPrice;
    private $totalQuantity;
    private $validities = array();
    private $suppliers = array();
    private $storages = array();

    public function __construct() {
        
    }

    public function addValidity(Validity $validity) {
        if (($key = array_search($validity, $this->validities)) === false) {
            array_push($this->validities, $validity);
        }
    }

    public function removeValidity(Validity $validity) {
        if (($key = array_search($validity, $this->validities)) !== false) {
            unset($this->validities[$key]);
        }
    }

    public function addSupplier(Supplier $supplier) {
        if (($key = array_search($supplier, $this->suppliers)) === false) {
            array_push($this->suppliers, $supplier);
        }
    }

    public function removeSupplier(Supplier $supplier) {
        if (($key = array_search($supplier, $this->suppliers)) !== false) {
            unset($this->suppliers[$key]);
        }
    }

    public function addStorage(Storage $storage) {
        if (($key = array_search($storage, $this->storages)) === false) {
            array_push($this->storages, $storage);
        }
    }

    public function removeStorage(Storage $storage) {
        if (($key = array_search($storage, $this->storages)) !== false) {
            unset($this->storages[$key]);
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function getLowestPrice() {
        return $this->lowestPrice;
    }

    public function getTotalQuantity() {
        return $this->totalQuantity;
    }

    public function getValidities() {
        return $this->validities;
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

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
    }

    public function setLowestPrice($price) {
        $this->lowestPrice = $price;
    }

    public function setTotalQuantity($totalQuantity) {
        $this->totalQuantity = $totalQuantity;
    }

    public function setValidities($validities) {
        $this->validities = $validities;
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

        return $object->getDescription() == $this->getDescription() &&
                $object->getUnit() == $this->getUnit() &&
                $object->getLowestPrice() == $this->getLowestPrice() &&
                $object->getTotalQuantity() == $this->getTotalQuantity();
    }

    public function __toString() {
        return "Product {" . "ID = " . $this->getId() . ", Description = '"
                . $this->getDescription() . '\'' . ", Unit = '" . $this->getUnit()
                . '\'' . ", Price = " . $this->getLowestPrice()
                . ", TotalStockQuantity = " . $this->getTotalQuantity() . '}';
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'description' => $this->getDescription(),
            'unit' => $this->getUnit(),
            'lowestPrice' => $this->getLowestPrice(),
            'totalQuantity' => $this->getTotalQuantity(),
            'validities' => $this->getValidities(),
            'suppliers' => $this->getSuppliers(),
            'storages' => $this->getStorages()
        ];
    }

}
