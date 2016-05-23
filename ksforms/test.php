<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

require 'ksforms.php';

$form = new ksf\Form([
    "name" => "form",
    "type" => "POST",
    "elements" => [
        "elem1" => [
            "type" => "text",
            "title" => "Форма",
            "class" => "validators",
            "value" => "",
            "placeholder" => "Placeholder",
            "warning" => "dfg",
            "error" => "dfgsdf"
            ]
    ]
]);
$form->show();