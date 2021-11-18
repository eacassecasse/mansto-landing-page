<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author edmilson.cassecasse
 */
interface Generic {
    
    public function insert($object);
    public function findById($id);
    public function findAll();
    public function update($object);
    public function deleteById($id);
   
}
