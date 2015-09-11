<html>
	<body>
		<p>Hai <?php echo $first_name.($last_name<>'' ? ' '.$last_name : '');?>,</p>
		<p></p>
		<p>Pesanan anda telah kami terima dengan detil berikut:<br />
		ID Pesanan: <?php echo $order_id;?>
		</p>
		<p>Total Harga: <?php echo $total_price;?></p>
		<p></p>
		<p><u>Silahkan mengirim ke salah satu bank terdaftar berikut:</u></p>
		<?php
		foreach ($bank as $row){
			if($row->bank_branch == "")
				$branch = "";
			else
				$branch = '<br/>Cabang '.$row->bank_branch.($row->bank_city == "" ? "" : $row->bank_city);
			echo '<ul style="list-style-type: square">';
			echo '<li><b>'.$row->bank_name.'</b><br/>a/n. '.$row->bank_holder_name.'<br/>No. Rekening '.$row->bank_account_number.$branch;
			echo '</ul><br />';
		}
		?>
		<p></p><br /><br />
		<p>Gunakan link berikut untuk membantu anda.</p>
		<p><a href="<?php echo base_url();?>frontpage/payment_confirmation">Konfirmasi Pembayaran</a></p>
		<p></p>
		<p>Salam,<br />
			Admin IndoKatering.com</p>
	</body>
</html>