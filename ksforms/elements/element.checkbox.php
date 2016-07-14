<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Checkbox extends Element {
    
    public function __construct($name, $args = null) {
        if(!isset($this->parameters["value"]) || trim($this->parameters["value"]) == "") $this->parameters["value"] = "true";
        parent::__construct($name, $args);
    }
    
    public function validate($string) {
        if(trim($string) != "") $this->parameters["checked"] = "checked";
        $temp = $this->parameters["value"];
        $res = parent::validate($string);
        $this->parameters["value"] = $temp;
        return $res;
    }
     
    public function getValue() {
        return (isset($this->parameters["checked"]) && $this->parameters["checked"] == "checked") ? $this->parameters["value"] : "";
    }
    
}