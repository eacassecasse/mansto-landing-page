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
class SupplierProductRepository extends GenericRepository {

    public function __construct() {
        parent::__construct();
    }

    public function deleteById($id) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        try {
            $sql = "DELETE FROM supplier_products WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $connection->commit();

            $this->checkRows($preparedStatement->affected_rows, "Could not delete Supplier Product ID = " . $id);

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

    public function findById($id) {

        $connection = $this->connect();

        try {
            $sql = "SELECT * FROM supplier_products WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("i", $id);
            $preparedStatement->execute();

            $result = $preparedStatement->get_result();

            if ($result->num_rows === 0) {
                $supplierProducts = null;
            }

            $supplierProducts = array();
            while($supplierProduct = $result->fetch_assoc()) {
                array_push($supplierProducts, $supplierProduct);
            }
            
        } catch (mysqli_sql_exception $exception) {
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }
        return $supplierProducts;
    }

    public function findBySupplier(Supplier $supplier) {

        $connection = $this->connect();

        $supplierId = $supplier->getId();
        
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

    public function insert($object) {

        $connection = $this->connect();
        $connection->autocommit(false);
        $connection->begin_transaction();

        if (!($object instanceof SupplierProduct)) {
            return "Unexpected type passed as param, while waiting to receive "
                    . "SupplierProduct instance!";
        }

        $productId = $object->getProduct()->getId();
        $supplierId = $object->getSupplier()->getId();

        try {
            $sql = "INSERT INTO supplier_products ";
            $sql .= "(product_id, supplier_id) VALUES (?,?)";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ii", $productId, $supplierId);
            $preparedStatement->execute();

            $connection->commit();

            $supplierProduct = $this->getInsertion($productId);
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

        $productId = $object->getProduct()->getId();
        $supplierId = $object->getSupplier()->getId();

        try {
            $sql = "UPDATE supplier_products SET supplier_id = ? ";
            $sql .= "WHERE product_id = ?";

            $preparedStatement = $connection->prepare($sql);
            $preparedStatement->bind_param("ii", $supplierId, $productId);
            $preparedStatement->execute();

            $connection->commit();

            if ($preparedStatement->affected_rows === 0) {
               $supplierProduct = null; 
            }
            
            $supplierProduct = $this->findById($productId);
        } catch (mysqli_sql_exception $exception) {
            $connection->rollback();
            throw new Exception($exception);
        } finally {
            $preparedStatement->close();
        }

        return $supplierProduct;
    }

}
