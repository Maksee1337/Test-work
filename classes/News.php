<?php


class News
{
    use t_Connect;

    public $NewsHeaders = null;
    public $News = null;
    public $count = -1;

    public function addNews($title, $Short, $Full){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'INSERT INTO `news` (`Title`, `ShortDescription`,`FullDescription`, `DateTime`, `Author`) 
                            VALUES (:Title,  :ShortDescription, :FullDescription, CURTIME(), :Author);';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':Title', $title);
        $stm->bindValue(':ShortDescription', $Short);
        $stm->bindValue(':FullDescription', $Full);
        $stm->bindValue(':Author', Account::$username);

        $stm->execute();
  //    var_dump($this->connection->lastInsertId());

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0; //
        }else {
            return $this->connection->lastInsertId(); // возвращяем айди этого пользователя
        }
    }

    public function updateNews($id, $title, $Short, $Full){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        /*$sql = 'INSERT INTO `news` (`Title`, `ShortDescription`,`FullDescription`, `DateTime`, `Author`)
                            VALUES (:Title,  :ShortDescription, :FullDescription, CURTIME(), :Author);';*/

        $sql = 'UPDATE `news` SET `Title` = :Title, `ShortDescription` = :ShortDescription,
                       `FullDescription` = :FullDescription, `Author` = :Author,
                       `DateTime` = CURTIME() WHERE `id` = :id';

        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':Title', $title);
        $stm->bindValue(':ShortDescription', $Short);
        $stm->bindValue(':FullDescription', $Full);
        $stm->bindValue(':Author', Account::$username);
        $stm->bindValue(':id', $id);

        $stm->execute();
        //    var_dump($this->connection->lastInsertId());

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0; //
        }else {
            return 1;
        }
    }

    public function getNewsList($withShort = 0, $page = -1, $sort = ''){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        if($page != -1){
            $limit = ' LIMIT '.(String)($page*MyGlobal::$UsersOnPage). ', '.MyGlobal::$UsersOnPage;
        }else{ $limit = '';}

        if($sort == 'old'){
            $sort = ' ORDER BY DateTime';
        }elseif($sort == 'new'){
            $sort = ' ORDER BY DateTime DESC';
        }else{
            $sort = ' ORDER BY id DESC';
        }

        if($withShort){
            $sql = 'SELECT `id`, `Title`, `ShortDescription`, `Author`, `DateTime`, `Views` FROM `news`' .$sort . $limit;
        }else{
            $sql = 'SELECT `id`, `Title`, `Author`, `Views`, `DateTime` FROM `news`' .$sort . $limit;
        }

        $stm = $this->connection->prepare($sql);
        $stm->execute();

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0;
        }else {
            $this->NewsHeaders = $stm->fetchAll( PDO::FETCH_ASSOC);
            return 1;
        }
    }

    public function getOneNews($id){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'SELECT `Title`, `ShortDescription`, `FullDescription` ,  `DateTime`, `Author` FROM `news` WHERE `id` = :id;';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        $this->News = $stm->fetchAll( PDO::FETCH_ASSOC);

        if(count($this->News)){ // если ошибка, то здесь не пусто
            return 1;
        }else {
            0;
        }
    }

    public function deleteNews($id){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'DELETE FROM `news` WHERE `id` = :id;';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0;
        }else {
            return 1;
        }
    }
    public function getCount(){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'SELECT COUNT(*) FROM `news`;';
        $stm = $this->connection->prepare($sql);
        $stm->execute();

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return -1;
        }else {
            $this->count = (int)$stm->fetch()[0];
        }
    }

    public function viewPlusPlus($id){
        if(!$this->connected){
            echo 'DB no connect';
            return -1;
        };

        $sql = 'UPDATE `news` SET `Views` = `Views` + 1 WHERE `id` = :id;';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        if($stm->errorInfo()[2]){ // если ошибка, то здесь не пусто
            return 0;
        }else {
            return 1;
        }
    }
}