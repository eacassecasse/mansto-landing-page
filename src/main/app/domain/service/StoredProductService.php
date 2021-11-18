<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StoredProductService
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 05-Jun-2021
 */
class StoredProductService {

    private $repository;
    private $storageService;

    public function __construct() {
        $this->repository = new StoredProductRepository();
        $this->storageService = new StorageService();
    }

    public function findAll(): array {
        $storedProducts = array();
        $db_storedProducts = $this->repository->findAll();

        if ($db_storedProducts == null) {
            throw new EntityNotFoundException("Could not find any stored product!");
        } else {
            foreach ($db_storedProducts as $value) {
                array_push($storedProducts, 
                        $this->storageService->toStoredProduct($value));
            }
        }

        return $storedProducts;
    }

    public function findById(int $id): StoredProduct {
        $db_storedProduct = $this->repository->findById($id);
        
        if ($db_storedProduct == null) {
            throw new EntityNotFoundException("Could not find stored product "
                    . "ID = " .$id);
        }
        return $this->storageService->
                        toStoredProduct($db_storedProduct);
    }

    public function deleteById(int $id) {
        return $this->repository->deleteById($id);
    }

}
