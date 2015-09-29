<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			All Image Slider on Homepage
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Setting</a></li>
			<li class="active"><a href="#">Homepage Image Slider</a></li>
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
					<table id="table-10rows" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Image</th>
								<th>Content</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($post<>false)
								foreach($post->result() as $row){?>
							<tr>
								<td><?php echo $row->title;?></td>
								<td>
									<img src="<?php echo UPLOAD_IMAGE_DIR.'/'.$primary_image[$row->id]; ?>" width="420px" height="210px" />';
								</td>
								<td><?php echo $row->content;?></td>
								<td>
									<a href="<?php echo base_url('cms/home_image_slider_edit?id='.$row->id);?>">
										<button class="btn btn-primary btn-xs">
											<i class="fa fa-edit"></i> Edit
										</button>
									</a>
									<?php if(sizeof($post->result()) > 1) {?>
									<a href="<?php echo base_url('cms/delete_post?ty=home_image_slider&id='.$row->id);?>">
										<button class="btn btn-danger btn-xs">
											<i class="fa fa-trash-o"></i> Delete
										</button>
									</a>
									<?php } ?>
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
