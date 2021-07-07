<?php

class Account{
    static public $id;
    static public $username;
    public $userslist;
    use t_Connect; // в трейте конструктор с данными для подключения к базе.
                    // чтоб каждый раз при загрузке на хостинг не менять данные


    public function Register($username, $pass){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'INSERT INTO `users` (`Username`,`Password`, `Cookie`) VALUES (:username, :pass, :cookie);';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':username', $username);
        $stm->bindValue(':pass', md5($pass.MyGlobal::SALT)); // соленый пароль храним в мд5
        $cookie = uniqid();
        $stm->bindValue(':cookie',$cookie);

        $stm->execute();
//        var_dump($stm->errorInfo()[2]);

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return -1; //
        }else {
            return $this->connection->lastInsertId(); // возвращяем айди этого пользователя
        }
    }

    public function deleteUser($id){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'DELETE FROM `users` WHERE `id` = :id;';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0;
        }else {
            return 1;
        }
    }

    public function getUsersList(){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'SELECT `id`, `Username` FROM `users`;';
        $stm = $this->connection->prepare($sql);
        $stm->execute();

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0;
        }else {
            $this->userslist = $stm->fetchAll( PDO::FETCH_ASSOC);
            return 1;
        }
    }

    public function getUsername($id){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'SELECT `Username` FROM `users` WHERE `id` = :id;';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0;
        }else {
             return $stm->fetch();;
        }
    }

    public function updateUser($id, $username, $pass){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'UPDATE `users` SET `Username` = :username, `Password` = :pass WHERE `id` = :id';

        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':username', $username);
        $stm->bindValue(':pass', md5($pass.MyGlobal::SALT)); // соленый пароль храним в мд5
        $stm->bindValue(':id', $id);
        $stm->execute();

        //    var_dump($this->connection->lastInsertId());

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0; //
        }else {
            return 1;
        }
    }
    public function CookieAuth(){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        if(isset($_COOKIE['MyCookie1'])){
            $cookie = $_COOKIE['MyCookie1'];
        }else{
            return -1;
        }
        $sql = 'SELECT `id`, `Username` FROM `users` WHERE `cookie` = :cookie';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':cookie', $cookie);
        $stm->execute();


        if($stm->columnCount()){    // проверяем получили ответ
            $t = $stm->fetch();
            //  $t = $stm->fetchAll(PDO::FETCH_ASSOC)[0];
            self::$id = $t['id'];
            self::$username = $t['Username'];
            $_SESSION['Login'] = 'Login';
            return 1;
        }else{
            return -1;
        }
    }

    public function UPAuth($username, $pass){ // авторизация по емейл пароль
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

          $sql = 'SELECT `id`, `Username`, `cookie` FROM `users` WHERE `Username` = :username and `Password` = :pass;';

           $stm = $this->connection->prepare($sql);
           $stm->bindValue(':username', $username);
           $stm->bindValue(':pass', md5($pass.MyGlobal::SALT));
           $stm->execute();
          // $t = $stm->fetchAll(PDO::FETCH_ASSOC)[0];
           $t = $stm->fetch();
           if(isset($t['id'])){    // проверяем получили ответ
               self::$id = $t['id'];
               self::$username = $t['Username'];
               setcookie('MyCookie1',$t['cookie']);
               $_SESSION['Login'] = 'Login';
               return 1;
           }else{
               return 0;
           }
    }
}