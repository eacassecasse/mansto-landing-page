<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 28-Jun-2021
 */
class UserController {
    
    private $service;
    
    public function __construct() {
        $this->service = new UserService();
    }
     
}
