<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductService
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 03-Jun-2021
 */
class ProductService {

    private $productRepository;
    private $productvalidityRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
        $this->productvalidityRepository = new ProductValidityRepository();
    }

    public function insert(Product $product) {

        $found = $this->toProduct($this->productRepository->
                        findByDesignation($product->getDesignation()));

        if (($found != null) && ($found->equals($product))) {
            throw new BusinessException("Already exists a product with the "
            . "given designation!");
        }

        return $this->toProduct($this->productRepository->insert($product));
    }

    public function findAll(): array {

        $products = array();

        if ($this->productRepository->findAll() == null) {
            throw new EntityNotFoundException("Could not find any product!");
        } else {
            foreach ($this->productRepository->findAll() as $value) {
                array_push($products, $this->toProduct($value));
            }
        }

        return $products;
    }

    public function findByID(int $id) {

        $db_product = $this->productRepository->findById($id);

        if ($db_product == null) {
            throw new EntityNotFoundException("Could not find product ID = "
            . $id);
        }

        return $this->toProduct($db_product);
    }

    public function update(Product $product) {

        $found = $this->find($product->getId());

        $found->setDesignation($product->getDesignation());
        $found->setPrice($product->getPrice());
        $found->setUnit($product->getUnit());
        $found->setTotalQuantity($product->getTotalQuantity());

        return $this->toProduct($this->productRepository->update($found));
    }

    public function deleteById(int $id) {
        return $this->productRepository->deleteById($id);
    }

    public function addValidity(ProductValidity $validity): ProductValidity {

        $product = $this->find($validity->getProduct()->getId());
        $found = $this->toProductValidity(
                $this->productvalidityRepository->findByExpirationDate(
                        $validity->getExpirationDate()));


        if (($found !== null) && ($found->equals($validity))) {
            throw new BusinessException("Already exists a validity with the "
            . "given expiration date");
        }

        $validity->setProduct($product);

        return $this->toProductValidity(
                        $this->productvalidityRepository->insert($validity));
    }

    public function listValidities(Product $product): array {
        $validities = array();

        $found = $this->find($product->getId());

        if ($this->productvalidityRepository->findByProduct($found) == null) {
            throw new EntityNotFoundException("Product ID = " . $found->getId()
            . "does not have validity periods yet!");
        } else {
            foreach ($this->productvalidityRepository->
                    findByProduct($found) as $value) {
                array_push($validities, $this->toProductValidity($value));
            }
        }

        return $validities;
    }

    public function editValidity(ProductValidity $validity): ProductValidity {

        $found = $this->toProductValidity(
                $this->productvalidityRepository->findById($validity->getId()));

        if (is_null($found)) {
            throw new EntityNotFoundException("Could not find a vality period "
            . "ID = " . $validity->getId());
        }

        $found->setId($validity->getId());
        $found->setExpirationDate($validity->getExpirationDate());
        $found->setProduct($validity->getProduct());
        $found->setQuantity($validity->getQuantity());

        return $this->toProductValidity(
                        $this->productvalidityRepository->update($found));
    }

    private function toProduct($database_result) {

        if ($database_result == null) {
            $product = null;
        } else {
            $product = new Product();

            if (!empty($database_result)) {
                $product->setId($database_result['id']);
                $product->setDesignation($database_result['designation']);
                $product->setUnit($database_result['measure_unit']);
                $product->setPrice($database_result['price']);
                $product->setTotalQuantity($database_result['current_totalQuantity']);
            }
        }

        return $product;
    }

    public function toProductValidity($database_result) {

        if ($database_result == null) {
            $productValidity = null;
        } else {
            $productValidity = new ProductValidity();
            if (!empty($database_result)) {
                $productValidity->setId($database_result['id']);

                //Setting Datetime
                $expirationDate = new DateTime();
                $expirationDate->setTimestamp(
                        strtotime($database_result['expiration_date']));

                $productValidity->setExpirationDate($expirationDate);
                $productValidity->setQuantity($database_result['quantity']);
                $productValidity->setProduct(
                        $this->findByID($database_result['product_id']));
            }
        }

        return $productValidity;
    }

    private function find(int $id): Product {
        return $this->findByID($id);
    }

}
