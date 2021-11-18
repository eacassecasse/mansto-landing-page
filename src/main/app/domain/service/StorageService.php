<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StorageService
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 03-Jun-2021
 */
class StorageService {

    private $storageRepository;
    private $storedProductRepository;
    private $productService;

    public function __construct() {
        $this->storageRepository = new StorageRepository();
        $this->storedProductRepository = new StoredProductRepository();
        $this->productService = new ProductService();
    }

    public function insert(Storage $storage): Storage {

        $found = $this->toStorage($this->storageRepository->
                        findByCode($storage->getCode()));

        if (($found !== null) && ($found->equals($storage))) {
            throw new BusinessException("Already exists a storage with the "
            . "given code");
        }

        return $this->toStorage($this->storageRepository->insert($storage));
    }

    public function findAll(): array {
        $storages = array();

        if ($this->storageRepository->findAll() == null) {
            throw new EntityNotFoundException("Could not find any storage!");
        } else {
            foreach ($this->storageRepository->findAll() as $value) {
                array_push($storages, $this->toStorage($value));
            }
        }

        return $storages;
    }

    public function findById(int $id): Storage {

        $db_storage = $this->storageRepository->findById($id);

        if ($db_storage == null) {
            throw new EntityNotFoundException("Could not find storage ID = "
            . $id);
        }
        return $this->toStorage($db_storage);
    }

    public function update(Storage $storage): Storage {
        $found = $this->find($storage->getId());

        $found->setId($storage->getId());
        $found->setDesignation($storage->getDesignation());
        $found->setCode($storage->getCode());

        return $this->toStorage($this->storageRepository->update($found));
    }

    public function deleteById(int $id) {
        return $this->storageRepository->deleteById($id);
    }

    public function store(StoredProduct $storedProduct): StoredProduct {

        $product = $this->findProduct($storedProduct->getProduct()->getId());
        $storage = $this->find($storedProduct->getStorage()->getId());

        $found = $this->toStoredProduct(
                $this->storedProductRepository->findById(
                        $storedProduct->getProduct()->getId()));

        if (($found !== null) && ($found->equals($storedProduct))) {
            throw new BusinessException("This product is already stored in this "
            . "storage");
        }

        $storedProduct->setProduct($product);
        $storedProduct->setStorage($storage);

        return $this->toStoredProduct(
                        $this->storedProductRepository->insert($storedProduct));
    }

    public function listStoredProducts(int $storageId): array {
        $products = array();

        $storage = $this->find($storageId);

        $db_storedProducts = $this->storedProductRepository->
                findByStorage($storage);
        if ($db_storedProducts == null) {
            throw new EntityNotFoundException("Storage ID = " . $storage->getId()
            . " does not have products!");
        } else {
            foreach ($db_storedProducts as $value) {
                array_push($products, $this->toStoredProduct($value));
            }
        }

        return $products;
    }

    public function unstore(StoredProduct $storedProduct): StoredProduct {
        $found = $this->toStoredProduct(
                $this->storedProductRepository->findById(
                        $storedProduct->getProduct()->getId()));

        if (is_null($found)) {
            throw new EntityNotFoundException("Cannot unstore a product that is"
            . " not stored");
        }

        return $this->toStoredProduct(
                        $this->storedProductRepository->update($storedProduct));
    }

    public function toStoredProduct($database_result) {

        if ($database_result == null) {
            $storedProduct = null;
        } else {
            $storedProduct = new StoredProduct();

            if (!empty($database_result)) {
                $storedProduct->setProduct(
                        $this->productService->findByID($database_result['product_id']));
                $storedProduct->setStorage(
                        $this->findById($database_result['storage_id']));
                $storedProduct->setQuantity($database_result['quantity']);
            }
        }

        return $storedProduct;
    }

    private function toStorage($database_result) {

        if ($database_result == null) {
            $storage = null;
        } else {
            $storage = new Storage();

            if (!empty($database_result)) {
                $storage->setId($database_result['id']);
                $storage->setDesignation($database_result['designation']);
                $storage->setCode($database_result['code']);
            }
        }

        return $storage;
    }

    private function find(int $id): Storage {
        return $this->findById($id);
    }

    private function findProduct(int $id): Product {
        $product = $this->productService->findByID($id);

        if (is_null($product)) {
            throw new EntityNotFoundException("Could not find product ID = "
            . $id);
        }

        return $product;
    }

}
