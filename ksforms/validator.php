<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf\Validators;

abstract class Validator {
 
    private $messages = ["", ""];
    
    public abstract static function validate($string);
    
    public static function getMessages() {
        return $this->messages;
    }
    
}