<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			All Users
			<small><a href="<?php echo base_url('users/add_user');?>">Add new user</a></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">User</a></li>
			<li class="active"><a href="#">View All</a></li>
		</ol>
    </section>
	
	<!-- Main content -->
    <section class="boxku">
		<div class="row">
			<?php include('message_after_transaction.php');?>
			<div class="col-xs-12">
				<div class="box box-info">
	                <div class="box-header">
						List of Users
	                </div><!-- /.box-header -->
	                <div class="box-body">
						<table id="default-table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Username</th>
									<th>Email</th>
									<th>User Level</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Point Balance</th>
									<th>Join Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if($users<>false)
									foreach($users->result() as $row){?>
								<tr>
									<td><?php echo $row->user_id;?></td>
									<td><?php echo $row->email_login;?></td>
									<td><?php echo ucwords($row->user_level);?></td>
									<td><?php echo $row->first_name;?></td>
									<td><?php echo $row->last_name;?></td>
									<td><?php echo $row->point_balance;?></td>
									<td><?php echo date_format(new DateTime($row->join_date), 'Y-m-d');?></td>
									<td>
										<a href="<?php echo base_url('users/edit_user?id='.$row->user_id);?>">
											<button class="btn btn-primary btn-xs">
												<i class="fa fa-edit"></i> Edit
											</button>
										</a>
										<a href="<?php echo base_url('users/user_delete?id='.$row->user_id);?>">
											<button class="btn btn-danger btn-xs">
											<i class="fa fa-trash-o"></i> Delete
										</button></a>
									</td>
								</tr>
								<?php }	?>	
							</tbody>
	                  	</table>
	                </div><!-- /.box-body -->
	            </div><!-- /.box -->
			</div>
		</div>
	</section>
		  
</div><!-- /.content-wrapper -->

<?php include('footer.php');?>
</body>
</html>
