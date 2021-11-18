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

CREATE TABLE IF NOT EXISTS storage(id INT AUTO_INCREMENT PRIMARY KEY,
                                   designation VARCHAR(65) NOT NULL,
                                   code VARCHAR(13) NOT NULL UNIQUE
);
