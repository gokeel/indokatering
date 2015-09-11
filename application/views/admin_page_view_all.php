<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			All Page
			<small><a href="<?php echo base_url('cms/post_new');?>">Add new page</a></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Page</a></li>
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
					List
                </div><!-- /.box-header -->
                <div class="box-body">
					<table id="default-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Author</th>
								<th>URL</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($post<>false)
								foreach($post->result() as $row){?>
							<tr>
								<td><?php echo $row->title;?></td>
								<td><?php echo $row->first_name;?></td>
								<td><?php echo $row->url;?></td>
								<td>
									<a href="<?php echo base_url('cms/page_edit?id='.$row->id);?>">
										<button class="btn btn-primary btn-xs">
											<i class="fa fa-edit"></i> Edit
										</button>
									</a>
									<a href="<?php echo base_url('cms/delete_post?ty=page&id='.$row->id);?>">
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
