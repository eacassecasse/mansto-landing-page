<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierProductRepository
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 16-Jun-2021
 */
class SupplierProductRepository {

    private $factory;

    public function __construct() {
        $this->factory = new ConnectionFactory();
    }

    private function connect(): mysqli {

        $connection = $this->factory->build();

        if ($connection->connect_errno) {

            throw new ConnectionException("An Error occured when trying to "
            . "connect to database. \n"
            . "Please contact your Administrator");
        }

        return $connection;
    }

    private function getInsertion(int $inserted_product_id, int $inserted_supplier_id) {
        $product = new Product();
        $product->setId($inserted_product_id);

        $supplier = new Supplier();
        $supplier->setId($inserted_supplier_id);

        $supplierProduct = new SupplierProduct();
        $supplierProduct->setProduct($product);
        $supplierProduct->setSupplier($supplier);

        return $this->findFromSupplier($supplierProduct);
    }

    private function checkRows(int $size, string $message) {
        if ($size === 0) {
            throw new Exception($message);
        }
    }

    public function deleteByProduct(SupplierProduct $supplierProduct) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        $productId = $supplierProduct->getProduct()->getId();

        try {
            $sql = "DELETE FROM supplier_products WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $productId);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not "
                    . "delete Supplier Product ID = " . $productId);

            return true;
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
    }

    public function deleteFromSupplier(SupplierProduct $supplierProduct) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        $productId = $supplierProduct->getProduct()->getId();
        $supplierId = $supplierProduct->getSupplier()->getId();

        try {
            $sql = "DELETE FROM supplier_products WHERE product_id = ? "
                    . "AND supplier_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ii", $productId, $supplierId);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not "
                    . "delete Supplier Product ID = " . $productId
                    . " From Supplier ID = " . $supplierId);

            return true;
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
    }

    public function findAll() {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM supplier_products";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $supplierProducts = null;
            }

            $supplierProducts = array();
            while ($supplierProduct = $result->fetch_assoc()) {
                array_push($supplierProducts, $supplierProduct);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplierProducts;
    }

    public function findByProduct(SupplierProduct $supplierProduct) {

        $connection = $this->connect();

        $productId = $supplierProduct->getProduct()->getId();

        try {
            $sql = "SELECT * FROM supplier_products WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $productId);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $supplierProducts = null;
            }

            $supplierProducts = array();
            while ($supplierProduct = $result->fetch_assoc()) {
                array_push($supplierProducts, $supplierProduct);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
        return $supplierProducts;
    }

    public function findBySupplier(SupplierProduct $supplierProduct) {

        $connection = $this->connect();

        $supplierId = $supplierProduct->getSupplier()->getId();

        try {
            $sql = "SELECT * FROM supplier_products WHERE supplier_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $supplierId);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $supplierProducts = null;
            }

            $supplierProducts = array();
            while ($supplierProduct = $result->fetch_assoc()) {
                array_push($supplierProducts, $supplierProduct);
            }
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
        return $supplierProducts;
    }

    public function findFromSupplier(SupplierProduct $supplierProduct) {

        $connection = $this->connect();

        $productId = $supplierProduct->getProduct()->getId();
        $supplierId = $supplierProduct->getSupplier()->getId();

        try {
            $sql = "SELECT * FROM supplier_products WHERE product_id = ? AND supplier_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ii", $productId, $supplierId);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $createdsupplierProduct = null;
            }

            $createdsupplierProduct = $result->fetch_assoc();
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
        return $createdsupplierProduct;
    }

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof SupplierProduct)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "SupplierProduct instance!";
        }

        $price = $object->getPrice();
        $productId = $object->getProduct()->getId();
        $supplierId = $object->getSupplier()->getId();

        try {
            $sql = "INSERT INTO supplier_products ";
            $sql .= "(price, product_id, supplier_id) VALUES (?,?,?)";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("dii", $price, $productId, $supplierId);
            $preparedStatement->execute();

            $connection->commit();

            $supplierProduct = $this->getInsertion($productId, $supplierId);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplierProduct;
    }

    public function update($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof SupplierProduct)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "SupplierProduct instance!";
        }

        $price = $object->getPrice();
        $productId = $object->getProduct()->getId();
        $supplierId = $object->getSupplier()->getId();

        try {
            $sql = "UPDATE supplier_products SET price = ? ";
            $sql .= "WHERE product_id = ? AND supplier_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("dii", $price, $productId, $supplierId);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
                $supplierProduct = null;
            }

            $supplierProduct = $this->findFromSupplier($object);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplierProduct;
    }

}
