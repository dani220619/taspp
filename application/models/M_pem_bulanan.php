<?php

/**
 * 
 */
class M_pem_bulanan extends CI_Model
{
    function input_data($data, $table)
    {
        $this->db->insert($data, $table);
    }
}
