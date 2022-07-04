<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Th_ajaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('m_thajaran');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Data tahun ajaran';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['tahun_ajaran'] = $this->m_thajaran->tampil_data()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('thajaran/index', $data1);
        $this->load->view('template/footer');
    }
    function tambah()
    {
        $data['title'] = 'Data tahun ajaran';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('thajaran/tambah_thajaran');
        $this->load->view('template/footer');
    }
    function tambah_aksi()
    {
        $id_tahun = rand(00, 99);
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $besar_spp = $this->input->post('besar_spp');
        $Status = $this->input->post('Status');
        $data = array(
            'id_tahun' => $id_tahun,
            'tahun_ajaran' => $tahun_ajaran,
            'besar_spp' => $besar_spp,
            'Status'   => $Status
        );
        $this->m_thajaran->input_data($data, 'tahun_ajaran');
        $this->session->set_flashdata('message10', '<div class="alert alert-success" role="alert">
        
        Tambah Tahun Ajaran Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('th_ajaran');
    }
    function update()
    {
        $id_tahun = $this->input->post('id_tahun');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $besar_spp = $this->input->post('besar_spp');
        $Status = $this->input->post('Status');
        $data = array(
            'id_tahun' => $id_tahun,
            'tahun_ajaran' => $tahun_ajaran,
            'besar_spp' => $besar_spp,
            'Status'     => $Status,
        );
        $where = array('id_tahun' => $id_tahun);
        $this->m_thajaran->update_data($where, $data, 'tahun_ajaran');
        $this->session->set_flashdata('message10', '<div class="alert alert-warning" role="alert">
        
        Update Tahun Ajaran Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('th_ajaran');
    }
    public function deleteAjaran()
    {
        $id_tahun = $this->input->get('id_tahun');
        $this->db->delete('tahun_ajaran', array('id_tahun' => $id_tahun));
        $this->session->set_flashdata('message10', '<div class="alert alert-danger" role="alert">
        
        Hapus Tahun Ajaran Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('th_ajaran');
    }
}
