<div class="row">
	<div class="col-lg-12">
		<h1>Detail Transaksi #<?php echo $pesanan['uid'] ?></h1>
	</div>
	<div class="col-lg-6">
		<h3>Desain</h3>
		<?php foreach ($this->desain_pesanan_model->get_where(array('pesanan' => $pesanan['id'])) as $value) : ?>
			<div class="col-lg-4 col-md-4 col-xs-6 thumb">
				<img class="img-thumbnail" src="<?php echo base_url($value['foto']) ?>" alt="Another alt text">
			</div>
		<?php endforeach; ?>
	</div>
	<div class="col-lg-6">
		<h3>Detail</h3>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<th>No</th>
				<th>Bahan</th>
				<th>Warna</th>
				<th>Ukuran</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
			</thead>
			<tbody>
				<?php
				$i = 1;
				foreach ($this->detail_pesanan_model->get_where(array('pesanan' => $pesanan['id'])) as $value) :
					$bahan = $this->bahan_baju_model->view($value['bahan']);
					$ukuran = $this->ukuran_baju_model->view($value['ukuran']);
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $bahan['jenis'] ?></td>
						<td><?php echo $bahan['warna'] ?></td>
						<td><?php echo $ukuran['nama'] ?></td>
						<td><?php echo $value['jumlah'] ?></td>
						<td><?php echo $value['subtotal'] ?></td>
					</tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="col-lg-6 div_payment_info">
		<table class="table table-hover table-bordered">
			<tbody id="payment_info"></tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$.ajax({
			url: '<?php echo base_url('payment/cek_status/' . $pesanan['uid']) ?>',
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				if (data.status == 'success') {
					if (data.data.payment_type == 'credit_card') {
						console.log(data)
						$('#payment_info').append('<tr><td>Metode Pembayaran</td><td>Kartu Kredit</td></tr>');
						$('#payment_info').append('<tr><td>Jumlah Pembayaran</td><td>Rp.' + data.data.gross_amount + '</td></tr>');
						if (data.data.fraud_status == 'accept') {
							$('#payment_info').append('<tr><td>Status Pembayaran</td><td>Telah Dibayar</td></tr>');
						}
					} else if (data.data.payment_type == 'cstore') {
						$('#payment_info').append('<tr><td>Metode Pembayaran</td><td>' + data.data.store + '</td></tr>');
						$('#payment_info').append('<tr><td>Jumlah Pembayaran</td><td>Rp.' + data.data.gross_amount + '</td></tr>');
						$('#payment_info').append('<tr><td>Kode Pembayaran</td><td>' + data.data.payment_code + '</td></tr>');
						$('#payment_info').append('<tr><td>Status Pembayaran</td><td>' + data.data.transaction_status + '</td></tr>');
					} else if (data.data.payment_type == 'bank_transfer') {
						$('#payment_info').append('<tr><td>Metode Pembayaran</td><td>Bank Transfer</td></tr>');
						$('#payment_info').append('<tr><td>Jumlah Pembayaran</td><td>Rp.' + data.data.gross_amount + '</td></tr>');
						$('#payment_info').append('<tr><td>Status Pembayaran</td><td>' + data.data.transaction_status + '</td></tr>');
					} else {
						console.log(data)
					}
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	});
</script>