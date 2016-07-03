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
        // "jade" style to array 
        if(is_string($args)) {
            $args = $this->jadeToArray($args);
        }
        // array style
        if(is_array($args)) {
            foreach($args as $key => $val) {
                switch($key) {
                    case "elements":
                        foreach($val as $name => $data) {
                            if(isset($data["type"]) && file_exists(dirname(__FILE__)."/elements/element.".strtolower($data["type"]).".php")) {
                                $classname = "ksf\\".ucfirst(strtolower($data["type"]));
                            } else {
                                $classname = "ksf\\Element";
                            }
                            $this->elements[$name] = new $classname($name, $data);
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
    
    public function setElement($name, $data, $position = null) {
        if(isset($data["type"]) && file_exists(dirname(__FILE__)."/elements/element.".strtolower($data["type"]).".php")) {
            $classname = "ksf\\".ucfirst(strtolower($data["type"]));
        } else {
            $classname = "ksf\\Element";
        }
        if(!is_null($position)) {
            $this->elements = insertIntoAssoc($this->elements, $name, new $classname($name, $data), $position);
        } else {
            $this->elements[$name] = new $classname($name, $data);
        }
    }
    
    public function removeElement($name) {
        if(isset($name)) {
            unset($this->elements[$name]);
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
    
    public function jadeToArray($string) {
        $rows = explode("\n", $string);
        $first_offset = null;
        $offset_size = null;
        $args = [];
        foreach($rows as $key => $row) {
            if(strlen(trim($row)) == 0) {
                unset($rows[$key]);
                continue;
            } 
            if($first_offset === null) {
                $first_offset = strlen($row) - strlen(ltrim($row));
            }
            elseif(strlen($row) - strlen(ltrim($row)) > $first_offset && $offset_size === null) {
                $offset_size = strlen($row) - strlen(ltrim($row)) - $first_offset;
            }
            $row = substr($row, $first_offset);
            $osi = strlen($row) - strlen(ltrim($row));
            if($osi > 0) {
                $osi = $osi/$offset_size;
                if($osi !== intval($osi)) {
                    trigger_error("Not respecting the indentation", E_STRICT);
                }
            }

            $row = trim($row);
            $exp = explode(" ", $row, 2);
            $link = &$args;
            while($osi > 0) {
                end($link);
                $temp = &$link[key($link)];
                unset($link);
                $link = &$temp;
                unset($temp);
                $osi--;
            }
            if($row[0] == '*')
                $link[] = substr ($row, 1);
            else
                $link[$exp[0]] = (isset($exp[1])) ? $exp[1] : [];    
            unset($link);
        }
        return $args;
    }
    
}

class Templates {
    
    private static $templates = [];
    
    public static function get($url) {
        if(!isset(self::$templates[$url])) {
            self::$templates[$url] = file_get_contents($url);
        }
        return self::$templates[$url];
    }
    
    public static function clear() {
        self::$templates = [];
    }
    
}

function insertIntoAssoc($array, $key, $value, $position) {
    $temp = [];
    $i = 0;
    foreach($array as $k => $val) {
        if($i == $position) {
            $temp[$key] = $value;
        }
        $temp[$k] = $val;
        $i++;
    }
    if($i <= $position) $temp[$key] = $value;
    return $temp;
}