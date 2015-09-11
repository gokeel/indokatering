		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0
			</div>
			<strong>Copyright &copy; 2015 <a href="http://licosyd.com">Licosyd</a>.</strong> All rights reserved. <strong>Admin Template by <a href="http://almsaeedstudio.com">Almsaeed Studio</a></strong>
		</footer>
	  
	</div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABLES SCRIPT -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo ADMIN_LTE_DIR;?>/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<!-- iCheck 1.0.1 -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo ADMIN_LTE_DIR;?>/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo ADMIN_LTE_DIR;?>/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <!--<script src="<?php echo ADMIN_LTE_DIR;?>/dist/js/demo.js" type="text/javascript"></script>-->
	<!-- My Custom Function -->
	<script src="<?php echo GENERAL_JS_DIR;?>/functions.js" type="text/javascript"></script>
	<!-- Bootstrap Datetimepicker -->
	<script type="text/javascript" src="<?php echo GENERAL_JS_DIR;?>/moment.js"></script>
	<script type="text/javascript" src="<?php echo GENERAL_JS_DIR;?>/bootstrap-datetimepicker.js"></script>
	<!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#default-table").dataTable({
			"bSort": false,
			"iDisplayLength": 25,
			"bLengthChange": true
		});
      });
	  //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
		
		
    </script>

