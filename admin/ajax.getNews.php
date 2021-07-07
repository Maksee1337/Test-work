<?php
    spl_autoload_register(function ($className){
        //     echo $className."\n";
        include '../classes/'.$className.'.php';
    });

    // var_dump($_GET);
    session_start();
    if(!isset($_SESSION['Login'])){
        echo "Session error";
        exit;
    }

    $account = new Account();
    $account->CookieAuth();
    $obj_News = new News();

    if('getNewsList' === $_GET['action']) {
        $obj_News->getNewsList();
        //  var_dump($obj_News->NewsHeaders);
        include "news_table.php";
    }

    if('getNews' === $_GET['action'] &&  filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
       if($obj_News->getOneNews($_GET['id'])){
           echo json_encode($obj_News->News);
       }else{
           echo 'error';
       }
    }