<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('m_pengguna');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Data pengguna';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['pengguna'] = $this->m_pengguna->tampil_data()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('pengguna/index', $data1);
        $this->load->view('template/footer');
    }
    function tambah_aksi()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $data = array(
            'id' => $id,
            'role' => $role
        );
        $this->m_pengguna->input_data($data, 'user_role');
        $this->session->set_flashdata('message15', '<div class="alert alert-success" role="alert">
        
        Tambah Pengguna Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('pengguna');
    }
    public function deletePengguna()
    {
        $id = $this->input->get('id');
        $this->db->delete('user_role', array('id' => $id));
        $this->session->set_flashdata('message15', '<div class="alert alert-danger" role="alert">
        
        Hapus Pengguna Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('pengguna');
    }
}
