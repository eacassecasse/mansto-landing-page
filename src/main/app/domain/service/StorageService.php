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

    private $repository;
    private $storedProductRepository;
    private $productService;

    public function __construct() {
        $this->repository = new StorageRepository();
        $this->storedProductRepository = new StoredProductRepository();
        $this->productService = new ProductService();
    }

    public function insert(Storage $storage): Storage {

        $found = $this->toStorage($this->repository->
                        findByCode($storage->getCode()));

        if (($found !== null) && ($found->equals($storage))) {
            throw new BusinessException("Already exists a storage with the "
            . "given code");
        }

        return $this->toStorage($this->repository->insert($storage));
    }

    public function findAll(): array {
        $storages = array();

        if ($this->repository->findAll() == null) {
            throw new EntityNotFoundException("Could not find any storage!");
        } else {
            foreach ($this->repository->findAll() as $value) {
                array_push($storages, $this->toStorage($value));
            }
        }

        return $storages;
    }

    public function findById(int $id): Storage {

        $db_storage = $this->repository->findById($id);

        if ($db_storage == null) {
            throw new EntityNotFoundException("Could not find storage with the "
            . "given ID");
        }
        return $this->toStorage($db_storage);
    }

    public function update(Storage $storage): Storage {
        $found = $this->find($storage->getId());

        $found->setId($storage->getId());
        $found->setDesignation($storage->getDesignation());
        $found->setCode($storage->getCode());

        return $this->toStorage($this->repository->update($found));
    }

    public function deleteById(int $id) {
        return $this->repository->deleteById($id);
    }

    public function addProduct(StoredProduct $storedProduct) {
        $storage = $this->find($storedProduct->getStorage()->getId());
        $product = $this->productService->findByID($storedProduct->getProduct()->getId());

        $storedProduct->setProduct($product);
        $storedProduct->setStorage($storage);

        $founds = $this->storedProductRepository->findOnStorage($storedProduct);

        foreach ($founds as $found) {
            $fnd = $this->toStoredProduct($found);

            if (($fnd != null) && ($fnd->equals($storedProduct))) {
                throw new BusinessException("The given product already exists on "
                . "this storage");
            }
        }

        return $this->toStoredProduct(
                        $this->storedProductRepository->insert($storedProduct));
    }

    public function listProducts(Storage $storage) {

        $foundedStorage = $this->find($storage->getId());

        $storedProduct = new StoredProduct();
        $storedProduct->setStorage($foundedStorage);

        $founds = $this->storedProductRepository->findByStorage($storedProduct);

        if ($founds == null) {
            throw new EntityNotFoundException("Could not find any product at "
            . "this storage");
        }

        $products = array();

        foreach ($founds as $product) {
            array_push($products, $this->toStoredProduct($product));
        }

        return $products;
    }

    public function updateProduct(StoredProduct $storedProduct) {

        $product = $this->productService->findByID(
                $storedProduct->getProduct()->getId());

        $storage = $this->find($storedProduct->getStorage()->getId());

        $found = $this->toStoredProduct($this->storedProductRepository->findOnStorage($storedProduct));

        if ($found == null) {
            throw new EntityNotFoundException("Could not find this product on "
            . "the given storage");
        }

        $found->setProduct($product);
        $found->setStorage($storage);
        $found->setQuantity($storedProduct->getQuantity());

        return $this->toStoredProduct($this->storedProductRepository->update($found));
    }

    public function removeProduct(StoredProduct $storedProduct) {

        $this->productService->findByID($storedProduct->getProduct()->getId());

        $this->find($storedProduct->getStorage()->getId());

        $found = $this->toStoredProduct(
                $this->storedProductRepository->findOnStorage($storedProduct));



        if ($found == null) {
            throw new EntityNotFoundException("Could not find such product on "
            . "this storage");
        }

        return $this->storedProductRepository->deleteFromStorage($found);
    }

    public function transferProduct(StoredProduct $from, StoredProduct $to) {

        $existant_source_product = $this->productService->findByID(
                $from->getProduct()->getId());

        $existant_destination_product = $this->productService->findByID(
                $to->getProduct()->getId());

        $existant_source_storage = $this->find($from->getStorage()->getId());

        $existant_destination_storage = $this->find($to->getStorage()->getId());

        //Verify if the product that are is trying to transfer is the same
        //OBS: Product from source and destination must be the same
        if (!$existant_source_product->equals($existant_destination_product)) {
            throw new BusinessException("You can only transfer the same type of "
            . "product");
        }

        //Verify if the storages are the same.
        //OBS: Source storage and destination must be diferent
        if ($existant_source_storage->equals($existant_destination_storage)) {
            throw new BusinessException("The source storage and destination "
            . "storage are the same");
        }

        $existant_product_on_source = $this->toStoredProduct(
                $this->storedProductRepository->findOnStorage($from));

        //Verify if the product that is trying to transfer exists on source
        if ($existant_product_on_source == null) {
            throw new BusinessException("Tried to transfer a product that "
            . "doesn't exist on source storage!");
        }

        $existant_product_on_destination = $this->toStoredProduct(
                $this->storedProductRepository->findOnStorage($to));

        if ($existant_product_on_source->getQuantity() < $from->getQuantity()) {
            throw new BusinessException("The amount you are trying to transfer "
            . "is greater than what exists on the storage");
        }

        if ($existant_product_on_destination == null) {

            $to->setProduct($existant_source_product);
            $to->setStorage($existant_destination_storage);
            $to->setQuantity($from->getQuantity());

            $from->setProduct($existant_source_product);
            $from->setStorage($existant_source_storage);

            $quantity = $existant_product_on_source->getQuantity() -
                    $from->getQuantity();

            $from->setQuantity($quantity);

            $this->storedProductRepository->update($from);

            return $this->toStoredProduct($this->
                            storedProductRepository->insert($to));
        } else {

            $to->setProduct($existant_destination_product);
            $to->setStorage($existant_destination_storage);
            $destination_quantity = $existant_product_on_destination->
                            getQuantity() + $from->getQuantity();
            $to->setQuantity($destination_quantity);

            $from->setProduct($existant_source_product);
            $from->setStorage($existant_source_storage);
            $source_quantity = $existant_product_on_source->
                            getQuantity() - $from->getQuantity();
            $from->setQuantity($source_quantity);

            $this->storedProductRepository->update($from);

            return $this->toStoredProduct($this->
                            storedProductRepository->update($to));
        }
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

}
