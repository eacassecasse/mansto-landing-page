/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  edmilson.cassecasse
 * Created: 02-Jun-2021
 */

CREATE DATABASE IF NOT EXISTS mansto DEFAULT CHARACTER SET utf8mb4;

USE mansto;

CREATE TABLE IF NOT EXISTS product(id BIGINT AUTO_INCREMENT PRIMARY KEY,
                                   designation VARCHAR(95) NOT NULL,
                                   measure_unit VARCHAR(10) NOT NULL,
                                   price decimal(14,2) NOT NULL,
                                   current_totalQuantity decimal(4,2) NOT NULL
);