<!-- <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo GENERAL_CSS_DIR;?>/jquery.tagsinput.css" /> -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Order Detail
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Order</a></li>
			<li class="active"><a href="#">Detail</li>
		</ol>
    </section>
	
	<!-- Main content -->
    <section class="boxku">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">
		          	<div class="box-header">
						<h3 class="box-title">Summary
						</h3>
		          	</div><!-- /.box-header -->
		          	<div class="box-body no-padding">
						<div class="row">
							<div class="col-md-6">
								<label class="col-md-4 text-left">Order ID</label>
								<p class="col-md-8"><?php echo $header->order_id;?></p>

								<label class="col-md-4 text-left">Total Items</label>
								<p class="col-md-8"><?php echo $header->total_items;?></p>

								<label class="col-md-4 text-left">Total Price</label>
								<p class="col-md-8"><?php echo number_format($header->total_price, 0, '.', ',');?></p>

								<label class="col-md-4 text-left">Status</label>
                				<p class="col-md-8"><?php echo $header->order_status;?></p>
							</div>
							<div class="col-md-6">
								<label class="col-md-4 text-left">User ID</label>
								<p class="col-md-8"><?php echo $header->user_id;?></p>

								<label class="col-md-4 text-left">Email</label>
								<p class="col-md-8"><?php echo $header->email_login;?></p>

								<label class="col-md-4 text-left">Customer Name</label>
								<p class="col-md-8"><?php echo $header->first_name.($header->last_name<>"" ? ' '.$header->last_name : '');?></p>
							</div>
						</div>
		          	</div><!-- /.box-body -->
		        </div><!-- /.box -->
			</div><!-- /.col -->
			<div class="col-xs-12">
				<div class="box box-success">
		          	<div class="box-header">
						<h3 class="box-title">Detail
						</h3>
		          	</div><!-- /.box-header -->
		          	<div class="box-body no-padding">
						<table class="table table-striped">
		                    <tr>
		                      <th style="width: 10px">#</th>
		                      <th>Image</th>
		                      <th>Product</th>
		                      <th>Price</th>
		                      <th>Quantity</th>
		                      <th>Total</th>
		                    </tr>
		                    <?php 
		                    	$cnt = 0;
		                    	foreach($detail as $item){ 
		                    		$cnt+=1;
		                    ?>
		                    <tr>
		                      <td><?php echo $cnt;?>.</td>
		                      <td>
		                      	<img src="<?php echo $this->config->item('upload_path').$item['image'];?>" width="40" height="50">
		                      </td>
		                      <td><?php echo $item['title'];?></td>
		                      <td>
		                      	<?php 
		                      		if(intval($item['price'] < 1000))
		                      			echo number_format($item['price'], 0, '.', ',').' poin';
		                      		else
		                      			echo 'Rp '.number_format($item['price'], 0, '.', ',');
		                      	?>
		                      </td>
		                      <td><?php echo $item['qty'];?></td>
		                      <td>
		                      	<?php if(intval($item['total'] < 1000))
		                      			echo number_format($item['total'], 0, '.', ',').' poin';
		                      		else
		                      			echo 'Rp '.number_format($item['total'], 0, '.', ',');
		                      	?>
		                      </td>
		                    </tr>
		                    <?php } ?>
		                </table>
		          	</div><!-- /.box-body -->
		        </div><!-- /.box -->
			</div><!-- /.col -->
			<div class="col-xs-12">
				<div class="box box-warning">
		          	<div class="box-header">
						<h3 class="box-title">Shipping Information
						</h3>
		          	</div><!-- /.box-header -->
		          	<div class="box-body no-padding">
						<div class="row">
							<div class="col-md-6">
								<label class="col-md-4 text-left">Recipient</label>
								<p class="col-md-8"><?php echo $ship->first_name.($ship->last_name<>"" ? ' '.$ship->last_name : '');?></p>

								<label class="col-md-4 text-left">Address 1</label>
								<p class="col-md-8"><?php echo $ship->address_1;?></p>

								<label class="col-md-4 text-left">Address 2</label>
								<p class="col-md-8"><?php echo $ship->address_2;?></p>

								<label class="col-md-4 text-left">City & Province</label>
								<p class="col-md-8"><?php echo $ship->city.','.$ship->province;?></p>
							</div>
							<div class="col-md-6">
								<label class="col-md-4 text-left">Zip Code</label>
								<p class="col-md-8"><?php echo $ship->zip_code;?></p>

								<label class="col-md-4 text-left">Phone</label>
								<p class="col-md-8"><?php echo $ship->phone;?></p>

								<label class="col-md-4 text-left">Notes</label>
								<p class="col-md-8"><?php echo $ship->notes;?></p>
							</div>
						</div>
		          	</div><!-- /.box-body -->
		        </div><!-- /.box -->
			</div><!-- /.col -->
		</div> <!-- ./row -->
		
	</section>
		  
</div><!-- /.content-wrapper -->

<?php include('footer.php');?>

</body>
</html>
