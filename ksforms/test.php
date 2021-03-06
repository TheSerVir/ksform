<?php

/* 
 * @link https://github.com/TheSerVir/ksform The KSForms GitHub project
 * @author Sergey Virstyuk (theservir) <sergeyvirstyuk@gmail.com>
 * @copyright 2016 Virstyuk Sergey
 */
$begin_time = time() - 1272000000 + floatval(microtime());

require 'ksforms.php';

//$form = new ksf\Form(
//
$arr = [
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
                    "length:5-10" => ["Проблемы с количеством символов", "Много их", "Мало их"]
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
];


$form = "
    name form
    method POST
    elements
        elem1
            type text
            title Название
            class val
            placeholder Носки
        elem0
            type select
            title Select
            values 
                v V
                a a
                l l
                u u
                e e
            validators
                required
                    *Поле обязательное
                    *Заполни, пожалуйста
        elem2
            type text
            title Текст длиною 5-10 символов
            validators
                length:5-10
                    *Проблемы с количеством символов
                    *Много их
                    *Мало их
        elem8
            type checkbox
            title Checkbox
            value test
        elem3
            type text
            title E-mail
            validators
                email
                    *Мы не сможем отправить вам уведомление
                    *Мыло неправильное
        categories
            type checkboxes
            title Categories
            values
                cat1 Категория1
                cat2 Категория2
                cat3 Категория3
                cat4 Категория4
            validators
                minchecked:1
                    *Так не пойдет
                    *Выберите хоть один элемент
                maxchecked:3
                    *Так не пойдет
                    *Слишком много элементов выбрано
            class switch
            before <div>
            after </div>
        shipping
            type radio
            title Shipping method
            values
                type1 Новая почта
                type2 Хуевая почта
                type3 Укрпочта
            before <div>
            after </div>
        submit
            type submit
            text Сохранить
";
$form = new ksf\Form($form);


$form->setElement("sh", ["type" => "submit", "text" => "Сохранить"], 0);
//$form->removeElement("sh");
//$form->setElementPosition("submit", 1);
var_dump($_POST);
if(isset($_POST["form"])) {
    var_dump($form->validate($_POST));
    var_dump($form->getData());
}
$form->show();

$end_time = time() - 1272000000 + floatval(microtime()) - $begin_time;
function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}
echo "<div>T ".$end_time.", M ".  convert(memory_get_usage(true))."</div>";