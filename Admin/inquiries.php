<?php if($_settings->chk_flashdata('success')): ?>
<script>
alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
<div class="card-header">
<h3 class="card-title">List of Classes</h3>
<div class="card-tools">
<a href="./?page=classes/manage_class" id="create_new" class="btn btn-flat btn-primary bg- gradientpurple
border-0"><span class="fas fa-plus"></span> Create New</a>
</div>
</div>
<div class="card-body">
<div class="container-fluid">
<table class="table table-hover table-striped table-bordered" id="list">
<thead>
<tr>
<th>#</th>
<th>Date Created</th>
<th>Image</th>
<th>Class/Category</th>
<th>Description</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
$qry = $conn->query("SELECT *, COALESCE((SELECT `name` from `category_list` where
`class_list`.`category_id` = `category_list`.`id` and `status` = 1 and `delete_flag` = 0), 'Category has
been removed') as category_name from `class_list` where delete_flag = 0 order by `name` asc ");
while($row = $qry->fetch_assoc()):
?>
<tr>
<td class="text-center"><?php echo $i++; ?></td>
<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td
<td class="text-center">
<img src="<?= validate_image($row['image_path']) ?>" alt="" class="imgthumbnail
p-0 border class-img">
</td>
<td class="">
<div style="line-height:1em">
<div><?= $row['name'] ?></div>
<div><small class="text-muted"><?= $row['category_name']
?></small></div>
</div>
</td>
<td class=""><p class="mb-0 truncate-1"><?= strip_tags(htmlspecialchars_decode($row['description']))
?></p></td>
<td class="text-center">
<?php if($row['status'] == 1): ?>
<span class="badge badge-success px-3 rounded-pill">Active</span>
<?php else: ?>
<span class="badge badge-danger px-3 rounded-pill">Inactive</span>
<?php endif; ?>
</td>
<td align="center">
<button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown- toggle dropdown-icon"
data-toggle="dropdown">
Action
<span class="sr-only">Toggle Dropdown</span>
</button>
<div class="dropdown-menu" role="menu">
<a class="dropdown-item" href="./?page=classes/view_class&id=<?php echo
$row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="./?page=classes/manage_class&id=<?php echo $row['id'] ?>"><span
class="fa fa-edit text-primary"></span> Edit</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item delete_data" href="javascript:void(0)" data- id="<?php echo $row['id']
?>"><span class="fa fa-trash text-danger"></span> Delete</a>
</div>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
<script>
$(document).ready(function(){
$('.delete_data').click(function(){
_conf("Are you sure to delete this class permanently?","delete_class",[$(this).attr('data-id')])
})
$('.table').dataTable({ columnDefs: [
{ orderable: false, targets: [2,6] }
],
order:[0,'asc']
});
$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
})
function delete_class($id){ start_loader();
$.ajax({
url:_base_url_+"classes/Master.php?f=delete_class", method:"POST",
data:{id: $id}, dataType:"json", error:err=>{
    console.log(err)
alert_toast("An error occured.",'error'); end_loader();
},
success:function(resp){
if(typeof resp== 'object' && resp.status == 'success'){ location.reload();
}else{
alert_toast("An error occured.",'error'); end_loader();
}
}
})
}
</script>