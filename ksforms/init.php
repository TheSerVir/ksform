<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Form {
    
    private $element_list = [];
    
    public function __construct($args = null) {
        if(is_array($args)) {
            foreach($args as $data) {
                $element_list[] = new Element($data);
            }
        }
    }
    
    public function validate();
    
    public function show();
    
}