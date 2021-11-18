/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  edmilson.cassecasse
 * Created: 02-Jun-2021
 */

USE mansto;

CREATE TABLE IF NOT EXISTS stored_products(product_id BIGINT NOT NULL,
                                           storage_id INT NOT NULL,
                                           quantity decimal(6,2) NOT NULL,
                                           PRIMARY KEY(product_id, storage_id),
                                           FOREIGN KEY(product_id) REFERENCES
                                           product(id),
                                           FOREIGN KEY(storage_id) REFERENCES
                                           storage(id)
);