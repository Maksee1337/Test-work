<?php
    spl_autoload_register(function ($className){
        //     echo $className."\n";
        include '../classes/'.$className.'.php';
    });

    session_start(); // стартуем сессию
    $account = new Account(); // здесь вся работа с авторизацией и учетной записью

    if(array_key_exists('UserName', $_POST) && array_key_exists('Password', $_POST)){
        if($account->UPAuth($_POST['UserName'], $_POST['Password']) != 1){
            header('Location: ./Admin/Login.php?error=-3');
            exit; // заканчиваем это скрипт
        }
    }else{
        // если на входе нет логина пароля
        $account->CookieAuth(); // проверяем установлены ли куки. если установлены то авторизируемся по ним

    }



    if(!isset($_SESSION['Login'])){
        header('Location: ./Login.php');
        exit; // заканчиваем это скрипт
    }



    if(isset($_GET['action'])  && $_GET['action'] == 'logout'){ // логаут
        setcookie('PHPSESSID','',time() - 3600);   // чистим сессию
        setcookie('MyCookie1','',time() - 3600);   // чистим кукисы
        session_destroy();

        header('Location: ../index.php');     // переходим на эту же страницу только уже без куков и сессии
        exit;
    }


    include "Dashboard.php";