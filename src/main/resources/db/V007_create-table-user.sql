/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  edmilson.cassecasse
 * Created: 08-Jun-2021
 */

USE mansto;

CREATE TABLE IF NOT EXISTS user(id INT AUTO_INCREMENT PRIMARY KEY,
                                email VARCHAR(150) NOT NULL UNIQUE,
                                password VARCHAR(255) NOT NULL
);
