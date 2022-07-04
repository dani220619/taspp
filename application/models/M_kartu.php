<?php

/**
 * 
 */
class M_kartu extends CI_Model
{

	function ambil_data()
	{
		return $this->db->get('santri');
	}
	function tampil_data()
	{
		$this->db->select('*');
		$this->db->from('santri');
		$this->db->join('kelas', 'santri.id_kelas = kelas.id_kelas');
		$this->db->join('tahun_ajaran', 'santri.id_tahun = tahun_ajaran.id_tahun');
		return $query = $this->db->get();
	}

	function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function tampil_detail($where1)
	{
		$this->db->select('*');
		$this->db->from('santri');
		$this->db->join('tahun_ajaran', 'santri.id_tahun = tahun_ajaran.id_tahun');
		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}

	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	function hapus_data($where, $table)
	{
		$this->db->where($where);
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

	function tampil_datatahun()
	{
		return $this->db->get('tahun_ajaran');
	}

	function tampil_transaksi($where1)
	{
		$this->db->select('*');
		$this->db->from('transaksi1');
		$this->db->join('bulan', 'transaksi1.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'transaksi1.id_tahun = tahun_ajaran.id_tahun');
		$this->db->join('user', 'transaksi1.id = user.id');
		$this->db->where_in('nis', $where1);
		return $query = $this->db->get();
	}


	public function id_transaksi()
	{
		$this->db->select('RIGHT(transaksi1.id_transaksi,3) as id_transaksi', FALSE);
		$this->db->order_by('id_transaksi', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('transaksi1');  //cek dulu apakah ada sudah ada kode di tabel.    
		if ($query->num_rows() <> 0) {
			//cek kode jika telah tersedia    
			$data = $query->row();
			$id_transaksi = intval($data->id_transaksi) + 1;
		} else {
			$id_transaksi = 1;  //cek jika kode belum terdapat pada table
		}
		$tgl = date('dmy');
		$batas = str_pad($id_transaksi, 3, "0", STR_PAD_LEFT);
		$kodetampil = "SPP" . $tgl . $batas;  //format kode
		return $kodetampil;
	}

	public function view_by_date($date)
	{
		$this->db->where('DATE(tanggal_bayar)', $date); // Tambahkan where tanggal nya

		return $this->db->get('transaksi1')->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
	}

	public function view_by_month($month, $year)
	{
		$this->db->where('MONTH(tanggal_bayar)', $month); // Tambahkan where bulan
		$this->db->where('YEAR(tanggal_bayar)', $year); // Tambahkan where tahun

		return $this->db->get('transaksi1')->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
	}

	public function view_by_year($year)
	{
		$this->db->where('YEAR(tanggal_bayar)', $year); // Tambahkan where tahun

		return $this->db->get('transaksi1')->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
	}

	public function view_all()
	{
		return $this->db->get('transaksi1')->result(); // Tampilkan semua data transaksi
	}

	public function option_tahun()
	{
		$this->db->select('YEAR(tanggal_bayar) AS tahun'); // Ambil Tahun dari field tgl
		$this->db->from('transaksi1'); // select ke tabel transaksi
		$this->db->order_by('YEAR(tanggal_bayar)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
		$this->db->group_by('YEAR(tanggal_bayar)'); // Group berdasarkan tahun pada field tgl

		return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
	}
	function jumlahtransaksi()
	{
		$query = $this->db->get('transaksi1');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
}
