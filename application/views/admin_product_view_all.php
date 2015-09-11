<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			All Product
			<small><a href="<?php echo base_url('cms/product_new');?>">Add new product</a></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Product</a></li>
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
								<th>Product</th>
								<th>Author</th>
								<th>Category</th>
								<th>Price</th>
								<th>Point</th>
								<th>Discount</th>
								<th>Tags</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($post<>false)
								foreach($post->result() as $row){?>
							<tr>
								<td><?php echo $row->title;?></td>
								<td><?php echo $row->first_name;?></td>
								<td><?php echo $row->category_name;?></td>
								<?php 
									if(sizeof($prod_detail)>0){
								?>
								<td><?php echo $prod_detail[$row->id]->price;?></td>
								<td><?php echo $prod_detail[$row->id]->equal_to_point;?></td>
								<td><?php echo $prod_detail[$row->id]->discount;?></td>
								<?php
									}
								 ?>
								<td><?php echo $row->tags;?></td>
								<td><?php echo $row->status;?></td>
								<td>
									<a href="<?php echo base_url('cms/product_edit?po_id='.$row->id.'&pr_id='.$prod_detail[$row->id]->id);?>">
										<button class="btn btn-primary btn-xs">
											<i class="fa fa-edit"></i> Edit
										</button>
									</a>
									<a href="<?php echo base_url('cms/delete_post?ty=product&id='.$row->id);?>">
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
<script>
	//$('#example-modal').modal('hide');
	function modal_set(id, name){
		$('#region-id').val(id);
		$('#region-name').val(name);
		$('#myModal').modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}
</script>
</body>
</html>
