<section class="py-3">
<div class="container">
<div class="row">
<div class="col-md-12">
<div id="carouselExampleControls" class="carousel slide bg-dark" data-ride="carousel">
<div class="carousel-inner">
<?php
$upload_path = "uploads/banner"; if(is_dir(base_app.$upload_path)):
$file= scandir(base_app.$upload_path);
$_i = 0;
foreach($file as $img): if(in_array($img,array('.','..')))
continue;
$_i++;
?>
<div class="carousel-item h-100 <?php echo $_i == 1 ? "active" : '' ?>">
<img src="<?php echo validate_image($upload_path.'/'.$img) ?>" class="d-block w- 100 h-100"
alt="<?php echo $img ?>">
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
<button class="carousel-control-prev" type="button" data- target="#carouselExampleControls" dataslide="
prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data- target="#carouselExampleControls" dataslide="
next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button>
</div>
</div>
</div>
<div class="row justify-content-center mt-n3">
<div class="col-lg-10 col-md-11 col-sm-11 col-sm-11">
<div class="card card-outline rounded-0">
<div class="card-body">
<div class="container-fluid">
<?= htmlspecialchars_decode(file_get_contents('welcome.html')) ?>
</div>
</div>
</div>
</div>
</div>
</div>
</section>