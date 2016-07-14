<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 * Об ошибках:
 * Первая ошибка - если символов больше, чем нужно
 * Вторая ошибка - если символов меньше, чем нужно (ненужный параметр, если задан только один параметр)
 */

namespace ksf\Validators;

class Maxchecked extends Validator {
    
    public function validate($array) {
        if(!is_null($this->parameters)) {
            $count = intval($this->parameters);
            if(count($array) > $count) {
                return ["warning" => $this->warning, "error" => $this->error[0]];
            }
            return true;
        } else {
            trigger_error("Incorrect parameters");
        }
    }
    
}