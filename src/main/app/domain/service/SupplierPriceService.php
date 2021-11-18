<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierPriceService
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 05-Jun-2021
 */
class SupplierPriceService {

    private $repository;
    private $supplierService;

    public function __construct() {
        $this->repository = new SupplierPriceRepository();
        $this->supplierService = new SupplierService();
    }

    public function findAll(): array {
        $prices = array();

        $supplierPrices = $this->repository->findAll();

        if ($supplierPrices == null) {
            throw new EntityNotFoundException("Could not find any product price!");
        } else {
            foreach ($supplierPrices as $value) {
                array_push($prices, $this->supplierService->
                                toSupplierPrice($value));
            }
        }

        return $prices;
    }

    public function findById(int $id): SupplierPrice {
        $price = $this->repository->findById($id);
        
        if ($price == null) {
            throw new EntityNotFoundException("Could not find price ID = " 
                    .$id);
        }
        
        return $this->supplierService->
                        toSupplierPrice($price);
    }

    public function deleteById(int $id) {
        return $this->repository->deleteById($id);
    }

}
