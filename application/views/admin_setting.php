<?php
	$active_tab = $this->input->get('tab', TRUE);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Global Settings
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">CMS</a></li>
			<li class="active"><a href="#">Settings</a></li>
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
							<a href="#tab-general" data-toggle="tab">General</a>
						</li>
						<li <?php if($active_tab=='contact') echo 'class="active"';?>>
							<a href="#tab-contact" data-toggle="tab">Contact</a>
						</li>
						<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
					</ul>
					<div class="tab-content">
						<!-- TAB GENERAL -->
						<div class="tab-pane <?php if($active_tab=='') echo 'active';?>" id="tab-general">
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/opt_general_update');?>" class="form-horizontal">
								<div class="box box-info">
									<!-- <div class="box-header">
										<h3 class="box-title">
											Update General Settings
										</h3>
									</div> --><!-- /.box-header -->
									<div class="box-body">
										<div class='form-group'>
											<label class='col-sm-3 text-left'>Website Title <span style="color:red">*</span></label>
											<div class='col-sm-6'>
												<input type='text' class='form-control' name='web-title' value='<?php echo $options['web_title']['value']; ?>' required/>
											</div>
											<p class="col-sm-3 help-block"><?php echo $options['web_title']['desc']; ?></p>
										</div>
										<div class='form-group'>
											<label class='col-sm-3 text-left'>Slogan </label>
											<div class='col-sm-6'>
												<input type='text' class='form-control' name='slogan' value='<?php echo $options['web_slogan']['value']; ?>' />
											</div>
											<p class="col-sm-3 help-block"><?php echo $options['web_slogan']['desc']; ?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Primary Logo</label>
										  	<div class='col-sm-6'>
										  		<img src="<?php echo base_url().'assets/uploads/'.$options['logo_primary']['value'];?>" alt="primary-logo" width="200px" height="99px" />
										  		<input type="file" id="input-file" name="logo-primary">
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['logo_primary']['desc'];?></p>
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
						</div><!-- /.tab-general -->
						<!-- TAB contact -->
						<div class="tab-pane <?php if($active_tab=='contact') echo 'active';?>" id="tab-contact">
							<form method="post" action="<?php echo base_url('cms/opt_contact_update');?>" class="form-horizontal">
								<div class="box box-info">
									<div class="box-body">
										<div class='form-group'>
											<label class='col-sm-3 text-left'>Company Name </label>
											<div class='col-sm-6'>
												<input type='text' class='form-control' name='company-name' value='<?php echo $options['company_name']['value']; ?>' />
											</div>
											<p class="col-sm-3 help-block"><?php echo $options['company_name']['desc']; ?></p>
										</div>
										<div class='form-group'>
											<label class='col-sm-3 text-left'>Address 1</label>
											<div class='col-sm-6'>
												<input type='text' class='form-control' name='address' value='<?php echo $options['company_address']['value']; ?>' />
											</div>
											<p class="col-sm-3 help-block"><?php echo $options['company_address']['desc']; ?></p>
										</div>
										<div class='form-group'>
											<label class='col-sm-3 text-left'>Address 2</label>
											<div class='col-sm-6'>
												<input type='text' class='form-control' name='address_2' value='<?php echo $options['company_address_2']['value']; ?>' />
											</div>
											<p class="col-sm-3 help-block"><?php echo $options['company_address_2']['desc']; ?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>City</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='city' value='<?php echo $options['company_city']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_city']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Province</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='province' value='<?php echo $options['company_province']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_province']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Email</label>
										  	<div class='col-sm-6'>
										  		<input type='email' class='form-control' name='email' value='<?php echo $options['company_email']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_email']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Phone</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='phone' value='<?php echo $options['company_phone']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_phone']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Mobile</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='mobile' value='<?php echo $options['company_mobile']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_mobile']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Pin BB</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='pin-bb' value='<?php echo $options['company_pin_bb']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_pin_bb']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>FB Name</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='fb-name' value='<?php echo $options['company_fb_name']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_fb_name']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>FB Link</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='fb-link' value='<?php echo $options['company_fb_link']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_fb_link']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Map Marker Name</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='map-name' value='<?php echo $options['company_map_name']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_map_name']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Map Latitude</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='map-lat' value='<?php echo $options['company_map_lat']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_map_lat']['desc'];?></p>
										</div>
										<div class="form-group">
										  	<label class='col-sm-3 text-left'>Map Longitude</label>
										  	<div class='col-sm-6'>
										  		<input type='text' class='form-control' name='map-long' value='<?php echo $options['company_map_long']['value']; ?>' />
										  	</div>
										  	<p class="col-sm-3 help-block"><?php echo $options['company_map_long']['desc'];?></p>
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
						</div><!-- /.tab-contact -->
						<!-- ./TAB FAMILY -->
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
				
			</div>
		</div>
	</section>
	<section class="boxku">
		
	</section>
</div><!-- /.content-wrapper -->

<?php include('footer.php');?>

</body>
</html>
