<?php
	define('ADMIN_LTE_DIR', base_url('assets/themes/adminlte/'));
	define('GENERAL_JS_DIR', base_url('assets/themes/js/'));
	define('GENERAL_CSS_DIR', base_url('assets/themes/css/'));
	define('GENERAL_IMAGES_DIR', base_url('assets/images/'));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Licosyd CMS | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo ADMIN_LTE_DIR;?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo ADMIN_LTE_DIR;?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo ADMIN_LTE_DIR;?>/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
	
	<link href="<?php echo GENERAL_CSS_DIR;?>/custom.css" rel="stylesheet" type="text/css" />
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="box-login">
		<div class="page-top">
			<a href="<?php echo base_url();?>"><img src="<?php echo GENERAL_IMAGES_DIR;?>/logo.png" /></a>
		</div>
		<div class="login-container">
			<div class="login-passdiv">
				<div class="login-passbody">
					<p class="login-box-msg">Sign in to start your session</p>
					<form id="form-login">
					  <div class="form-group has-feedback">
						<input type="email" class="form-control" name="email" placeholder="Username"/>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					  </div>
					  <div class="form-group has-feedback">
						<input type="password" class="form-control" name="password" placeholder="Password"/>
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					  </div>
					  <div class="row">
						<div class="col-xs-8">    
						  <div class="checkbox icheck">
							<label>
							  <a href="#">I forgot my password</a>
							  <br/>
							  <div id="message" style="color:red"></div>
							</label>
						  </div>
						</div><!-- /.col -->
						<div class="col-xs-4">
						  <button type="button" id="sign-in" class="btn btn-primary btn-block btn-flat">Sign In</button>
						</div><!-- /.col -->
					  </div>
					</form>
				</div>
			</div>
		</div>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
		});
	  
		//submitting form
		$('#sign-in').on('click', function() {
			$.ajax({
				type : "POST",
				url: '<?php echo base_url();?>users/do_login',
				data: $( "#form-login" ).serialize(),
				dataType: "json",
				success:function(data){
					if(data.status == "200")
						window.location.href = "<?php echo base_url('cms/dashboard');?>";
					else if(data.status == "204"){
						$('#message').empty();
						$('#message').append('Username and password not matched.');
					}
					else if(data.status == "205"){
						$('#message').empty();
						$('#message').append('Halaman ini khusus admin.');
					}
				}
			});
		});
    </script>
  </body>
</html>