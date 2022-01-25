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

CREATE TABLE IF NOT EXISTS validities(id BIGINT AUTO_INCREMENT,
                                      product_id BIGINT NOT NULL,
                                      expiration_date DATETIME NOT NULL,
                                      quantity decimal(6,2) NOT NULL,
                                      PRIMARY KEY(id, product_id),
                                      FOREIGN KEY(product_id) REFERENCES
                                      product(id) ON DELETE CASCADE
);
