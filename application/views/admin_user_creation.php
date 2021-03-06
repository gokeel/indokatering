<?php if($title=="add") $page_title="Add new";
				else if($title=="edit") $page_title="Edit";
			 ?>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo GENERAL_CSS_DIR;?>/jquery.tagsinput.css" />
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			<?php echo $page_title;?> user
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">User</a></li>
			<li class="active"><a href="#"><?php echo $page_title;?></a></li>
		</ol>
    </section>
	
	<!-- Main content -->
    <section class="boxku">
		<div class="row">
			<?php include('message_after_transaction.php');?>			
			<div class="col-xs-12">
				<div class="box box-info">
		          	<div class="box-header">
						<h3 class="box-title"><?php echo $page_title;?> user
						</h3>
		          	</div><!-- /.box-header -->
		          	<div class="box-body no-padding">
						<!-- form start -->
						<form role="form" id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url().($title=="add" ? 'users/user_add' : 'users/user_update');?>">
							<?php if($title=="edit"){ ?>
							<input type="hidden" name="user_id" value="<?php echo $this->input->get('id', TRUE);?>">
							<?php } ?>
							<div class="box-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="email_login">Email for Login</label>
											<input type="email" class="form-control input-sm" id="email_login" name="email" placeholder="" value="<?php if($title=='edit') echo $user->email_login;?>" required>
										</div><!-- ./form-group -->
										<?php if($title=="add"){
										?>
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" class="form-control input-sm" id="password" name="pass" required>
										</div><!-- ./form-group -->
										<?php	
										} ?>
										<div class="form-group">
											<label for="first_name">First Name</label>
											<input type="text" class="form-control input-sm" id="first_name" name="fn" placeholder="" value="<?php if($title=='edit') echo $user->first_name;?>" required>
										</div><!-- ./form-group -->
										<div class="form-group">
											<label for="last_name">Last Name</label>
											<input type="text" class="form-control input-sm" id="last_name" name="ln" placeholder="" value="<?php if($title=='edit') echo $user->last_name;?>">
										</div><!-- ./form-group -->
										<div class="form-group">
											<label for="last_name">User Level</label>
											<select class="form-control" name="level" id="sel-level" required>
												<option value="">--Select One--</option>
												<option value="admin" <?php if($title="edit" and isset($user)) {if($user->user_level=="admin") echo "selected";} ?>>Administrator</option>
												<option value="staff" <?php if($title="edit" and isset($user)) {if($user->user_level=="staff") echo "selected";} ?>>Staff</option>
												<!-- <option value="customer" <?php if($title="edit" and isset($user)) {if($user->user_level=="customer") echo "selected";} ?>>Customer</option> -->
											</select>
										</div><!-- ./form-group -->
										<div class='input-group'>
											<label>Enter text/number appear on image below:</label><br />
											<?php echo $captcha;?>
											<input class="form-control"  type="text" name="captcha" id="captcha" required />
										</div>
									</div><!-- ./col -->
								</div><!-- ./row -->
								
							</div><!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary" name="action">Submit</button> 
							</div>
						</form>
		          	</div><!-- /.box-body -->
		        </div><!-- /.box -->
			</div><!-- /.col -->
		</div>
	</section>
		  
</div><!-- /.content-wrapper -->

<?php include('footer.php');?>

</body>
</html>
