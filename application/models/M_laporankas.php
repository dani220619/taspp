<?php

/**
 * 
 */
class M_laporankas extends CI_Model
{
    /*LAPORAN TRANSAKSI*/
    function tampil_data()
	{
		$this->db->select('*');
		$this->db->from('kas_masuk');
		return $query = $this->db->get();
	}

	public function view_by_date($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('kas_masuk');
		return $query = $this->db->get()->result();
	}

	public function kas_masuk()
	{
		$this->db->select('*');
		$this->db->from('kas_masuk');
		return $query = $this->db->get()->result();
	}

	public function kas_keluar()
	{
		$this->db->select('*');
		$this->db->from('kas_keluar');
		return $query = $this->db->get()->result();
	}

	public function view_by_nis($nis)
	{
		$this->db->select('*');
		$this->db->from('spp_bulanan');
		$this->db->join('santri', 'spp_bulanan.nis = santri.nis');
		$this->db->join('bulan', 'spp_bulanan.id_bulan = bulan.id_bulan');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = spp_bulanan.id_tahun');
		$this->db->join('bendahara', 'spp_bulanan.id = bendahara.id_bendahara');
		$this->db->where('spp_bulanan.nis', $nis);
		$this->db->order_by('spp_bulanan.id_tahun');
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
		$this->db->order_by('spp_bulanan.id_tahun');
		return $query = $this->db->get();
	}

	function view_all()
	{
		$this->db->select('*');
		$this->db->from('kas_keluar');
		return $query = $this->db->get()->result();
	}

	function update_tunggakan($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
