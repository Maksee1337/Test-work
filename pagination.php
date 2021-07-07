    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex ">
            <a class="p-2 text-muted" href="./index.php?<?php echo MyGlobal::ChangeArgumentInRequestString(['sort'=>'new', 'page'=>'0'])?>">New</a>
            <a class="p-2 text-muted" href="./index.php?<?php echo MyGlobal::ChangeArgumentInRequestString(['sort'=>'old', 'page'=>'0'])?>">Old</a>
        </nav>
    </div>
<?php if( $obj_News->count > 10){?>
     <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex ">
        <?php
            if (MyGlobal::$Page) {
               echo ' <a class="p-2 text-muted" href="./index.php?'.MyGlobal::ChangeArgumentInRequestString(['page'=>'0']).'">First</a>';
               echo ' <a class="p-2 text-muted" href="./index.php?'.MyGlobal::ChangeArgumentInRequestString(['page'=>MyGlobal::$Page - 1]).'">Perv</a>';
            }

            for ($i = 0; $i < $obj_News->count / MyGlobal::$UsersOnPage; $i++) {
                if ($i == MyGlobal::$Page) {
                    echo ' <a class="p-2 text-muted" href="./index.php?'.MyGlobal::ChangeArgumentInRequestString(['page'=>$i]).'"><b>'.($i + 1).'</b></a>';

                } else {
                    echo ' <a class="p-2 text-muted" href="./index.php?'.MyGlobal::ChangeArgumentInRequestString(['page'=>$i]).'">'.($i + 1).'</a>';
                }
            }

            if (MyGlobal::$Page < (int)($obj_News->count / MyGlobal::$UsersOnPage) ) {
               echo ' <a class="p-2 text-muted" href="./index.php?'.MyGlobal::ChangeArgumentInRequestString(['page'=>(MyGlobal::$Page + 1)]).'">Next</a>';
               echo ' <a class="p-2 text-muted" href="./index.php?'.MyGlobal::ChangeArgumentInRequestString(['page'=>(int)($obj_News->count / MyGlobal::$UsersOnPage)]).'">Last</a>';
            }
    ?>

        </nav>
    </div>
<?php }?>
