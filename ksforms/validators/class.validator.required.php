<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf\Validators;

class Required extends Validator {
    
    public function validate($string) {
        if(trim($string) == "") {
            return ["warning" => $this->warning, "error" => $this->error[0]];
        }
        return true;
    }
    
}