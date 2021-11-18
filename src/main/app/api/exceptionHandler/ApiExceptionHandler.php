<?php

function handleEntityNotFoundException(EntityNotFoundException $exception) {

//Receive a HttpStatus Code NOT_FOUND
    $problem = new Problem();
//set the Problem Status to the Http Not Found Status
    $problem->setTitle($exception->getMessage());
    $problem->setDatetime(new DateTime());
    return $problem;
}

function handleBusinessException(BusinessException $exception) {
//Get a HttpStatus Code for BAD_REQUEST
    $problem = new Problem();
//Set the Problem Status to the Http Bad Request Status
    $problem->setTitle($exception->getMessage());
    $problem->setDatetime(new DateTime());
    return $problem;
}

function handleDBException(Exception $exception) {
//Get a HttpStatus Code 403
    $problem = new Problem();
//Set the Problem Status to the Http Status
    $problem->setTitle($exception->getMessage());
    $problem->setDatetime(new DateTime());
    return $problem;
}
