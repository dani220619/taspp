<?php

/**
 * 
 */
class M_transaksi extends CI_Model
{
	public function view()
	{
		return $this->db->get('spp_bulanan')->result();
	}
	public function session_tahun()
	{
		$this->db->select('*');
		$this->db->from('tahun_ajaran');
		$this->db->where_in('Status', 'ON');
		return $query = $this->db->get();
	}


	public function save_batch($data)
	{
		return $this->db->insert_batch('spp_bulanan', $data);
	}
	public function save_pem_bulanan($data)
	{
		return $this->db->insert_batch('pembayaran_bulanan', $data);
	}
	public function save_pem_lainya($data)
	{
		return $this->db->insert_batch('pembayaran_lainnya', $data);
	}
	public function save_thn_aktif($data)
	{
		return $this->db->insert_batch('tahun_aktif', $data);
	}

	function ambil_data()
	{
		return $this->db->get('santri');
	}


	function input_data($data)
	{
		$this->db->insert('pembayaran_bulanan', $data);
	}

	function multisave($key, $id_transaksi, $nis, $nama_santri, $id_tahun, $tgl_bayar, $metode_pembayaran, $id)
	{
		$query = "insert into spp_bulanan values($key, $id_transaksi, $nis, $nama_santri, $id_tahun, $tgl_bayar, $metode_pembayaran, $id)";
		$this->db->query($query);
	}


	function copy_input($where)
	{
		$this->db->query('INSERT INTO hapus_transaksi (id_transaksi,nis,id_bulan,id_tahun,tanggal_bayar,id_bendahara)
                      SELECT id_transaksi,nis,id_bulan,id_tahun,tanggal_bayar,id
                      FROM spp_bulanan WHERE id_transaksi = \'' . $where . '\'');
	}

