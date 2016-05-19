<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Element {
    
    private $parameters = [];
    private $dir = "/templates/{name}.html";
    
    private $type;
    private $template;
    
    
    public function __construct($data = null) {
        $this->dir = dirname(__FILE__).$dir;
        if(is_array($args)) {
            if(isset($args["type"])) {
                $this->setType($args["type"]);
                unset($args["type"]);
                foreach($args as $key => $val) {
                    $this->parameters[$key] = $val;
                }
            } else trigger_error ("Type is not defined");
        }
    }
    
    private function __set($name, $value) {
        if(strcmp($name, "type")) {
            $this->parameters[$name] = $value;  
        } else {
            $this->setType($value);
        }
    }
    
    public function setType($type) {
        $this->type = $type;
        $file = str_replace("{name}", $type, $this->dir);
        if(file_exists($file)) {
            $this->template = file_get_contents($file);
        } else trigger_error ("Template '".$args["type"]."' is not found");
    }
    
}