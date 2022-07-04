<?php

/**
 * 
 */
class M_laporankasmasuk extends CI_Model
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
    function tampil_laporan()
	{
		$this->db->select('*');
		$this->db->from('kas_masuk');
		return $query = $this->db->get();
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
	function jumlahkaskeluar()
	{
		$query = $this->db->get('kas_masuk');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
}