	function pem_bulan($where1)
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'spp_bulanan.id_tahun = tahun_ajaran.id_tahun');
		$this->db->where_in('nis', $where1);
		$this->db->order_by('spp_bulanan.id_tahun,spp_bulanan.id_bulan', 'ASC');
		return $query = $this->db->get();
	}


	public function jumlah_spp($where1, $th_ajaran)
	{

		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('tahun_ajaran', 'spp_bulanan.besar_spp=tahun_ajaran.besar_spp');
	}
	function pem_bulan_santri($where1)
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'spp_bulanan.id_tahun = tahun_ajaran.id_tahun');
		$this->db->where_in('nis', $where1);
		$this->db->order_by('spp_bulanan.id_tahun,spp_bulanan.id_bulan', 'ASC');
		return $query = $this->db->get();
	}

	function tampil_detail($where1)
	{
		$this->db->select('*');
		$this->db->from('santri');
		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}
	function tampil_detail_spp($where1)
	{
		$this->db->select('*');
		$this->db->from('santri');
		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}
	function tampil_data()
	{
		$this->db->select('*');
		$this->db->from('santri');
		return $query = $this->db->get();
	}
	function tampil_data_spp($where1)
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'spp_bulanan.id_tahun = tahun_ajaran.id_tahun');
		$this->db->join('bendahara', 'spp_bulanan.id = bendahara.id_bendahara');
		$this->db->where_in('nis', $where1);
		$this->db->order_by('spp_bulanan.id_tahun,spp_bulanan.id_bulan', 'ASC');
		return $query = $this->db->get();
	}
	function tampil_pem_bulanan()
	{
		$this->db->select('*');
		$this->db->from('pembayaran_bulanan');
		// $this->db->join('santri', 'pembayaran_bulanan.nis = pembayaran_bulanan.nis');
		// $this->db->join('tahun_ajaran', 'pembayaran_bulanan.id_tahun = pembayaran_bulanan.id_tahun');
		// $this->db->order_by('santri.nis', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	function hapus_data($where2, $table)
	{
		$this->db->where($where2);
		$this->db->delete($table);
	}
	function cek_login($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	function ambil_databulan()
	{
		return $this->db->get('bulan');
	}

	function tampil_databulan()
	{
		return $this->db->get('bulan');
	}
	function tampil_data_bulan()
	{
		return $this->db->get('bulan');
	}
	function tampil_datatahun()
	{
		$this->db->select('*');
		$this->db->from('tahun_ajaran');

		$this->db->where_in('Status', 'ON');
		return $query = $this->db->get();
	}
	// function tampil_datatahun($where)
	// {
	// 	return $this->db->get('tahun_ajaran');
	// 	$this->db->query('SELECT tahun_ajaran.id_tahun, tahun_ajaran.tahun_ajaran, tahun_ajaran.besar_spp FROM tahun_ajaran JOIN tahun_aktif ON tahun_ajaran.id_tahun=tahun_aktif.id_tahun WHERE nis=\'' . $where . '\'');
	// }
	function jumlahsppbulanan()
	{
		$query = $this->db->get('spp_bulanan');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
	function jmlh_spp_bulanan()
	{
		return $this->db->query("SELECT sum(jumlah) from spp_bulanan");
	}

	public function spp_bulanan()
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('bendahara', 'spp_bulanan.id = bendahara.id_bendahara');
		$this->db->join('tahun_ajaran', 'spp_bulanan.id_tahun = tahun_ajaran.id_tahun');
		return $query = $this->db->get();
	}
	public function pembayaran_bulanan($where1)
	{
		$this->db->select('*');
		$this->db->from('pembayaran_bulanan');

		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}
	public function hitungJumlahAsset($where1)
	{
		$query = $this->db->get('pembayaran_bulanan');
		$this->db->where_in('nis', $where1);
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function pembayaran_lainnya($where1)
	{
		$this->db->select('*');
		$this->db->from('pembayaran_lainnya');
		// $this->db->join('bendahara', 'pembayaran_lainnya.id = bendahara.id_bendahara');
		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}

	function tampil_transaksi($where1)
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'spp_bulanan.id_tahun = tahun_ajaran.id_tahun');
		$this->db->join('bendahara', 'spp_bulanan.id = bendahara.id_bendahara');
		$this->db->where_in('nis', $where1);
		$this->db->order_by('spp_bulanan.id_tahun,spp_bulanan.id_bulan', 'ASC');
		return $query = $this->db->get();
	}

	function tampil_xtrans($where1)
	{
		$this->db->select('*');
		$this->db->from('hapus_transaksi');
		$this->db->join('bulan', 'hapus_transaksi.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'hapus_transaksi.id_tahun = tahun_ajaran.id_tahun');
		$this->db->join('bendahara', 'hapus_transaksi.id_bendahara = bendahara.id_bendahara');
		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}

	public function id_transaksi()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(id_transaksi,3)) AS kd_max FROM spp_bulanan WHERE DATE(tanggal_bayar)=CURDATE()");
		$kd = 1;
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int) $k->kd_max) + 1;
				$kd = sprintf("%03s", $tmp);
			}
		} else {
			$kd++;
		}
		$kode = "SPP-";
		date_default_timezone_set('Asia/Jakarta');
		return $kode . date('dmy') . $kd;
	}

	/*LAPORAN TRANSAKSI*/

	public function view_by_date($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('santri', 'spp_bulanan.nis = santri.nis');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = spp_bulanan.id_tahun');
		$this->db->join('bendahara', 'spp_bulanan.id = bendahara.id_bendahara');
		$this->db->where('tanggal_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
		$this->db->order_by('tanggal_bayar');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}

	public function nis()
	{
		$this->db->select('*');
		$this->db->from('santri');
		return $query = $this->db->get()->result();
	}

	public function tahun()
	{
		$this->db->select('*');
		$this->db->from('tahun_ajaran');

		return $query = $this->db->get()->result();
	}

	public function view_by_nis($nis)
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('santri', 'spp_bulanan.nis = santri.nis');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = spp_bulanan.id_tahun');
		// $this->db->join('bendahara', 'spp_bulanan.id = bendahara.id_bendahara');
		$this->db->where('spp_bulanan.nis', $nis);
		$this->db->order_by('santri.nama_santri');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}

	public function view_by_year($tahun)
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('santri', 'spp_bulanan.nis = santri.nis');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = spp_bulanan.id_tahun');
		$this->db->join('bendahara', 'spp_bulanan.id = bendahara.id_bendahara');
		$this->db->where('spp_bulanan.id_tahun="' . $tahun . '"');
		$this->db->order_by('santri.nama_santri');
		return $query = $this->db->get();
	}

	function view_all()
	{

		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('santri', 'santri.nis = spp_bulanan.nis');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = spp_bulanan.id_tahun');
		$this->db->where('spp_bulanan.status', '0');
		$this->db->order_by('id_transaksi');
		return $this->db->get()->result();
	}

	public function laporan_kas_umum()
	{
		$this->db->select('*');
		$this->db->from('kas');
		$this->db->order_by('tgl_transaksi', 'DESC');
		return $this->db->get()->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  

	}
	public function kas_umum_laporan($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('kas');
		$this->db->where('tgl_transaksi BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
		$this->db->order_by('tgl_transaksi', 'DESC');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}
	public function kas_masuk($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('kas');
		$this->db->where('jenis_kas', 'Kas Masuk');
		$this->db->where('tgl_transaksi BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
		$this->db->order_by('tgl_transaksi', 'DESC');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}
	public function kas_keluar($tanggal1, $tanggal2)
	{
		$this->db->select('id_kas, tgl_transaksi, keterangan, uang_masuk, uang_keluar, jenis_kas');
		$this->db->from('kas');
		$this->db->where('jenis_kas', 'Kas Keluar');
		$this->db->where('tgl_transaksi BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
		$this->db->order_by('tgl_transaksi', 'DESC');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}
	public function per_tahun()
	{
		$sql = "SELECT YEAR(tgl_transaksi) FROM kas";
		$this->db->query($sql)->row_array();
	}
	public function view_tahun($tahun)
	{
		$this->db->select('*');
		$this->db->from('kas');
		$this->db->where('tgl_transaksi="' . $tahun . '"');
		$this->db->order_by('tgl_transaksi');
		return $query = $this->db->get();
	}

	function laporan_lainnya()
	{

		$this->db->select('*');
		$this->db->from('pembayaran_lainnya');
		$this->db->join('santri', 'santri.nis = pembayaran_lainnya.nis');
		$this->db->where('status_bayar', '0');
		$this->db->order_by('id_pem_lainya');
		return $this->db->get()->result();
	}
	public function tanggal_lainya($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('pembayaran_lainnya');
		$this->db->join('santri', 'pembayaran_lainnya.nis = santri.nis');
		$this->db->where('status_bayar', '0');
		$this->db->where('tanggal_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
		$this->db->order_by('tanggal_bayar');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}
	public function nis_lainya($nis)
	{
		$this->db->select('*');
		$this->db->from('pembayaran_lainnya');
		$this->db->join('santri', 'pembayaran_lainnya.nis = santri.nis');
		$this->db->where('status_bayar', '0');
		$this->db->where('pembayaran_lainnya.nis', $nis);
		$this->db->order_by('santri.nama_santri');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}
	public function year_lainya($tahun)
	{
		$this->db->select('*');
		$this->db->from('pembayaran_lainnya');
		$this->db->join('santri', 'pembayaran_lainnya.nis = santri.nis');
		$this->db->where('tahun_ajaran="' . $tahun . '"');
		$this->db->order_by('tahun_ajaran');
		return $query = $this->db->get();
	}
	public function year_lain($tahun)
	{

		return $this->db->query("SELECT YEAR(a.tanggal_bayar), a.id_pem_lainya, a.nis, b.nama_santri, a.jenis_pembayaran, a.tanggal_bayar, a.total_tagihan, a.metode_pembayaran
		FROM pembayaran_lainnya a, santri b
		WHERE YEAR(a.tanggal_bayar) = $tahun
		GROUP BY YEAR(a.tanggal_bayar)
		");
	}



	function update_tunggakan($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
