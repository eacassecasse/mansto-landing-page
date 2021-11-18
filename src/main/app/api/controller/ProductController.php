<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductController
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 20-Jun-2021
 */
class ProductController {
    
    private $service;
    
    public function __construct() {
        $this->service = new ProductService();
    }
    
    
    
}
