<?php

/**
 * 
 */
class M_kelas extends CI_Model
{

	function ambil_data()
	{
		return $this->db->get('kelas');
	}
	function tampil_data()
	{
		return $this->db->get('kelas');
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
	function jumlahkelas()
	{
		$query = $this->db->get('kelas');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
}
