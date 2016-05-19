<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf\Validators;

class Email implements Validator {
    
    private $messages = ["", ""];
    
    public static function validate($string) {
        
    }
    
    public static function getMessages() {
        return $messages;
    }
    
}