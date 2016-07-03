<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */
$begin_time = time() - 1272000000 + floatval(microtime());

require 'ksforms.php';

//$form = new ksf\Form([
//    "name" => "form",
//    "method" => "POST",
//    "elements" => [
//        "elem1" => [
//            "type" => "text",
//            "title" => "Название",
//            "class" => "validators",
//            "value" => "",
//            "placeholder" => "Носки",
//            "validators" => [
//                    "length:5-10" => ["Проблемы с количеством символов", "Много их", "Мало их"]
//                ]
//            ],
//        "price" => [
//            "type" => "text",
//            "title" => "Цена"
//        ],
//        "submit" => [
//            "type" => "submit",
//            "text" => "Сохранить"
//        ]
//    ]
//]);

$form = "
    name form
    method POST
    elements
        elem1
            type text
            title Название
            class val
            placeholder Носки
        elem2
            type text
            title Текст длиною 5-10 символов
            validators
                length:5-10
                    *Проблемы с количеством символов
                    *Много их
                    *Мало их
        submit
            type submit
            text Сохранить
";
$form = new ksf\Form($form);


$form->setElement("sh", ["type" => "submit", "text" => "Сохранить"], 0);
$form->removeElement("sh");

//if(isset($_POST)) {
//    var_dump($form->validate($_POST));
////    var_dump($form->getData());
//}
$form->show();

$end_time = time() - 1272000000 + floatval(microtime()) - $begin_time;
function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}
echo "<div>T ".$end_time.", M ".  convert(memory_get_usage(true))."</div>";
