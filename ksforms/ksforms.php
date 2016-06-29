<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

require_once 'class.element.php';
require_once 'class.validator.php';

$dir = dirname(__FILE__) . "/validators/";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if($file != "." && $file != "..") {
                require_once $dir.$file;
            }
        }
        closedir($dh);
    }
}

class Form {
    
    private $parameters = [];
    private $elements = [];
    private $prefix;
    
    public function __construct($args = null) {
        if(is_array($args)) {
            foreach($args as $key => $val) {
                switch($key) {
                    case "elements":
                        foreach($val as $name => $data) {
                            if(isset($data["type"]) && file_exists(dirname(__FILE__)."/elements/element.".strtolower($data["type"]).".php")) {
                                $classname = ucfirst(strtolower($data["type"]));
                                $this->elements[$name] = new $classname($name, $data);
                            } else {
                                $this->elements[$name] = new Element($name, $data);
                            }
                        }
                    break;
                    case "prefix":
                        $this->prefix = $val;
                    break;
                    default:
                        $this->parameters[$key] = $val;
                    break;
                }
            }
        }
    }
    
    public function validate($post_data) { // boolean
        $res = true;
        foreach($post_data as $key => $val) {
            if(isset($this->elements[$key])) {
                if(!$this->elements[$key]->validate($val))
                    $res = false;
            }
        }
        return $res;
    }
    
    public function show() {
        echo $this->getHTML();
    }
    
    public function getHTML() {
        $html = '<form';
        foreach($this->parameters as $key => $val) {
            $html .= " $key=\"$val\"";
        }
        $html .= ">\r\n";
        foreach($this->elements as $element) {
            $html .= $element->getHTML($this->prefix) . "\r\n";
        }
        $html .= '</form>';
        return $html;
    }
    
    public function getData() {
        $values = [];
        foreach($this->elements as $elem) {
            $values[$elem->getName()] = $elem->getValue();
        }
        return $values;
    }
    
}