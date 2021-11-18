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

    private $supplierRepository;
    private $supplierPriceRepository;
    private $supplierProductRepository;
    private $productService;

    public function __construct() {
        $this->supplierRepository = new SupplierRepository();
        $this->supplierPriceRepository = new SupplierPriceRepository();
        $this->supplierProductRepository = new SupplierProductRepository();
        $this->productService = new ProductService();
    }

    public function insert(Supplier $supplier): Supplier {

        $found = $this->toSupplier($this->supplierRepository->
                        findByName($supplier->getName()));

        if (($found !== null) && ($found->equals($supplier))) {
            throw new BusinessException("Already exists a supplier with the "
            . "given name");
        }

        return $this->toSupplier($this->supplierRepository->insert($supplier));
    }

    public function findAll(): array {
        $suppliers = array();

        $db_suppliers = $this->supplierRepository->findAll();

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
        $db_supplier = $this->supplierRepository->findById($id);

        if ($db_supplier == null) {
            throw new EntityNotFoundException("Could not find supplier ID = "
            . $id);
        }

        return $this->toSupplier($db_supplier);
    }

    public function update(Supplier $supplier): Supplier {

        $found = $this->find($supplier->getId());

        $found->setId($supplier->getId());
        $found->setName($supplier->getName());

        return $this->toSupplier($this->supplierRepository->update($found));
    }

    public function deleteById(int $id) {
        return $this->supplierRepository->deleteById($id);
    }

    public function addProduct(SupplierProduct $product): SupplierProduct {

        $prod = $this->findProduct($product->getProduct()->getId());
        $supplier = $this->find($product->getSupplier()->getId());

        $found = $this->supplierProductRepository->findById($prod->getId());

        if (!is_null($found)) {
            foreach ($found as $value) {
                $sProduct = $this->toSupplierProduct($value);

                if (($sProduct !== null) && ($sProduct->equals($product))) {
                    throw new BusinessException("This product is already "
                    . "associated with this supplier");
                }
            }
        }

        $product->setProduct($prod);
        $product->setSupplier($supplier);

        return $this->toSupplierProduct(
                        $this->supplierProductRepository->insert($product));
    }

    public function listProducts(Supplier $supplier): array {

        $products = array();

        $found = $this->find($supplier->getId());

        $db_supplierProducts = $this->supplierProductRepository->
                findBySupplier($found);


        if ($db_supplierProducts == null) {
            throw new EntityNotFoundException("Supplier ID = "
            . $found->getId() . " does not have product list yet!");
        } else {
            foreach ($db_supplierProducts as $value) {
                array_push($products, $this->toSupplierProduct($value));
            }
        }

        return $products;
    }

    public function editProduct(SupplierProduct $product): SupplierProduct {

        $found = $this->toSupplierProduct(
                $this->supplierProductRepository->findById(
                        $product->getProduct()->getId()));

        if (is_null($found)) {
            throw new BusinessException("Cannot edit a product that doesn't "
            . "exist!");
        }

        $found->setProduct($product->getProduct());
        $found->setSupplier($product->getSupplier());

        return $this->toSupplierProduct(
                        $this->supplierProductRepository->update($found));
    }

    public function addProductPrice(SupplierPrice $price): SupplierPrice {

        $product = $this->findProduct($price->getProduct()->getId());
        $supplier = $this->find($price->getSupplier()->getId());


        $found = $this->supplierPriceRepository->
                findByActiveDate($price->getActiveDate());

        if (!is_null($found)) {

            foreach ($found as $value) {
                $prc = $this->toSupplierPrice($value);

                if (($prc !== null) && ($prc->equals($price))) {
                    throw new BusinessException("Already exists a price with "
                    . "given entrance date!");
                }
            }
        }

        $price->setProduct($product);
        $price->setSupplier($supplier);

        return $this->toSupplierPrice(
                        $this->supplierPriceRepository->insert($price));
    }

    public function listPrices(Supplier $supplier): array {
        $prices = array();
        $found = $this->find($supplier->getId());
        $db_supplierPrices = $this->supplierPriceRepository->
                findBySupplier($found);


        if ($db_supplierPrices == null) {
            throw new EntityNotFoundException("Supplier ID = "
            . $found->getId() . " does not have price list yet!");
        } else {
            foreach ($db_supplierPrices as $value) {
                array_push($prices, $this->toSupplierPrice($value));
            }
        }

        return $prices;
    }

    public function editPrice(SupplierPrice $price): SupplierPrice {

        $found = $this->toSupplierPrice(
                $this->supplierPriceRepository->findById($price->getId()));

        if (is_null($found)) {
            throw new BusinessException("Cannot edit a price that doesn't "
            . "exist!");
        }

        $found->setId($price->getId());
        $found->setProduct($price->getProduct());
        $found->setSupplier($price->getSupplier());
        $found->setPrice($price->getPrice());
        $found->setActiveDate($price->getActiveDate());

        return $this->toSupplierPrice(
                        $this->supplierPriceRepository->update($price));
    }

    public function toSupplierPrice($database_result) {

        if ($database_result == null) {
            $supplierPrice = null;
        } else {
            $supplierPrice = new SupplierPrice();

            if (!empty($database_result)) {
                $supplierPrice->setId($database_result['id']);
                $supplierPrice->setPrice($database_result['price']);

                //Setting Active Date
                $activeDate = new DateTime();
                $activeDate->setTimestamp(
                        strtotime($database_result['entrance_date']));

                $supplierPrice->setActiveDate($activeDate);
                $supplierPrice->setProduct(
                        $this->findProduct($database_result['product_id']));
                $supplierPrice->setSupplier($this->
                                findById($database_result['supplier_id']));
            }
        }

        return $supplierPrice;
    }

    public function toSupplierProduct($database_result) {

        if ($database_result == null) {
            $supplierProduct = null;
        } else {
            $supplierProduct = new SupplierProduct();

            if (!empty($database_result)) {
                $supplierProduct->setProduct(
                        $this->findProduct($database_result['product_id']));
                $supplierProduct->setSupplier(
                        $this->findById($database_result['supplier_id']));
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
