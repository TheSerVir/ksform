<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Element {
    
    private $parameters = [];
    
    public function __construct($data = null) {
        if(is_array($args)) {
            if(isset($args["type"]) && file_exists(dirname(__FILE__)."/templates/".$args["type"].".html")) {
                foreach($args as $data) {

                }
            } else trigger_error ("Template ".$args["type"]." is not found");
        }
    }
    
    public function __set($name, $value) {
        if(strcmp($name, "type"))
            $this->parameters[$name] = $value;  
    }
    
}