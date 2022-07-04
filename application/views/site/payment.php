<h3>Pembayaran</h3>

<table class="table table-hover">
	<tr>
		<td>ID Pesanan</td><td><?php echo  $transaction->order_id; ?></td>
	</tr>
	<tr>
		<td>Status Pembayaran</td>
		<td>
			<?php 
			if ($transaction->status_code == 200) {
				echo 'Selesai';
			} elseif ($transaction->status_code == 201) { 
				echo 'Menunggu';
			} else {
				echo 'Gagal';
			}
			?>
		</td>
	</tr>
</table>