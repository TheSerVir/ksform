<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */

require 'ksforms.php';

$form = new ksf\Form([
    "name" => "form",
    "method" => "POST",
    "elements" => [
        "elem1" => [
            "type" => "text",
            "title" => "Название",
            "class" => "validators",
            "value" => "",
            "placeholder" => "Носки",
            "validators" => [
                    "length:5-10" => ["warning", "error1", "error2"]
                ]
            ],
        "price" => [
            "type" => "text",
            "title" => "Цена"
        ],
        "submit" => [
            "type" => "submit",
            "text" => "Сохранить"
        ]
    ]
]);
if(isset($_POST)) {
    $form->validate($_POST);
}
$form->show();