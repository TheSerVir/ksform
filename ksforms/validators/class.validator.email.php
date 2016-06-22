<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf\Validators;

class Email extends Validator {
    
    public static function validate($string) {
        if(preg_match("/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/", $string) === 1) return true;
        $this->message = ["Мы не сможем вам написать", "Вы ввели некорректный E-mail"];
        return false;
    }
    
}