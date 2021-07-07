<?php
    spl_autoload_register(function ($className){
        //     echo $className."\n";
        include 'classes/'.$className.'.php';
    });


    if(!array_key_exists('post', $_GET)){
        if (array_key_exists('page', $_GET)) { MyGlobal::$Page = $_GET['page'];}
        $obj_News = new News();
        $sort = 'new';
        if(array_key_exists('sort', $_GET)){
            $sort = $_GET['sort'];
        }
        $obj_News->getNewsList(1, MyGlobal::$Page, $sort);
        $obj_News->getCount();
    }else{
        $id = filter_var($_GET['post'], FILTER_VALIDATE_INT);
        if($id) {
            $obj_News = new News();

            $obj_News->viewPlusPlus($id);
            $obj_News->getOneNews($id);
        }
    }
  //  var_dump($obj_News->News[0]['Title']);

   include 'homepage.php';