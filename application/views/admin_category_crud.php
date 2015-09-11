<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Category for <?php echo ucwords($title);?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">CMS</a></li>
			<li class="active">Category</li>
		</ol>
    </section>
	
	<!-- Main content -->
    <section class="boxku">
		<div class="row">
			<?php include('message_after_transaction.php');?>
			<!-- Modal -->
			<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form role="form" id="form" method="post" action="<?php echo base_url();?>cms/category_update">
							<input type="hidden" name="type" value="<?php echo $title;?>" />
							<input type="hidden" name="id" id="id-edit" />
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Edit Category</h4>
							</div>
							<div class="modal-body">
								<div class="box-body">
									<div class="form-group">
										<label for="input-name">Category</label>
										<input type="text" class="form-control input-sm" id="name-edit" name="category" placeholder="" required>
									</div>
									<div class="form-group">
										<label for="input-name">Slug</label> *good keywords
										<input type="text" class="form-control input-sm" id="slug-edit" name="slug" placeholder="" required >
									</div>
									<div class="form-group">
										<label for="input-name">Parent Category</label>
										<select class="form-control" id="parent-edit" name="parent">
											<option value="">--Please select--</option>
											<?php if($category <> false) 
												foreach($category->result() as $row){?>
											<option value="<?php echo $row->id;?>"><?php echo $row->category;?></option>
											<?php } ?>
										</select>
									</div>
								</div><!-- /.box-body -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save Changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /Modal -->
			
			<div class="col-xs-6">
				<div class="box box-info">
                <div class="box-header">
					<h3 class="box-title">List of Category</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
					<table class="table table-striped">
						<tr>
							<th>Category</th>
							<th>Parent Category</th>
							<th>Slug</th>
							<th>Action</th>
						</tr>
						<?php if($category<>false)
							foreach($category->result() as $row){?>
						<tr>
							<td><?php echo $row->category;?></td>
							<td><?php echo $parent[$row->id];?></td>
							<td><?php echo $row->slug;?></td>
							<td>
								<button class="btn btn-primary btn-xs" onclick="modal_set(<?php echo $row->id;?>)">
									<i class="fa fa-edit"></i> Edit
								</button>
								<?php if($row->parent_id<>"0"){ ?>
								<a href="<?php echo base_url('cms/category_delete?ty='.$title.'&id='.$row->id);?>" onclick="return confirm('Do you want to delete <?php echo $row->category;?>');">
									<button class="btn btn-danger btn-xs">
										<i class="fa fa-trash-o"></i> Delete
									</button>
								</a>
								<?php } ?>
							</td>
						</tr>
						<?php }	?>
                  </table>
                </div><!-- /.box-body -->
                <!-- Loading (remove the following to stop the loading)-->
                <div class="overlay" style="display:none" id="loading-edit">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <!-- end loading -->
              </div><!-- /.box -->
			</div>
			<div class="col-xs-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Add new Category</h3>
					</div><!-- /.box-header -->
					
					
					<!-- form start -->
					<form role="form" id="form" method="post" action="<?php echo base_url();?>cms/category_add">
						<input type="hidden" name="type" value="<?php echo $title;?>" />
						<div class="box-body">
							<div class="form-group">
								<label for="input-name">Category</label>
								<input type="text" class="form-control input-sm" id="name" name="category" placeholder="" required >
							</div>
							<div class="form-group">
								<label for="input-name">Slug</label> *good keywords
								<input type="text" class="form-control input-sm" id="slug" name="slug" placeholder="" required >
							</div>
							<div class="form-group">
								<label for="input-name">Parent Category</label>
								<select class="form-control" id="parent-add" name="parent">
									<option value="">--Please select--</option>
									<?php if($category <> false) 
										foreach($category->result() as $row){?>
									<option value="<?php echo $row->id;?>"><?php echo $row->category;?></option>
									<?php } ?>
								</select>
							</div>
						</div><!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div><!-- /.box -->
			</div>
		</div>
	</section>
		  
</div><!-- /.content-wrapper -->

<?php include('footer.php');?>
<script>
	//$('#example-modal').modal('hide');
	function modal_set(id){
		$('#loading-edit').toggle();
		$.ajax({
			type : "POST",
			async: false,
			url: '<?php echo base_url();?>cms/get_category_by_id/'+id,
			dataType: "json",
			success:function(data){
				$('#id-edit').val(id);
				$('#name-edit').val(data.category);
				$('#slug-edit').val(data.slug);
				$('#parent-edit').val(data.parent_id);
				
				$('#modal-edit').modal('show');
			}
		});
		$('#loading-edit').toggle();
	}
</script>
</body>
</html>
