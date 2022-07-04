<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ngaji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('m_ngaji');
        $this->load->helper('url');
    }
    public function pengampu()
    {
        $data['title'] = 'Data Pengampu';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['pengampu'] = $this->m_ngaji->tampil_data()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('ngaji/pengampu', $data1);
        $this->load->view('template/footer');
    }
    function tambah_pengampu()
    {
        $id_pengampu = rand(0000, 9999);
        $nama = $this->input->post('nama');

        $data = array(
            'id_pengampu' => $id_pengampu,
            'nama' => $nama,
        );
        $this->m_ngaji->input_data($data, 'pengampu');
        $this->session->set_flashdata('message10', '<div class="alert alert-success" role="alert">
        
        Tambah Pengampu Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/pengampu');
    }
    function update_pengampu()
    {
        $id_pengampu = $this->input->post('id_pengampu');
        $nama = $this->input->post('nama');
        $data = array(
            'id_pengampu' => $id_pengampu,
            'nama' => $nama,
        );
        $where = array('id_pengampu' => $id_pengampu);
        $this->m_ngaji->update_data($where, $data, 'pengampu');
        $this->session->set_flashdata('message10', '<div class="alert alert-warning" role="alert">
        
        Update Pengampu Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/pengampu');
    }
    public function deletepengampu()
    {
        $id_pengampu = $this->input->get('id_pengampu');
        $this->db->delete('pengampu', array('id_pengampu' => $id_pengampu));
        $this->session->set_flashdata('message10', '<div class="alert alert-danger" role="alert">
        
        Hapus Pengampu Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/pengampu');
    }
    public function jenis()
    {
        $data['title'] = 'Data Jenis Ngaji';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['jenis'] = $this->m_ngaji->tampil_jenis()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('ngaji/jenis', $data1);
        $this->load->view('template/footer');
    }
    function tambah_jenis()
    {
        $id_ngaji = rand(0000, 9999);
        $jenis = $this->input->post('jenis');

        $data = array(
            'id_ngaji' => $id_ngaji,
            'jenis' => $jenis,
        );
        $this->m_ngaji->input_data($data, 'jenis_ngaji');
        $this->session->set_flashdata('message10', '<div class="alert alert-success" role="alert">
        
        Tambah Jenis Ngaji Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/jenis');
    }
    function update_jenis()
    {
        $id_ngaji = $this->input->post('id_ngaji');
        $jenis = $this->input->post('jenis');
        $data = array(
            'id_ngaji' => $id_ngaji,
            'jenis' => $jenis,
        );
        $where = array('id_ngaji' => $id_ngaji);
        $this->m_ngaji->update_data($where, $data, 'jenis_ngaji');
        $this->session->set_flashdata('message10', '<div class="alert alert-warning" role="alert">
        
        Update Jenis Ngaji Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/jenis');
    }
    public function deletejenis()
    {
        $id_ngaji = $this->input->get('id_ngaji');
        $this->db->delete('jenis_ngaji', array('id_ngaji' => $id_ngaji));
        $this->session->set_flashdata('message10', '<div class="alert alert-danger" role="alert">
        
        Hapus Jenis Ngaji Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/jenis');
    }
    public function surat()
    {
        $data['title'] = 'Data Surat';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['surat'] = $this->m_ngaji->tampil_surat()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('ngaji/surat', $data1);
        $this->load->view('template/footer');
    }
    function tambah_surat()
    {
        $id_surat = rand(0000, 9999);
        $nama_surat = $this->input->post('nama_surat');

        $data = array(
            'id_surat' => $id_surat,
            'nama_surat' => $nama_surat,
        );
        $this->m_ngaji->input_data($data, 'surat');
        $this->session->set_flashdata('message10', '<div class="alert alert-success" role="alert">
        
        Tambah Surat Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/surat');
    }
    function update_surat()
    {
        $id_surat = $this->input->post('id_surat');
        $nama_surat = $this->input->post('nama_surat');

        $data = array(
            'id_surat' => $id_surat,
            'nama_surat' => $nama_surat,
        );
        $where = array('id_surat' => $id_surat);
        $this->m_ngaji->update_data($where, $data, 'surat');
        $this->session->set_flashdata('message10', '<div class="alert alert-warning" role="alert">
        
        Update Surat Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/surat');
    }
    public function deletesurat()
    {
        $id_surat = $this->input->get('id_surat');
        $this->db->delete('surat', array('id_surat' => $id_surat));
        $this->session->set_flashdata('message10', '<div class="alert alert-danger" role="alert">
        
        Hapus Surat Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/surat');
    }
    public function wali_kelas()
    {
        $data['title'] = 'Data Wali Kelas';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['wali_kelas'] = $this->m_ngaji->tampil_wali_kelas()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('ngaji/wali_kelas', $data1);
        $this->load->view('template/footer');
    }
    function tambah_wali_kelas()
    {
        $id_wali_kelas = rand(0000, 9999);
        $wali_kelas = $this->input->post('wali_kelas');

        $data = array(
            'id_wali_kelas' => $id_wali_kelas,
            'wali_kelas' => $wali_kelas,
        );
        $this->m_ngaji->input_data($data, 'wali_kelas');
        $this->session->set_flashdata('message10', '<div class="alert alert-success" role="alert">
        
        Tambah Wakil Kelas Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/wali_kelas');
    }
    function update_wali_kelas()
    {
        $id_wali_kelas = $this->input->post('id_wali_kelas');
        $wali_kelas = $this->input->post('wali_kelas');

        $data = array(
            'id_wali_kelas' => $id_wali_kelas,
            'wali_kelas' => $wali_kelas,
        );
        $where = array('id_wali_kelas' => $id_wali_kelas);
        $this->m_ngaji->update_data($where, $data, 'wali_kelas');
        $this->session->set_flashdata('message10', '<div class="alert alert-warning" role="alert">
        
        Update Wali Kelas Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/wali_kelas');
    }
    public function deletewalikelas()
    {
        $id_wali_kelas = $this->input->get('id_wali_kelas');
        $this->db->delete('wali_kelas', array('id_wali_kelas' => $id_wali_kelas));
        $this->session->set_flashdata('message10', '<div class="alert alert-danger" role="alert">
        
        Hapus Wali Kelas Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('ngaji/wali_kelas');
    }
}
