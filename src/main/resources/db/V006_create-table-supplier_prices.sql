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

CREATE TABLE IF NOT EXISTS supplier_prices(id INT AUTO_INCREMENT,
                                           product_id BIGINT NOT NULL,
                                           supplier_id INT NOT NULL,
                                           price decimal(14,2) NOT NULL,
                                           entrance_date DATETIME NOT NULL,
                                           PRIMARY KEY(id, product_id, supplier_id),
                                           FOREIGN KEY(product_id) REFERENCES
                                           product(id) ON DELETE CASCADE,
                                           FOREIGN KEY(supplier_id) REFERENCES
                                           supplier(id) ON DELETE CASCADE
);

