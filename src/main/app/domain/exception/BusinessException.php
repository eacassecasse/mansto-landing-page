<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BusinessException
 *
 * @author edmilson.cassecasse
 */
class BusinessException extends RuntimeException {
    
    public function __construct(string $message) {
        parent::__construct($message);
    }

}
