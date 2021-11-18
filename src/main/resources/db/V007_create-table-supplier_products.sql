/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  edmilson.cassecasse
 * Created: 05-Jun-2021
 */

USE mansto;

CREATE TABLE IF NOT EXISTS supplier_products(product_id BIGINT NOT NULL,
                                             supplier_id INT NOT NULL,
                                             PRIMARY KEY(product_id, supplier_id),
                                             FOREIGN KEY(product_id) REFERENCES
                                             product(id),
                                             FOREIGN KEY(supplier_id) REFERENCES
                                             supplier(id)
);