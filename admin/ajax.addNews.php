<?php
    spl_autoload_register(function ($className){
        //     echo $className."\n";
        include '../classes/'.$className.'.php';
    });

    session_start();
    if(!isset($_SESSION['Login'])){
        echo "Session error";
        exit;
    }

    $account = new Account();
    $account->CookieAuth();
    $obj_News = new News();
    if(array_key_exists('Title', $_POST) && array_key_exists('Short', $_POST)
        && array_key_exists('Full', $_POST) && array_key_exists('id', $_POST)){

        $title = urldecode(base64_decode($_POST['Title']));
        $short = urldecode(base64_decode($_POST['Short']));
        $full = urldecode(base64_decode($_POST['Full']));

        if(mb_strlen($title) < 3 || mb_strlen($title) > 120){ echo 'error1'; exit;}
        if(mb_strlen($short) < 15 || mb_strlen($short) > 300){ echo 'error2'; exit;}
        if(mb_strlen($full) < 15 || mb_strlen($full) > 10000){ echo 'error3'; exit;}

        //var_dump($_POST);
        if($_POST['id'] == -1) {
            if ($obj_News->addNews($_POST['Title'], $_POST['Short'], $_POST['Full']) > 0) {
                echo "ok";
            } else {
                echo 'error4';
            }
        }else{
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            if($id){
                if($obj_News->updateNews($id, $_POST['Title'], $_POST['Short'], $_POST['Full'])){
                    echo 'edit_ok';
                }
            }
        }

    }

    if(array_key_exists('action', $_GET) && array_key_exists('id', $_GET)){
        if($_GET['action'] == 'delete') {
            echo 'delete ' . $obj_News->deleteNews($_GET['id']);
        }
    }
