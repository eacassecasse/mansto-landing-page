<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierService
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 04-Jun-2021
 */
class SupplierService {

    private $repository;
    private $supplierProductRepository;
    private $productService;

    public function __construct() {
        $this->repository = new SupplierRepository();
        $this->supplierProductRepository = new SupplierProductRepository();
        $this->productService = new ProductService();
    }

    public function insert(Supplier $supplier): Supplier {

        $found = $this->toSupplier($this->repository->
                        findByVatNumber($supplier->getVatNumber()));

        if (($found !== null) && ($found->equals($supplier))) {
            throw new BusinessException("Already exists a supplier with the "
            . "given vatNumber");
        }

        return $this->toSupplier($this->repository->insert($supplier));
    }

    public function findAll(): array {
        $suppliers = array();

        $db_suppliers = $this->repository->findAll();

        if ($db_suppliers == null) {
            throw new EntityNotFoundException("Could not find any supplier!");
        } else {
            foreach ($db_suppliers as $value) {
                array_push($suppliers, $this->toSupplier($value));
            }
        }

        return $suppliers;
    }

    public function findById(int $id): Supplier {
        $db_supplier = $this->repository->findById($id);

        if ($db_supplier == null) {
            throw new EntityNotFoundException("Could not find supplier with the "
            . "given ID");
        }

        return $this->toSupplier($db_supplier);
    }

    public function update(Supplier $supplier): Supplier {

        $found = $this->find($supplier->getId());

        $found->setId($supplier->getId());
        $found->setName($supplier->getName());

        return $this->toSupplier($this->repository->update($found));
    }

    public function deleteById(int $id) {
        return $this->repository->deleteById($id);
    }

    public function addProduct(SupplierProduct $supplierProduct) {

        $product = $this->findProduct($supplierProduct->getProduct()->getId());

        $supplier = $this->find($supplierProduct->getSupplier()->getId());

        $found = $this->toSupplierProduct($this->
                supplierProductRepository->findFromSupplier($supplierProduct));

        if (($found != null) && ($found->equals($supplierProduct))) {
            throw new BusinessException("The product has already been added to "
            . "this supplier!");
        }

        $supplierProduct->setProduct($product);
        $supplierProduct->setSupplier($supplier);

        return $this->toSupplierProduct($this->
                        supplierProductRepository->insert($supplierProduct));
    }

    public function listProducts(Supplier $supplier) {

        $foundedSupplier = $this->find($supplier->getId());

        $supplierProduct = new SupplierProduct();
        $supplierProduct->setSupplier($supplier);

        $founds = $this->supplierProductRepository->findBySupplier($supplierProduct);

        if ($founds == null) {
            throw new EntityNotFoundException("Could not find any product of "
            . "this supplier");
        }

        $products = array();

        foreach ($founds as $found) {
            array_push($products, $this->toSupplierProduct($found));
        }

        return $products;
    }

    public function updateProduct(SupplierProduct $supplierProduct) {

        $product = $this->findProduct($supplierProduct->getProduct()->getId());
        $supplier = $this->find($supplierProduct->getSupplier()->getId());

        $found = $this->toSupplierProduct($this->
                supplierProductRepository->findFromSupplier($supplierProduct));

        if ($found == null) {
            throw new EntityNotFoundException("Could not find this product on "
            . "the given supplier");
        }

        $found->setProduct($product);
        $found->setSupplier($supplier);
        $found->setPrice($supplierProduct->getPrice());

        return $this->toSupplierProduct($this->
                        supplierProductRepository->update($found));
    }

    public function removeProduct(SupplierProduct $supplierProduct) {
        $this->findProduct($supplierProduct->getProduct()->getId());
        $this->find($supplierProduct->getSupplier()->getId());

        $found = $this->toSupplierProduct($this->
                supplierProductRepository->findFromSupplier($supplierProduct));

        if ($found == null) {
            throw new EntityNotFoundException("Could not find such product from "
            . "this supplier");
        }

        return $this->supplierProductRepository->deleteFromSupplier($found);
    }

    private function toSupplierProduct($database_result) {

        if ($database_result == null) {
            $supplierProduct = null;
        } else {
            $supplierProduct = new SupplierProduct();

            if (!empty($database_result)) {
                $supplierProduct->setProduct(
                        $this->findProduct($database_result['product_id']));
                $supplierProduct->setSupplier(
                        $this->findById($database_result['supplier_id']));
                $supplierProduct->setPrice($database_result['price']);
            }
        }

        return $supplierProduct;
    }

    private function toSupplier($database_result) {

        if ($database_result == null) {
            $supplier = null;
        } else {
            $supplier = new Supplier();

            if (!empty($database_result)) {
                $supplier->setId($database_result['id']);
                $supplier->setName($database_result['name']);
                $supplier->setVatNumber($database_result['vatNumber']);
            }
        }

        return $supplier;
    }

    private function find(int $id): Supplier {
        return $this->findById($id);
    }

    private function findProduct(int $productId): Product {
        return $this->productService->findByID($productId);
    }

}
