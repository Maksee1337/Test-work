<?php

// трейт с конструктором для полючения к базе. чтоб на хосте не менять данные каждый раз
trait t_Connect{
    protected $connection; // объект класса PDO
    protected $connected = false; // есть ли соединение
    public function __construct(){
        $dsn = 'mysql:dbname=testwork;host=localhost';
        $user = 'root';
        $password = '';
        $this->connection = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $this->connected = true;
    }
}