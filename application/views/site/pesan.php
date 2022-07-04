<div class="row">
	<div class="col-lg-12">
	<?php 
	if ($this->session->flashdata('flash_message'))
	{
		?>
			<div class="alert alert-<?php echo $this->session->flashdata('flash_message')['status'] ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('flash_message')['message'] ?>
			</div>
		<?php
	}
	?>
	</div>
	<?php if ($this->session->userdata('desain_pesanan')) : ?>
	<div class="col-lg-4">
		<?php foreach ($this->session->userdata('desain_pesanan') as $value) : ?>
			<img src="<?php echo base_url($value) ?>" class="img-responsive img-thumbnail" style="height: 200px;">
		<?php endforeach; ?>
	</div>
	<div class="col-lg-3">
		<form action="<?php echo base_url('site/keranjang/add') ?>" method="post">
			<div class="form-group">
				<label>Bahan</label>
				<select class="form-control" name="bahan">
					<option value="">Pilih Bahan</option>
					<?php foreach ($this->bahan_baju_model->list() as $value) : ?>
						<option value="<?php echo $value['id'] ?>" <?php echo set_value('bahan') == $value['id']?'selected':'' ?>><?php echo $value['jenis'].' - '.$value['warna'] ?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('bahan', '<span class="help-block error">', '</span>'); ?>
			</div>
			<div class="form-group">
				<label>Ukuran</label>
				<select class="form-control" name="ukuran">
					<option value="">Ukuran</option>
					<?php foreach ($this->ukuran_baju_model->list() as $value) : ?>
						<option value="<?php echo $value['id'] ?>" <?php echo set_value('ukuran') == $value['id']?'selected':'' ?>><?php echo $value['nama'] ?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('ukuran', '<span class="help-block error">', '</span>'); ?>
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" name="jumlah" min="1" max="10000" class="form-control" placeholder="Jumlah Pesanan" value="<?php echo set_value('jumlah') ?>">
				<?php echo form_error('jumlah', '<span class="help-block error">', '</span>'); ?>
			</div>
			<div class="form-group">
				<label>Harga : <span id="harga"></span></label>
			</div>
			<input type="hidden" name="harga_satuan">
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6">
						<button class="btn btn-block btn-primary" type="button" id="cek_harga">Cek Harga</button>
					</div>
					<div class="col-lg-6">
						<button class="btn btn-block btn-success" type="submit">Masukkan Keranjang</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="col-lg-4">
		<form action="<?php echo base_url('site/keranjang/process') ?>" method="post">
			<table class="table table-hover table-bordered">
				<thead>
					<th>No</th>
					<th>Bahan</th>
					<th>Warna</th>
					<th>Ukuran</th>
					<th>Jumlah</th>
					<th>Harga</th>
					<th>Subtotal</th>
					<th>Hapus</th>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					foreach ($this->cart->contents() as $value) : ?>
						<tr>
							<td><center><?php echo $i ?></center></td>
							<td><center><?php echo $value['options']['bahan'] ?></center></td>
							<td><center><?php echo $value['options']['warna'] ?></center></td>
							<td><center><?php echo $value['options']['ukuran'] ?></center></td>
							<td><center><?php echo $value['qty'] ?></center></td>
							<td><center>Rp.<?php echo number_format($value['price'], 0, ',', '.') ?></center></td>
							<td><center>Rp.<?php echo number_format($value['subtotal'], 0, ',', '.') ?></center></td>
							<td><center><a  href="<?php echo base_url('site/keranjang/delete/'.$value['rowid']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></center></td>
						</tr>
					<?php 
					$i++;
					endforeach;
					?>
					<tr>
						<td colspan="4"><center>Jumlah Total</center></td>
						<td colspan="4"><b class="pull-right" style="margin-right: 22%;">Rp.<?php echo number_format($this->cart->total(), 0, ',', '.'); ?></b></td>
					</tr>
					<tr>
						<td colspan="8"><textarea class="form-control" placeholder="Catatan untuk admin" name="catatan"></textarea></td>
					</tr>
					<tr>
						<td colspan="8">
							<select class="form-control" name="metode_pembayaran">
								<option value="">Pilih Metode Pembayaran</option>
								<option value="midtrans">Online</option>
								<option value="cod">Bayar Ditempat</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="8">
							<div class="col-lg-6">
								<center><a href="<?php echo base_url('site/keranjang/truncate') ?>" class="btn btn-block btn-danger">Batalkan Pesanan</a></center>
							</div>
							<div class="col-lg-6">
								<center>
									<button type="submit" class="btn btn-block btn-success">Proses Pesanan</button>
								</center>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<?php else: ?>
	<form action="<?php echo base_url('site/upload_design') ?>" method="post" enctype="multipart/form-data">
		<div class="col-lg-4">
			<div class="form-group">
				<label>Unggah Desain</label>
				<input type="file" name="desain[]" class="form-control" multiple="true">
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-4">
						<button class="btn btn-block btn-success" type="submit">Lanjutkan</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<?php endif; ?>
</div>

<script type="text/javascript">
function cek_harga(bahan, ukuran, jumlah) {
	$.ajax({
		url: '<?php echo base_url('site/cek_harga') ?>',
		type: 'POST',
		dataType: 'JSON',
		data: {
			bahan: bahan,
			ukuran: ukuran,
			jumlah: jumlah
		},
		success: function(data) {
			if (data.status == 'success') {
				$('#harga').text('Rp.'+data.data.harga*jumlah);
				$('input[name="harga_satuan"]').val(data.data.harga);
			} else {
				$('#harga').text('Belum diketahui');
				$('input[name="harga_satuan"]').val(0);
			}
		},
		error: function(error) {
			console.log(error)
		}
	});
}

$(document).on('click', '#cek_harga', function(event) {
	event.preventDefault();
	var ukuran = $('select[name="ukuran"]').children('option:selected').val();
	var bahan = $('select[name="bahan"]').children('option:selected').val();
	var jumlah = $('input[name="jumlah"]').val();
	cek_harga(bahan, ukuran, jumlah);
});
</script>