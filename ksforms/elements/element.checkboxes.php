<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Checkboxes extends Element {
    
    protected $values = [];
    protected $checked = [];
    
    public function __construct($name, $args = null) {
        if(isset($args["values"])) {
            $this->values = $args["values"];
        }
        parent::__construct($name, $args);
    }
    
    public function getHTML($prefix = "") {
        $this->parameters["checkboxes"] = "";
        $i = 0;
        $before = (isset($this->parameters["before"])) ? $this->parameters["before"] : "";
        $after = (isset($this->parameters["after"])) ? $this->parameters["after"] : "";
        foreach($this->values as $key => $val) {
            $this->parameters["checkboxes"] .= $before.
                    "<input type=\"checkbox\" class=\"".$this->parameters["class"]."\" name=\"$this->name[$i]\" id=\"$this->name$i\" value=\"$key\"".
                    ((isset($this->checked[$i])) ? " checked" : "").
                    " /><label for=\"$this->name$i\">$val</label>" . $after;
            $i++;
        }
        return parent::getHTML($prefix);
    }
    
    public function validate($array) {
        $this->checked = $array;
        return parent::validate($array);
    }
    
    public function getValue() {
        return $this->checked;
    }
    
}