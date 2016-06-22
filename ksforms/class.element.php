<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf;

class Element {
    
    private $name;
    private $parameters = [];
    private $dir = "/templates/{name}.html";
    
    private $type;
    private $template;
    
    
    public function __construct($name, $args = null) {
        if(is_array($args)) {
            if(isset($args["type"])) {
                $this->setType($args["type"]);
                unset($args["type"]);
                
                foreach($args as $key => $val) {
                    $this->parameters[strtolower($key)] = $val;
                }
                
                list($this->parameters["name"], $this->name) = $name;
                $this->mrgoose();
            } else die ("Type is not defined");
        }
    }
    
    /*
     * Парсит шаблон и подставляет значения
     */
    private function mrgoose() {
        $this->template = str_replace('{$name}', '{$_prefix}'.$val, $this->template);
        foreach ($this->parameters as $key => $val) {
            if (is_array($val))
                $this->template = str_replace('{$' . $key . '}', $val, implode(" ", $this->template));
            else
                $this->template = str_replace('{$' . $key . '}', $val, $this->template);
        }
        $this->template = preg_replace("/{\$[a-zA-Z]+}/m", "", $this->template);
    }
    
    public function __set($name, $value) {
        if(equals(substr($name, 0, 3), "set")) {
            $this->parameters[$name] = $value;
        }
    }
    
    public function __call($name, $args) {
        if(equals(substr($name, 0, 3), "get")) {
            $key = substr($name, 3, strlen($name)-3);
            if($key == "Type") return $this->type;
            else {
                return $this->parameters[strtolower($key)];
            }           
        } elseif(equals(substr($name, 0, 3), "set")) {
            $key = substr($name, 3, strlen($name)-3);
            $this->parameters[strtolower($key)] = $args[0];
        }
    }
    
    public function setType($type) {
        $this->type = $type;
        $file = dirname(__FILE__).str_replace("{name}", $type, $this->dir);
        if(file_exists($file)) {
            $this->template = file_get_contents($file);  
        } else die ("Template '".$type."' is not found");
        if (count($this->parameters) > 0) $this->mrgoose();
    }
    
    public function setName($name) {
        if(strlen($name) == 0) die("Name must have at least 1 character");
        list($this->parameters["name"], $this->name) = $name;
    }
    
    /*
     * 
     */
    public function show($prefix = "") {
        echo $this->getHTML($prefix);
    }
    
    public function getHTML($prefix = "") {
        return str_replace('{$_prefix}', $prefix, $this->template);
    }
    
}