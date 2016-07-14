<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Radio extends Element {
    
    protected $values = [];
    
    public function __construct($name, $args = null) {
        if(isset($args["values"])) {
            $this->values = $args["values"];
        }
        parent::__construct($name, $args);
    }
    
    public function getHTML($prefix = "") {
        $this->parameters["radios"] = "";
        $i = 0;
        $before = (isset($this->parameters["before"])) ? $this->parameters["before"] : "";
        $after = (isset($this->parameters["after"])) ? $this->parameters["after"] : "";
        foreach($this->values as $key => $val) {
            $this->parameters["radios"] .= $before.
                    "<input type=\"radio\" class=\"".$this->parameters["class"]."\" name=\"$this->name\" id=\"$this->name$i\" value=\"$key\"".
                    ((isset($this->parameters["value"]) && $this->parameters["value"] == $key) ? " checked" : "").
                    " /><label for=\"$this->name$i\">$val</label>" . $after;
            $i++;
        }
        return parent::getHTML($prefix);
    }
    
    public function validate($string) {
        $this->parameters["value"] = $string;
        return parent::validate($string);
    }
    
}