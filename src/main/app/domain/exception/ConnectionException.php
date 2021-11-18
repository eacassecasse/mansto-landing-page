<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConnectionException
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 03-Jun-2021
 */
class ConnectionException extends BusinessException {
    
    public function __construct(string $message) {
        parent::__construct($message);
    }
}
