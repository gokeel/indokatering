<?php
	$active_tab = $this->input->get('tab', TRUE);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
  <section class="content-header">
		<h1>
			E-Commerce Settings
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">CMS</a></li>
			<li class="active"><a href="#">Setting e-Commerce</a></li>
		</ol>
  </section>
	
	<!-- General Section -->
  <section class="boxku">
		<div class="row">
			<?php include('message_after_transaction.php');?>
			<div class="col-md-12">
				<!-- Custom Tabs -->
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li <?php if($active_tab=='') echo 'class="active"';?>>
							<a href="#tab-sell-point" data-toggle="tab">Selling Point</a>
						</li>
						<li <?php if($active_tab=='bank') echo 'class="active"';?>>
							<a href="#tab-bank" data-toggle="tab">Bank</a>
						</li>
						<li <?php if($active_tab=='ship-cost') echo 'class="active"';?>>
							<a href="#tab-ship-cost" data-toggle="tab">Shipping Cost</a>
						</li>
						<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
					</ul>
					<div class="tab-content">
						<!-- TAB GENERAL -->
						<div class="tab-pane <?php if($active_tab=='') echo 'active';?>" id="tab-sell-point">
							<div class="row">
								<div class="col-md-6">
									<div class="box-header">
												<h3 class="box-title">
													List
												</h3>
											</div> <!-- /.box-header -->
									<div class="box-body no-padding">
					          <table class="table table-condensed">
					          	<tr>
					              <th style="width: 10px">#</th>
					              <th>ID</th>
					              <th>Point Title</th>
					              <th>Point</th>
					              <th>Price</th>
					              <th>Action</th>
					            </tr>
					            <?php 
					            	$cnt = 0;
					            	foreach($selling_point->result() as $row){
					            		$cnt += 1;
					            ?>
					            <tr>
					            	<td><?php echo $cnt;?>.</td>
					              <td><?php echo $row->id;?></td>
					              <td><?php echo $row->title;?></td>
					              <td><span class="badge bg-olive"><?php echo $row->point;?></span></td>
					              <td style="text-align:right"><?php echo number_format($row->price, 0, '.', ',');?></td>
					              <td><button class="btn btn-sm btn-success" onclick="point_set_edit_mode('<?php echo $row->id;?>')">Edit</td>
					              
					            </tr>
											<?php } ?>
					          </table>
					        </div><!-- /.box-body -->
								</div> <!-- ./col-md-6 -->
							
								<div class="col-md-6">
									<form method="post" action="<?php echo base_url('cms/sell_point_update');?>" class="form-horizontal">
										<div class="box box-info">
											<div class="box-header">
												<h3 class="box-title">
													Update Poin and Price
												</h3>
											</div> <!-- /.box-header -->
											<div class="box-body">
												<input type="hidden" name="id" id="point-id" value="" />
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Title <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='title' id="point-title" required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Point <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='point' id="point-point" required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Price <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='price' id="point-price" required />
													</div>
												</div>
											</div><!-- /.box-body -->
											<div class="box-footer">
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
											<!-- Loading (remove the following to stop the loading)-->
											<div class="overlay" style="display:none" id="loading-edit">
											  <i class="fa fa-refresh fa-spin"></i>
											</div>
											<!-- end loading -->
										</div><!-- /.box -->
									</form>
								</div>
							</div> <!-- ./row -->
						</div><!-- /.tab-selling point -->
						<!-- TAB contact -->
						<div class="tab-pane <?php if($active_tab=='bank') echo 'active';?>" id="tab-bank">
							<div class="row">
								<div class="col-md-7">
									<div class="box-header">
												<h3 class="box-title">
													Bank List 
												</h3>
												<span style="font-size:11px">* Click row to open edit mode</span>
											</div> <!-- /.box-header -->
									<div class="box-body no-padding">
					          <table class="table table-condensed">
					          	<tr>
					              <th style="width: 10px">#</th>
					              <th>Bank</th>
					              <th>Account Number</th>
					              <th>Name</th>
					              <th>Branch</th>
					              <th>City</th>
					              <th>Active</th>
					            </tr>
					            <?php 
					            	$cnt = 0;
					            	foreach($banks->result() as $row){
					            		$cnt += 1;
					            ?>
					            <tr>
					            	<td onclick="bank_set_edit_mode('<?php echo $row->bank_id;?>')"><?php echo $cnt;?>.</td>
					              <td onclick="bank_set_edit_mode('<?php echo $row->bank_id;?>')"><?php echo $row->bank_name;?></td>
					              <td onclick="bank_set_edit_mode('<?php echo $row->bank_id;?>')"><?php echo $row->bank_account_number;?></td>
					              <td onclick="bank_set_edit_mode('<?php echo $row->bank_id;?>')"><?php echo $row->bank_holder_name;?></td>
					              <td onclick="bank_set_edit_mode('<?php echo $row->bank_id;?>')"><?php echo $row->bank_branch;?></td>
					              <td onclick="bank_set_edit_mode('<?php echo $row->bank_id;?>')"><?php echo $row->bank_city;?></td>
					              <td>
					              	<input type="checkbox" id="cb-<?php echo $row->bank_id;?>" <?php if($row->active=="true") echo "checked";?>/>
					              </td>
					            </tr>
											<?php } ?>
					          </table>
					        </div><!-- /.box-body -->
								</div> <!-- ./col-md-6 -->
							
								<div class="col-md-5">
									<form method="post" action="<?php echo base_url('cms/bank_add');?>" class="form-horizontal">
										<div class="box box-info">
											<div class="box-header">
												<h3 class="box-title">
													Add Bank Account
												</h3>
											</div> <!-- /.box-header -->
											<div class="box-body">
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Bank Name <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='name' required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Account Number <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='number' required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Account Name <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='account-name' required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Branch <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='branch' required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>City <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='city' required />
													</div>
												</div>
											</div><!-- /.box-body -->
											<div class="box-footer">
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
											<!-- Loading (remove the following to stop the loading)-->
											<div class="overlay" style="display:none" id="loading-edit">
											  <i class="fa fa-refresh fa-spin"></i>
											</div>
											<!-- end loading -->
										</div><!-- /.box -->
									</form>
								</div>
								<div class="col-md-5">
									<form method="post" action="<?php echo base_url('cms/bank_update');?>" class="form-horizontal">
										<div class="box box-info">
											<div class="box-header">
												<h3 class="box-title">
													Edit Bank Account
												</h3>
											</div> <!-- /.box-header -->
											<div class="box-body">
												<input type="hidden" name="id" id="bank-id" value="" />
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Bank Name <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='name' id="bank-name" required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Account Number <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='number' id="bank-number" required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Account Name <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='account-name' id="bank-account-name" required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>Branch <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='branch' id="bank-branch" required />
													</div>
												</div>
												<div class='form-group'>
													<label class='col-sm-3 text-left'>City <span style="color:red">*</span></label>
													<div class='col-sm-6'>
														<input type='text' class='form-control' name='city' id="bank-city" required />
													</div>
												</div>
											</div><!-- /.box-body -->
											<div class="box-footer">
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
											<!-- Loading (remove the following to stop the loading)-->
											<div class="overlay" style="display:none" id="loading-edit">
											  <i class="fa fa-refresh fa-spin"></i>
											</div>
											<!-- end loading -->
										</div><!-- /.box -->
									</form>
								</div>
							</div> <!-- ./row -->
						</div><!-- /.tab-bank -->
						<!-- TAB SHIP COST -->
						<div class="tab-pane <?php if($active_tab=='ship-cost') echo 'active';?>" id="tab-ship-cost">
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/opt_shipcost_update');?>" class="form-horizontal">
								<div class="box box-info">
									<div class="box-header">
										<h3 class="box-title">
											Update Shipping Cost Settings
										</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<div class='form-group'>
											<label class='col-sm-3 text-left'>Shipping Cost <span style="color:red">*</span></label>
											<div class='col-sm-6'>
												<input type='text' class='form-control' name='ship-cost' value='<?php echo $options['ship_cost']['value']; ?>' required/>
											</div>
											<p class="col-sm-3 help-block"><?php echo $options['ship_cost']['desc']; ?></p>
										</div>
										<div class='form-group'>
											<label class='col-sm-3 text-left'>Min Total for Free Shipping <span style="color:red">*</span></label>
											<div class='col-sm-6'>
												<input type='text' class='form-control' name='free' value='<?php echo $options['min_total_free_ship_cost']['value']; ?>' />
											</div>
											<p class="col-sm-3 help-block"><?php echo $options['min_total_free_ship_cost']['desc']; ?></p>
										</div>
									</div><!-- /.box-body -->
									<div class="box-footer">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
									<!-- Loading (remove the following to stop the loading)-->
									<div class="overlay" style="display:none" id="loading-edit">
									  <i class="fa fa-refresh fa-spin"></i>
									</div>
									<!-- end loading -->
								</div><!-- /.box -->
							</form>
						</div><!-- /.tab-ship-cost -->
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
				
			</div>
		</div>
	</section>
	<section class="boxku">
		
	</section>
