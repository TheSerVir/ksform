<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Select extends Element {
    
    protected $values = [];
    
    public function __construct($name, $args = null) {
        if(isset($args["values"])) {
            $this->values = $args["values"];
        }
        parent::__construct($name, $args);
    }
    
    public function getHTML($prefix = "") {
        $this->parameters["values"] = "<option value=\"\"></option>";
        foreach($this->values as $key => $val) {
            $this->parameters["values"] .= 
                    "<option value=\"$key\"".
                    ((isset($this->parameters["value"]) && $key == $this->parameters["value"]) ? " selected" : "").
                    ">$val</option>";
        }
        return parent::getHTML($prefix);
    }
    
}