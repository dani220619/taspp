<style>
	.table td, .table th {
		border-top: none !important;
	}
	@media print {
		h3, .sidebar, #santri, #cari-tunggakan, #cetak-tunggakan, hr, label {
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
		.table td, .table th {
			border-top: none !important;
		}
	}
</style>
<?php
	function terbilang($number) {
	    $dasar = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
	    $angka = array(1000000000, 1000000, 1000, 100, 10, 1);
	    $satuan = array('milyar', 'juta', 'ribu', 'ratus', 'puluh', '');
	 
	    $i = 0;
	    if ($number == 0) {
	    	$str = "nol";
	    } else {
			$str = "";
            
	       	while ($number != 0) {
	        	$count = (int)($number/$angka[$i]);
	      		
                if ($count >= 10) {
	          		$str .= terbilang($count)." ".$satuan[$i]." ";
      		    } elseif ($count > 0 && $count < 10) {
	          		$str .= $dasar[$count]." ".$satuan[$i]." ";
	      		}
                
			  	$number -= $angka[$i] * $count;
			  	$i++;
		   }
           
		   $str = preg_replace("/satu puluh (\w+)/i", "\\1 Belas", $str);
		   $str = preg_replace("/satu (ribu|ratus|puluh|belas)/i", "Se\\1", $str);
		}
        
		$string = $str.'';
        #ucwords agar karakter awal huruf besar
    	return ucwords($string); 
  	}
?>
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
		<h4>KWITANSI</h4>
	</center>
	<hr>
	<table class="table">
		<tbody>
			<tr>
				<td style="width: 25%;text-align: left">Telah Diterima Dari: </td>
				<td style="width: 75%;text-align: left"><strong><?= $santri->nama_santri.' (NIS: '.$santri->nis.')' ?></strong></td>
			</tr>
			<tr>
				<td style="width: 25%;text-align: left">Banyaknya Uang: </td>
				<td style="width: 75%;text-align: left"><strong><?= terbilang($pembayaran_lainnya->total_tagihan) ?> Rupiah</strong></td>
			</tr>
			<tr>
				<td style="width: 25%;text-align: left">Untuk Pembayaran: </td>
				<td style="width: 75%;text-align: left"><strong><?= $pembayaran_lainnya->jenis_pembayaran ?></strong></td>
			</tr>
			<tr>
				<td style="width: 25%;text-align: left">Jumlah Rp: </td>
				<td style="width: 75%;text-align: left"><strong><?= number_format($pembayaran_lainnya->total_tagihan, 0, ',', '.') ?>,-</strong></td>
			</tr>
		</tbody>
	</table>
	<table class="table">
	    <tbody>
			<tr>
				<td style="width: 60%;text-align: right">&nbsp;</td>
				<td style="width: 40%;text-align: center"><?= substr($pembayaran_lainnya->tanggal_bayar, 8, 2).' '.$this->db->query("SELECT nama_bulan FROM bulan WHERE id_bulan='".substr($pembayaran_lainnya->tanggal_bayar, 5, 2)."'")->row()->nama_bulan.' '.substr($pembayaran_lainnya->tanggal_bayar, 0, 4) ?></td>
			</tr>
			<tr>
				<td colspan="2" style="width: 100%;text-align: right">&nbsp;</td>
			</tr>
			<tr>
				<td style="width: 60%;text-align: right">&nbsp;</td>
				<td style="width: 40%;text-align: center"><?= $bendahara['name'] ?></td>
			</tr>
		</tbody>
	</table>
	Tgl. Cetak: <?= $tgl_cetak ?>
	</div>
</div>