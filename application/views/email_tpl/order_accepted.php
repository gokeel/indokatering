<html>
	<body>
		<p>Hai <?php echo $first_name.($last_name<>'' ? ' '.$last_name : '');?>,</p>
		<p></p>
		<p>Kami telah memvalidasi pemesanan anda dengan detail berikut:<br />
		ID Pesanan: <?php echo $order_id;?>
		</p>
		<p>Total Harga: Rp <?php echo number_format($total_price, 0, ',', '.');?></p>
		<p></p>
		<p>Terima kasih telah bertransaksi dengan kami.</p>
		<p></p><br /><br />
		<p>Salam,<br />
			Admin IndoKatering.com</p>
	</body>
</html>