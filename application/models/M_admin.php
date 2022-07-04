<?php

/**
 * 
 */
class M_admin extends CI_Model
{

    function ambil_data()
    {
        return $this->db->get('bendahara');
    }
    function tampil_data()
    {
        return $this->db->get('bendahara');
    }
    function tampil_datalevel()
    {
        return $this->db->get('user_role');
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
    public function delet_user($id_bendahara)
    {
        $this->db->where('id_bendahara', $id_bendahara);
        $this->db->delete('bendahara');
    }
    function jumlahuser()
    {
        $query = $this->db->get('bendahara');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function delete_by_id($id_bendahara)
    {
        $this->db->where('id_bendahara', $id_bendahara);
        $this->db->delete($this->table);
    }
}
