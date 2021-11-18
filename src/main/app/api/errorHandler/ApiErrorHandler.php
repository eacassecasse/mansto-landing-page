<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(0);

function apiErrorHandler($errno, $errmsg, $filename, $linenum, $vars) {
    
    //Datetime of the error occurence
    $datetime = date('Y-m-d H:i:s (T)');
    
    
    /* Define an assoc array of error string
     * In reality the only entries we should consider are:
     * E_WARNING, E_NOTICE, E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE
     */
    $errortype = array(E_ERROR => 'Error', 
                       E_WARNING => 'Warning', 
                       E_PARSE => 'Parsing Error',
                       E_NOTICE => 'Notice',
                       E_CORE_ERROR => 'Core Error',
                       E_CORE_WARNING => 'Core Warning',
                       E_COMPILE_ERROR => 'Compile Error',
                       E_COMPILE_WARNING => 'Compile Warning',
                       E_USER_ERROR => 'User Error',
                       E_USER_WARNING => 'User Warning',
                       E_USER_NOTICE => 'User Notice',
                       E_STRICT => 'Runtime Notice',
                       E_RECOVERABLE_ERROR => 'Catchable Fatal Error');
    
    //set of errors for which a var trace will be saved
    $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
    
    $err = "<errorentry>\n";
    $err .= "\t<datetime>" .$datetime ."</datetime>\n";
    $err .= "\t<errornum>" .$errno ."</errornum>\n";
    $err .= "\t<errortype>" .$errortype[$errno] ."</errortype>\n";
    $err .= "\t<errormsg>" .$errmsg ."</errormsg>\n";
    $err .= "\t<scriptname>" .$filename ."</scriptname>\n";
    $err .= "\t<scriptlinenum>" .$linenum ."</scriptlinenum>\n";
    
    if (in_array($errno, $user_errors)) {
        $err .= "\t<vartrace>" . wddx_serialize_value($vars, "Variables") 
                ."</vartrace>\n";
    }
    
    $err .= "</errorentry>\n\n";
    
    
    //save to the error log, and e-mail me if there is a critical user error
    error_log($err, 3, "C://xampp/htdocs/mansto/src/main/app/resources/errors/error.log");
    if ($errno == E_USER_ERROR) {
        mail("admin@servor.com", "Critical User Error Occured", $err);
    }
    
}