<?php

/**
 * 
 */
class M_kasmasuk extends CI_Model
{

	function ambil_data()
	{
		return $this->db->get('kas_masuk');
	}
	function tampil_data()
	{
		$this->db->select('*');
		$this->db->from('kas_masuk');
		return $query = $this->db->get();
	}

	public function view_by_date($tgl_awal, $tgl_akhir)
	{
		$this->db->select('*');
		$this->db->from('kas_masuk');
		$this->db->where('tgl_transaksi BETWEEN"' . date('Y-m-d', strtotime($tgl_awal)) . '"and"' . date('Y-m-d', strtotime($tgl_akhir)) . '"');
		$this->db->order_by('tgl_transaksi');
		return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
	}



	function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}
	function edit_data($where1, $table)
	{
		return $this->db->get_where($table, $where1);
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
	function jumlahkas_masuk()
	{
		$this->db->select('nominal');
		$this->db->from('kas_masuk');
		$this->db->order_by('keterangan desc');
		$this->db->get();
	}
	
}
