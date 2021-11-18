<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductValidityService
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 04-Jun-2021
 */
class ProductValidityService {

    private $repository;
    private $productService;

    public function __construct() {
        $this->repository = new ProductValidityRepository();
        $this->productService = new ProductService();
    }

    public function findAll(): array {
        $productValidities = array();

        $db_validities = $this->repository->findAll();
        if ($db_validities == null) {
            throw new EntityNotFoundException("Could not find any validity "
                    . "period!");
        } else {
            foreach ($db_validities as $value) {
                array_push($productValidities, 
                        $this->productService->toProductValidity($value));
            }
        }

        return $productValidities;
    }

    public function findById(int $id): ProductValidity {

        $db_validity = $this->repository->findById($id);

        if ($db_validity == null) {
            throw new EntityNotFoundException("Could not find validity ID = "
            . $id);
        }

        return $this->productService->
                        toProductValidity($db_validity);
    }

    public function deleteById(int $id) {
        return $this->repository->deleteById($id);
    }

}
