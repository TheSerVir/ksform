<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

require_once 'class.element.php';

$dir = dirname(__FILE__) . "/validators/";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false && $file != "." && $file != "..") {
            require_once $dir.$file;
        }
        closedir($dh);
    }
}

class Form {
    
    private $form_parameters = [];
    private $element_list = [];
    
    public function __construct($args = null) {
        if(is_array($args)) {
            foreach($args as $key => $val) {
                switch($key) {
                    case "elements":
                        foreach($val as $name => $data) {
                            $element_list[] = new Element($name, $data);
                        }
                    break;
                    default:
                        $this->form_parameters[$key] = $val;
                    break;
                }
            }
        }
    }
    
    public function validate($post_data) { // boolean
        
    }
    
    public function show() {
        echo $this->getHTML();
    }
    
    public function getHTML() {
        $html = "<form ";
        foreach($this->form_parameters as $key => $val) {
            $html .= "$key=\"$val\"";
        }
        $html .= ">\r\n";
        foreach($this->element_list as $element)
            $html .= $element->getHTML() . "\r\n";
        $html .= "</form>";
        return $html;
    }
    
}