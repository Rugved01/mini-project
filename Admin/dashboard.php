<h1>Welcome, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname')
?>!</h1>
<hr>
<div class="row">
<div class="col-12 col-sm-6 col-md-6">
<div class="info-box">
<span class="info-box-icon bg-gradient-purple elevation-1"><i class="fas fa-boxes"></i></span>
<div class="info-box-content">
<span class="info-box-text">Active Categories</span>
<span class="info-box-number text-right h5">
<?php
$categories = $conn->query("SELECT * FROM category_list where `status` = 1 and delete_flag = 0")-
>num_rows;
echo format_num($categories);
?>
<?php ?>
</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-6">
<div class="info-box">
<span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-prayinghands"></
i></span>
<div class="info-box-content">
<span class="info-box-text">Active Classes</span>
<span class="info-box-number text-right h5">
<?php
$classes = $conn->query("SELECT * FROM class_list where `status` = 1 and delete_flag = 0")->num_rows;
echo format_num($classes);
?>
<?php ?>
</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-6">
<div class="info-box">
<span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-file-alt"></i></span>
<div class="info-box-content">
<span class="info-box-text">Registration Requests</span>
<span class="info-box-number text-right h5">
<?php
$registrations = $conn->query("SELECT id FROM registration_list where `status` = 1 and
`delete_flag` =0")->num_rows;
echo format_num($registrations);
?>
<?php ?>
</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-6">
<div class="info-box">
<span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-info- circle"></i></span>
<div class="info-box-content">
<span class="info-box-text">Inquiries</span>
<span class="info-box-number text-right h5">
<?php
$inquiry = $conn->query("SELECT id FROM inquiry_list")->num_rows; echo format_num($inquiry);
?>
<?php ?>
</span>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->
</div>
<div class="container">
<?php
$files = array();
$fopen = scandir(base_app.'uploads/banner'); foreach($fopen as $fname){
if(in_array($fname,array('.','..')))
continue;
$files[]= validate_image('uploads/banner/'.$fname);
}
?>
<div id="tourCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
<div class="carousel-inner h-100">
<?php foreach($files as $k => $img): ?>
<div class="carousel-item h-100 <?php echo $k == 0? 'active': '' ?>">
<img class="d-block w-100 h-100" style="object-fit:contain" src="<?php echo $img ?>"
alt="">
</div>
<?php endforeach; ?>
</div>
<a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
</div>