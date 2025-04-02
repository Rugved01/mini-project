<?php if($_settings->chk_flashdata('success')): ?>
<script>
alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
<div class="card-header">
<h3 class="card-title">List of Categories</h3>
<div class="card-tools">
<a href="./?page=categories/manage_category" id="create_new" class="btn btn-flat btn- primary bggradient-
purple border-0"><span class="fas fa-plus"></span> Create New</a>
</div>
</div>
<div class="card-body">
<div class="container-fluid">
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered table-sm" id="list">
<thead>
<tr>
<th>#</th>
<th>Date Created</th>
<th>Category</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
$qry = $conn->query("SELECT * from `category_list` where delete_flag = 0 order
by `name` asc ");
?>
while($row = $qry->fetch_assoc()):
<tr>
<td class="text-center"><?php echo $i++; ?></td>
<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
<td class=""><?= $row['name'] ?></td>
<td class="text-center">
<?php if($row['status'] == 1): ?>
<span class="badge badge-success px-3 rounded-pill">Active</span>
<?php else: ?>
    <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
<?php endif; ?>
</td>
<td align="center">
<button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdowntoggle
dropdown-icon" data-toggle="dropdown">
Action
<span class="sr-only">Toggle Dropdown</span>
</button>
<div class="dropdown-menu" role="menu">
<a class="dropdown-item" href="./?page=categories/view_category&id=<?php echo $row['id']
?>"><span class="fa fa-eye text- dark"></span> View</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="./?page=categories/manage_category&id=<?php echo $row['id']
?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
</div>
<script>
$(document).ready(function(){
$('.delete_data').click(function(){
_conf("Are you sure to delete this category permanently?","delete_category",[$(this).attr('dataid')])
})
$('.table').dataTable({ columnDefs: [
{ orderable: false, targets: [2,6] }
],
order:[0,'asc']
});
$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
})
function delete_category($id){ start_loader();
$.ajax({
url:_base_url_+"classes/Master.php?f=delete_category", method:"POST",
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