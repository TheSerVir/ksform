<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf\Validators;

class Minchecked extends Validator {
    
    public function validate($array) {
        if(!is_null($this->parameters)) {
            $count = intval($this->parameters);
            $cnt = (is_array($array)) ? count($array) : 0;
            if($cnt < $count) {
                return ["warning" => $this->warning, "error" => $this->error[0]];
            }
            return true;
        } else {
            trigger_error("Incorrect parameters");
        }
    }
    
}