</div><!-- /.content-wrapper -->

<?php include('footer.php');?>
<script>
	function point_set_edit_mode(id){
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>cms/point_get_data_by_id/'+id,
			dataType: "json",
			success:function(data){
				$('#point-id').val(id);
				$('#point-title').val(data.title);
				$('#point-point').val(data.point);
				$('#point-price').val(data.price);
			}
		});
	}

	function bank_set_edit_mode(id){
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>cms/bank_get_data_by_id/'+id,
			dataType: "json",
			success:function(data){
				$('#bank-id').val(id);
				$('#bank-name').val(data.name);
				$('#bank-number').val(data.number);
				$('#bank-account-name').val(data.account_name);
				$('#bank-branch').val(data.branch);
				$('#bank-city').val(data.city);
			}
		});
	}

	$(document).ready(function() {
    <?php foreach($banks->result() as $row) {?>
    $('#cb-<?php echo $row->bank_id;?>').change(function() {
        if($(this).is(":checked"))
          change_bank_active_status("<?php echo $row->bank_id;?>","true");
        else
        	change_bank_active_status("<?php echo $row->bank_id;?>","false");
    });
    <?php } ?>
	});

	function change_bank_active_status(id, status){
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>cms/change_bank_active/'+id+'/'+status,
			dataType: "json",
			success:function(data){
				
			}
		});
	}
</script>
</body>
</html>
