<?php foreach (array_chunk($katalog, 3) as $cluster) : ?>
	<div class="grids_of_3">
	<?php 
		foreach ($cluster as $data) : 
		$images = $this->foto_katalog_model->get_where(array('id_katalog' => $data['id']));
	?>
		<div class="grid1_of_3">
			<a href="<?php echo base_url('site/katalog/'.$data['id']) ?>" style="text-decoration: none;">
				<img src="<?php echo (!empty($images))?base_url('uploads/katalog_produk/'.$images[0]['foto']):'https://via.placeholder.com/200x200/?text=Tailor' ?>" alt="<?php echo $data['nama'] ?>" style="max-height: 200px;">
				<h3><?php echo $data['nama']; ?></h3>
				<div class="price">
					<h4>Waktu Pengerjaan <small><?php echo timespan(human_to_unix($data['tanggal_pemesanan'].' 00:00'), human_to_unix($data['tanggal_selesai'].' 00:00'), 2); ?></small></h4>
				</div>
				<span class="b_btm"></span>
			</a>
		</div>
	<?php endforeach; ?>
	<div class="clear"></div>
	</div>
<?php endforeach; ?>