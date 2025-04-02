<?php if($_settings->chk_flashdata('success')): ?>
<script>
alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
<div class="card-header">
<h3 class="card-title">List of Registration Requests</h3>
</div>
<div class="card-body">
<div class="container-fluid">
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered" id="list">
<thead>
<tr>
<th>#</th>
<th>Date Created</th>
<th>Code</th>
<th>Name</th>
<th>Class</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
$qry = $conn->query("SELECT *, COALESCE((SELECT `name` FROM
`class_list` where `registration_list`.`class_id` = `class_list`.`id` and `status` = 1 and `delete_flag` = 0),
'Class has been deleted') as `class_name` from `registration_list` order by `status` asc,
abs(unix_timestamp(date_created)) desc ");
while($row = $qry->fetch_assoc()):
?>
<tr>
<td class="text-center"><?php echo $i++; ?></td>
<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
<td><?php echo $row['code'] ?></td>
<td><?php echo $row['fullname'] ?></td>
<td><?php echo $row['class_name'] ?></td>
<td class="text-center">
<?php if($row['status'] == 1): ?>
<span class="badge badge-primary px-3 rounded-pill">Confirmed</span>
<?php else: ?>
<span class="badge badge-light border px-3 rounded-pill">Pending</span>
<?php endif; ?>
</td>
<td align="center">
<button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdowntoggle
dropdown-icon" data-toggle="dropdown">
Action
<span class="sr-only">Toggle Dropdown</span>
</button>
<div class="dropdown-menu" role="menu">
<a class="dropdown-item" href="./?page=registrations/view_registration&id=<?php echo $row['id']
?>"><span class="fa fa-eye text-dark"></span> View</a>
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
_conf("Are you sure to delete this Registration permanently?","delete_registration",[$(this).attr('dataid')])
})
$('.table').dataTable({ columnDefs: [
{ orderable: false, targets: [5] }
],
order:[0,'asc']
});
$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
})
function delete_registration($id){ start_loader();
$.ajax({
url:_base_url_+"classes/Master.php?f=delete_registration", method:"POST",
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