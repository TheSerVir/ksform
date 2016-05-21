<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Form {
    
    private $form_parameters = [];
    private $element_list = [];
    
    public function __construct($args = null) {
        if(is_array($args)) {
            foreach($args as $key => $val) {
                switch($key) {
                    case "elements":
                        foreach($val as $data)
                            $element_list[] = new Element($data);
                    break;
                    default:
                        $form_parameters[$key] = $val;
                    break;
                }
            }
        }
    }
    
    public function validate($post_data) { // boolean
        
    }
    
    public function show() {
        foreach($this->element_list as $element)
            $element->show();
    }
    
    public function getHTML() {
        foreach($this->element_list as $element)
            $element->getHTML();
    }
    
}