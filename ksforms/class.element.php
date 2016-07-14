<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Element {
    
    protected $name = null;
    protected $type = null;
    
    protected $parameters = [];
    protected $validators = [];
    protected $template = "./templates/{name}.html";
    
    
    public function __construct($name, $args = null) {
        $this->name = $name;
        if(is_array($args)) {
            foreach($args as $k => $v) {
                switch($k) {
                    case "type":
                        $this->type = $v;
                    break;
                    case "validators":
                        $this->validators = $v;
                    break;
                    case "warning":
                    case "error":
                        trigger_error("You can't use that names");
                    break;
                    default:
                        $this->parameters[$k] = $v;
                    break;
                }
            }
            if(is_null($this->name) || is_null($this->type) || !strlen($this->name) || !strlen($this->type)) {
                trigger_error("Incorrect name or type of element");
            }
            $this->templateUrl();
        }
    }
    
    protected final function templateUrl() {
        if($this->template[0] == '.') $this->template = dirname(__FILE__) . trim($this->template, '.');
        $this->template = str_replace("{name}", $this->type, $this->template);
    }

    public function show($prefix = "") {
        echo $this->getHTML($prefix);
    }
    
    public function getHTML($prefix = "") {
        if(file_exists($this->template)) {
            $template = str_replace('{$name}', $prefix.$this->name, Templates::get($this->template));
            foreach($this->parameters as $k => $v) {
                $template = str_replace('{$'.$k.'}', $v, $template);
            }
            $template = preg_replace("/{\\$[a-zA-Z]+}/m", "", $template);
            return $template;
        } else {
            trigger_error("Template is not exists");
        }
    }
    
    public function validate($string) {
        $this->parameters["value"] = $string;
        if(isset($this->validators)) {
            $temp = null;
            foreach($this->validators as $k => $v) {
                $exp = explode(":", ucfirst(strtolower($k)));
                $classname = "\\ksf\\Validators\\".$exp[0];
                $temp = new $classname((isset($exp[1])) ? $exp[1] : "", $v);
                $res = $temp->validate($string);
                if($res !== true) {
                    $this->parameters["warning"] = $res["warning"];
                    $this->parameters["error"] = $res["error"];
                    return false;
                }
            }
        }
        return true;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getValue() {
        return (isset($this->parameters["value"])) ? $this->parameters["value"] : "";
    }
    
}