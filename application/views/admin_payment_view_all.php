<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			All Customer Payment
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Order</a></li>
			<li class="active"><a href="#">View All</a></li>
		</ol>
    </section>
	
	<!-- Main content -->
    <section class="boxku">
		<div class="row">
			<?php include('message_after_transaction.php');?>
			<div class="col-xs-12">
				<ul class="nav nav-tabs">
                  <li class="active"><a href="#tab-open" data-toggle="tab">Open Payment</a></li>
                  <li><a href="#tab-validated" data-toggle="tab">Validated</a></li>
                  <li><a href="#tab-reject" data-toggle="tab">Reject</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
				<div class="tab-content">
                  <div class="tab-pane active" id="tab-open">
                    <div class="box box-info">
		                <div class="box-body">
							<table id="default-table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Bank</th>
										<th>Sender Name</th>
										<th>Transfer Date</th>
										<th>Total</th>
										<th>Note</th>
										<th>Change Status</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if($payments<>false){
										foreach($payments->result() as $row){
											if($row->status=="Open"){
									?>
									<tr>
										<td><?php echo $row->order_id;?></td>
										<td><?php echo $row->bank_name;?></td>
										<td><?php echo $row->sender_name;?></td>
										<td><?php echo date_format(new DateTime($row->transfer_date), 'd M Y');?></td>
										<td><?php echo number_format($row->total_paid, 0, '.', ',');?></td>
										<td><?php echo $row->note;?></td>
										<td>
											<select id="sel-status-<?php echo $row->payment_id;?>">
												<option value="Validated" selected>Validated</option>
												<option value="Reject">Reject</option>
											</select>
											<button onclick="change_status('<?php echo $row->payment_id;?>')">Change</button>
										</td>
									</tr>
									<?php 
											}
										}
									}
									?>	
								</tbody>
		                  	</table>
		                </div><!-- /.box-body -->
	              	</div><!-- /.box -->
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab-validated">
                    <div class="box box-success">
		                <div class="box-body">
							<table id="default-table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Bank</th>
										<th>Sender Name</th>
										<th>Transfer Date</th>
										<th>Total</th>
										<th>Note</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if($payments<>false){
										foreach($payments->result() as $row){
											if($row->status=="Validated"){
									?>
									<tr>
										<td><?php echo $row->order_id;?></td>
										<td><?php echo $row->bank_name;?></td>
										<td><?php echo $row->sender_name;?></td>
										<td><?php echo date_format(new DateTime($row->transfer_date), 'd M Y');?></td>
										<td><?php echo number_format($row->total_paid, 0, '.', ',');?></td>
										<td><?php echo $row->note;?></td>
									</tr>
									<?php 
											}
										}
									}
									?>	
								</tbody>
		                  	</table>
		                </div><!-- /.box-body -->
	              	</div><!-- /.box -->
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab-reject">
                  	<div class="box box-danger">
		                <div class="box-body">
							<table id="default-table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Bank</th>
										<th>Sender Name</th>
										<th>Transfer Date</th>
										<th>Total</th>
										<th>Note</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if($payments<>false){
										foreach($payments->result() as $row){
											if($row->status=="Reject"){
									?>
									<tr>
										<td><?php echo $row->order_id;?></td>
										<td><?php echo $row->bank_name;?></td>
										<td><?php echo $row->sender_name;?></td>
										<td><?php echo date_format(new DateTime($row->transfer_date), 'd M Y');?></td>
										<td><?php echo number_format($row->total_paid, 0, '.', ',');?></td>
										<td><?php echo $row->note;?></td>
									</tr>
									<?php 
											}
										}
									}
									?>	
								</tbody>
		                  	</table>
		                </div><!-- /.box-body -->
	              	</div><!-- /.box -->
                  </div>
                </div><!-- /.tab-content -->

				
			</div>
		</div>
	</section>
		  
</div><!-- /.content-wrapper -->

<script>
	function change_status(id){
		var status = $('#sel-status-'+id).val();
		$.ajax({
          type : "GET",
          async: false,
          url: '<?php echo base_url();?>order/change_payment_status/'+id+'/'+status,
          dataType: "json",
          success:function(data){
            if(data.status=="200")
            	window.location.assign("<?php echo base_url('cms/view_payment');?>");
            else
            	alert('Error on changing payment status');
          }
        });
	}
	
</script>

<?php include('footer.php');?>
</body>
</html>
