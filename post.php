<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">

            <div class="blog-post">
                <h2 class="blog-post-title"><?php echo urldecode(base64_decode($obj_News->News[0]['Title']));?></h2>
                <p class="blog-post-meta"><?php echo date("M d, Y H:i", strtotime($obj_News->News[0]['DateTime'])).' by '. $obj_News->News[0]['Author'];?></p>
                <?php echo urldecode(base64_decode($obj_News->News[0]['FullDescription']));?>
            </div><!-- /.blog-post -->

        </div><!-- /.blog-main -->

<!--        <aside class="col-md-4 blog-sidebar">-->
<!--            <div class="p-3 mb-3 bg-light rounded">-->
<!--                <h4 class="font-italic">About</h4>-->
<!--                <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>-->
<!--            </div>-->




        </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->