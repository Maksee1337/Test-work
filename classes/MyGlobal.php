<?php


/*класс с глобальными свойствами и методами*/
class MyGlobal
{
    static public $UsersOnPage = 10; // кол-во юзеров на странице
    static public $Page = 0; // кол-во юзеров на странице
    const SALT = 'pIOgRoUp_DSNjfnf8I3#r32233##M93WM';

    // ChangeArgumentInRequestString - формирует на выходе строку с измененными или добавленными параметрами переменной _GET
     static function ChangeArgumentInRequestString($agrArray){ // на вход принимаем ассоциативный массив к примеру ['sortby' => 'firstname', 'dir' => 'up' , 'page' => 0]
        $arr = $_GET; // копируем переменную _GET
        foreach ($agrArray as $k => $v) {
            // проходим по принятому массиву agrArray и добавляем или изменяем в массиве arr соответствующие ключи и значение
            $arr[$k] = $v; //
        }
        $res = http_build_query($arr, "&");
        return $res;
    }


}