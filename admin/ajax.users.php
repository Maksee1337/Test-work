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

    if('getUsersList' === $_GET['action']){
        $account->getUsersList();
     //   var_dump($account->userslist);
        include "users_table.php";
    }

    if('reg' === $_GET['action'] && array_key_exists('username', $_GET) && array_key_exists('pass', $_GET)
                                                                             && array_key_exists('id', $_GET)){

         $pass = $_GET['pass'];
        $username = $_GET['username'];
        $validarion = 1;
        if(  !preg_match('@[A-Z]@', $pass) || !preg_match('@[a-z]@', $pass)
          || !preg_match('@[0-9]@', $pass) || !preg_match('@[^\w]@', $pass) || strlen($pass) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.'."\n\n";
            $validarion*=0;
        }
        if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) { // for english chars + numbers only
           echo 'valid username, alphanumeric & longer than or equals 5 chars';
            $validarion*=0;
        }


        if($validarion){
            if($_GET['id'] == -1) {
                if ($account->Register($username, $pass) > -1) {
                    echo 'ok';
                } else {
                    echo 'error';
                }
            }else{
                $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
                if($id){
                    if($account->updateUser($id, $username, $pass)){
                        echo 'edit_ok';
                    }
                }
            }
        }
    }

    if(array_key_exists('action', $_GET) && array_key_exists('id', $_GET)){
        if($_GET['action'] == 'delete') {
            echo 'delete '. $account->deleteUser($_GET['id']);
        }
    }

    if(array_key_exists('action', $_GET) && array_key_exists('id', $_GET)){
        if($_GET['action'] == 'getUsername') {
           echo $account->getUsername($_GET['id'])[0];
        }
    }