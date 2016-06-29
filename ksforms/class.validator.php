<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

namespace ksf\Validators;

abstract class Validator {
    
    protected $warning;
    protected $parameters;
    protected $error = [];
    
    public final function __construct($par = null, $args) {
        $this->parameters = $par;
        if(is_array($args) && count($args) > 1) {
            $this->warning = $args[0];
            $this->error = array_slice($args, 1);
        } else {
            trigger_error("Invalid arguments");
        }
    }
    
    public abstract function validate($string);
    
}