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

class Length extends Validator {
    
    public function validate($string) {
        if(!is_null($this->parameters)) {
            $par = explode("-", $this->parameters);
            if(isset($par[1])) {
                $from = intval($par[0]);
                $to = intval($par[1]);
            } else {
                $from = -1;
                $to = intval($par[0]); 
            }
            if (iconv_strlen($string) > $to) {
                    return ["warning" => $this->warning, "error" => $this->error[0]];
            }
            if (iconv_strlen($string) < $from) {
                if(isset($this->error[1])) {
                    return ["warning" => $this->warning, "error" => $this->error[1]];                
                } else {
                    trigger_error("No second error parameter");
                    return false;
                }
            }
            return true;
                
        } else {
            trigger_error("Incorrect parameters");
        }
    }
    
}