<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			All Customer Order
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
				<div class="box box-info">
                <div class="box-header">
					List
                </div><!-- /.box-header -->
                <div class="box-body">
					<table id="default-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Total Item</th>
								<th>Grand Total</th>
								<th>Order Status</th>
								<th>Ordering Date</th>
								<th>Email</th>
								<th>Name</th>
								<th>Action</th>
								<th>Change Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if($orders<>false)
								foreach($orders->result() as $row){?>
							<tr>
								<td><?php echo $row->order_id;?></td>
								<td><?php echo $row->total_items;?></td>
								<td><?php echo number_format($row->total_price, 0, '.', ',');?></td>
								<td><span class="replace_status_<?php echo $row->order_id;?>"><?php echo $row->order_status;?></span></td>
								<td><?php echo date_format(new DateTime($row->entry_date), 'd M Y H:i:s');?></td>
								<td><?php echo $row->email_login;?></td>
								<td><?php echo $row->first_name.($row->last_name<>"" ? ' '.$row->last_name : '');?></td>
								<td>
									<a href="<?php echo base_url('cms/view_order_detail/'.$row->order_id);?>">
										<button class="btn btn-primary btn-xs">
											<i class="fa fa-arrow-circle-right"></i> View Detail
										</button>
									</a>
								</td>
								<td>
									<?php if($row->order_status=="Open"){ ?>
									<select id="sel-status-<?php echo $row->order_id;?>">
										<option value="Accept" selected>Accept</option>
										<option value="Reject">Reject</option>
										<option value="Close">Close</option>
									</select>
									<button onclick="change_order_status('<?php echo $row->order_id;?>')">Change</button>
									<?php }
										else echo '<i class="fa fa-ban" style="color:red"></i>';
									 ?>
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

<script>
	function change_order_status(order_id){
		var status = $('#sel-status-'+order_id).val();
		$.ajax({
          type : "GET",
          async: false,
          url: '<?php echo base_url();?>order/change_order_status/'+order_id+'/'+status,
          dataType: "json",
          success:function(data){
            if(data.status=="200"){
            	$('.replace_status_'+order_id).text(status);
            	$('#sel-status-'+order_id).val(status);
            	if(status=="Accept")
            		adjust_point(order_id);
            }
            else
            	alert('Error on changing order status');
          }
        });
	}

	function adjust_point(order_id){
		$.ajax({
          type : "GET",
          async: false,
          url: '<?php echo base_url();?>order/adjust_point_to_user/'+order_id,
          dataType: "json",
          success:function(data){
            alert('Data poin user sudah diproses (*jika memiliki transaksi poin)');
          }
        });
	}
	
</script>

<?php include('footer.php');?>
</body>
</html>
