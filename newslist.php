<div class="row mb-2">
    <?php foreach ($obj_News->NewsHeaders as $v){?>
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
<!--                    <strong class="d-inline-block mb-2 text-primary">--><?php //echo $v['Author'];?><!--</strong>-->
                    <h3 class="mb-0">
                        <a class="text-dark"  href="./index.php?post=<?php echo $v['id'];?>"><?php echo urldecode(base64_decode($v['Title']));?></a>
                    </h3>
                    <div class="mb-1 text-muted"><?php echo date("M d, Y H:i", strtotime($v['DateTime'])).' by '. $v['Author'];?></div>
                    <p class="card-text mb-auto"><?php echo urldecode(base64_decode($v['ShortDescription']));?>.</p>
                    <a href="./index.php?post=<?php echo $v['id'];?>">Continue reading</a>
                </div>
             </div>
        </div>
    <?php }?>
</div>

