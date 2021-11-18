<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierProductService
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 19-Jun-2021
 */
class SupplierProductService {

    private $repository;
    private $service;

    public function __construct() {
        $this->repository = new SupplierProductRepository();
        $this->service = new SupplierService();
    }

    public function findAll(): array {

        $products = array();

        $db_supplierProducts = $this->repository->findAll();

        if ($db_supplierProducts == null) {
            throw new EntityNotFoundException("Could not found supplier product!");
        } else {
            foreach ($db_supplierProducts as $value) {
                array_push($products, $this->service->toSupplierProduct($value));
            }
        }

        return $products;
    }

    public function findById(int $id) {
        $products = array();

        $db_supplierProducts = $this->repository->findById($id);

        if ($db_supplierProducts == null) {
            throw new EntityNotFoundException("Could not found supplier product "
            . "with ID = " . $id);
        } else {
            foreach ($db_supplierProducts as $value) {
                array_push($products, $this->service->toSupplierProduct($value));
            }
        }

        return $products;
    }

    public function deleteById(int $id) {
        return $this->deleteById($id);
    }

}
