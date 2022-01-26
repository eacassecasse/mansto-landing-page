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

    private $repository;
    private $validityRepository;

    public function __construct() {
        $this->repository = new ProductRepository();
        $this->validityRepository = new ValidityRepository();
        $this->supplierProductRepository = new SupplierProductRepository();
    }

    public function insert(Product $product) {

        $found = $this->toProduct($this->repository->
                        findByDescription($product->getDescription()));

        if (($found != null) && ($found->equals($product))) {
            throw new BusinessException("Already exists a product with the "
            . "given description!");
        }

        return $this->toProduct($this->repository->insert($product));
    }

    public function findAll(): array {

        $products = array();

        if ($this->repository->findAll() == null) {
            throw new EntityNotFoundException("Could not find any product!");
        } else {
            foreach ($this->repository->findAll() as $value) {
                array_push($products, $this->toProduct($value));
            }
        }

        return $products;
    }

    public function findByID(int $id) {

        if ($this->repository->findById($id) === null) {
            throw new EntityNotFoundException("Could not find product with the "
            . "given ID ");
        } else {
            return $this->toProduct($this->repository->findById($id));
        }
    }

    public function update(Product $product) {

        $found = $this->find($product->getId());

        $found->setDescription($product->getDescription());
        $found->setLowestPrice($product->getLowestPrice());
        $found->setUnit($product->getUnit());
        $found->setTotalQuantity($product->getTotalQuantity());

        return $this->toProduct($this->repository->update($found));
    }

    public function deleteById(int $id) {
        return $this->repository->deleteById($id);
    }

    public function addValidity(Validity $validity) {
        $founds = $this->validityRepository->
                findByExpirationDate($validity->getExpirationDate());

        $product = $this->find($validity->getProduct()->getId());

        foreach ($founds as $found) {

            $fnd = $this->toValidity($found);
            if (($fnd != null) && ($fnd->equals($validity))) {
                throw new BusinessException('This validity has already been added to'
                . ' the given product!');
            }
        }

        $validity->setProduct($product);

        return $this->toValidity($this->validityRepository->insert($validity));
    }

    public function listValidities(Product $product) {

        $prod = $this->find($product->getId());

        $founds = $this->validityRepository->findByProduct($prod);

        if ($founds == null) {
            throw new EntityNotFoundException("Could not find any validity");
        }

        $validities = array();

        foreach ($founds as $found) {
            array_push($validities, $this->toValidity($found));
        }

        return $validities;
    }

    public function removeValidity(Validity $validity) {
        $found = $this->toValidity($this->validityRepository->findById($validity->getId()));

        $this->find($validity->getProduct()->getId());

        if ($found == null) {
            throw new EntityNotFoundException("Could not find such validity");
        }

        return $this->validityRepository->deleteById($validity->getId());
    }

    public function updateValidity(Validity $validity) {
        $found = $this->toValidity($this->validityRepository->findById($validity->getId()));

        if ($found == null) {
            throw new EntityNotFoundException("Could not find such validity");
        }

        $product = $this->find($validity->getProduct()->getId());

        $found->setId($validity->getId());
        $found->setExpirationDate($validity->getExpirationDate());
        $found->setQuantity($validity->getQuantity());
        $found->setProduct($product);

        return $this->toValidity($this->validityRepository->update($found));
    }

    private function toProduct($database_result) {

        if ($database_result == null) {
            $product = null;
        } else {
            $product = new Product();

            if (!empty($database_result)) {
                $product->setId($database_result['id']);
                $product->setDescription($database_result['description']);
                $product->setUnit($database_result['measure_unit']);
                $product->setLowestPrice($database_result['lowest_price']);
                $product->setTotalQuantity($database_result['total_quantity']);
            }
        }

        return $product;
    }

    public function toValidity($database_result) {

        if ($database_result == null) {
            $validity = null;
        } else {
            $validity = new Validity();
            if (!empty($database_result)) {
                $validity->setId($database_result['id']);

                //Setting Datetime
                $expirationDate = new DateTime();
                $expirationDate->setTimestamp(
                        strtotime($database_result['expiration_date']));

                $validity->setExpirationDate($expirationDate);
                $validity->setQuantity($database_result['quantity']);
                $validity->setProduct(
                        $this->findByID($database_result['product_id']));
            }
        }

        return $validity;
    }

    private function find(int $id): Product {
        return $this->findByID($id);
    }

}
