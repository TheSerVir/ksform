<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

class Email extends Validator {
    
    public static function validate($string) {
        if($par != null) {
            $par = explode("-", $this->parameters);
            if(isset($par[1])) {
                $from = intval($par[0]);
                $to = intval($par[1]);
            } else {
                $from = -1;
                $to = intval($par[0]); 
            }
            if (strlen($string) < $from) {
                return ["warning" => $this->warning, "error" => $this->errors[0]];
            }
            if (strlen($string) > $to) {
                return ["warning" => $this->warning, "error" => $this->errors[1]];
            }
            return true;
                
        } else {
            trigger_error("Incorrect parameters");
        }
    }
    
}