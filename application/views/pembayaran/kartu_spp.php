<style>
	@media print {

		h3,
		.sidebar,
		#santri,
		#cari-tunggakan,
		#cetak-tunggakan,
		hr,
		label {
			display: none;
		}

		.container-fluid {
			background-color: #fff;
		}

		.table {
			margin-bottom: 0;
		}

		.table-bordered {
			color: #000;
			border: 1px solid #000;
		}
	}
</style>
<div class="container-fluid">
	<button id="cetak-tunggakan" class="btn btn-success" onclick="print()">Print</button>
	<center>
		<table>
			<tr>
				<td>
					<img src="<?= base_url('assets/img/aplikasi/logo.png') ?>" style="width: 100px; height: 100px;">
				</td>
				<td>
					<center>
						<h5>PONDOK PESANTREN</h5>
						<h3>AL MUNAWWIR KRAPYAK KOMPLEK L YOGYAKARTA</h3>
						<p>Jl. KH. Ali Maksum Tromol Pos 5, Krapyak Kulon, Krapyak, Kec. Sewon, Bantul, Daerah Istimewa Yogyakarta</p>
					</center>
				</td>
			</tr>
		</table>
		<h4>KARTU SPP TAHUN AJARAN <?= $pem_bulan[0]['tahun_ajaran'] ?? $thaj ?></h4>
		<p> Nama : <?= $santri->nama_santri . ' (NIS: ' . $santri->nis . ')' ?></p>
	</center>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th style="width: 5%;text-align: center">No.</th>
				<th style="width: 15%;text-align: center">Bulan</th>
				<th style="width: 15%;text-align: center">Jumlah SPP (Rp.)</th>
				<th style="width: 20%;text-align: center">Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//echo var_dump($pem_bulan);exit;
			for ($i = 1; $i <= 12; $i++) {
				$bulan = str_pad($i, 2, "0", STR_PAD_LEFT);
				$nm_bulan = $this->db->query("SELECT nama_bulan FROM bulan WHERE id_bulan='" . $bulan . "'")->row()->nama_bulan;

				$rpspp = '';
				$ket = 'Belum Lunas';
				if (count($pem_bulan) > 0) {
					foreach ($pem_bulan as $pb) {
						if ($pb['id_bulan'] == $bulan) {
							$rpspp = number_format($pb['jumlah'], 0, ',', '.');
							$ket = 'Lunas, tgl. bayar ' . substr($pb['tanggal_bayar'], 8, 2) . '-' . substr($pb['tanggal_bayar'], 5, 2) . '-' . substr($pb['tanggal_bayar'], 0, 4);
						}
					}
				}

				echo '<tr>
							<td style="text-align: center;">' . $i . '</td>
							<td style="text-align: center;">' . $nm_bulan . '</td>
							<td style="text-align: right;">' . $rpspp . '</td>
							<td style="text-align: left;">' . $ket . '</td>
						  </td>';
			}
			?>
		</tbody>
	</table>
	Tgl. Cetak: <?= $tgl_cetak ?>
</div>
</div>