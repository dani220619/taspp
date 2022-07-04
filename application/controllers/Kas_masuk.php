<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas_masuk extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->library('session');
        $this->load->model('m_kasmasuk');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Data Kas Masuk';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['kas_masuk'] = $this->m_kasmasuk->tampil_data()->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('kas_masuk/index', $data1);
        $this->load->view('template/footer');
    }
    function tambah()
    {
        $data['title'] = 'Data Kas Masuk';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('kas_masuk/tambah_kas');
        $this->load->view('template/footer');
    }
    function tambah_aksi()
    {
        $data['title'] = 'Data Kas Masuk';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $id_kas = date("dmY") . '-' . rand(0000, 9999);
        $tgl_transaksi = $this->input->post('tgl_transaksi');
        $keterangan = $this->input->post('keterangan');
        $nominal = $this->input->post('nominal');
        $data = array(
            'id_kas' => $id_kas,
            'tipe_kas' => 'Kas Masuk',
            'tgl_transaksi' => $tgl_transaksi,
            'keterangan' => $keterangan,
            'nominal' => $nominal,
        );
        $this->m_kasmasuk->input_data($data, 'kas_masuk');
        $this->session->set_flashdata('message5', '<div class="alert alert-success" role="alert">
        
        Tambah Kas Masuk Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas_masuk');
    }
    function update()
    {
        $id_kas = $this->input->post('id_kas');
        $tgl_transaksi = $this->input->post('tgl_transaksi');
        $keterangan = $this->input->post('keterangan');
        $nominal = $this->input->post('nominal');
        $data = array(
            'id_kas' => $id_kas,
            'tgl_transaksi' => $tgl_transaksi,
            'keterangan' => $keterangan,
            'nominal' => $nominal,
        );
        $where = array('id_kas' => $id_kas);
        $this->m_kasmasuk->update_data($where, $data, 'kas_masuk');
        $this->session->set_flashdata('message5', '<div class="alert alert-success" role="alert">
        
        Update Kas Masuk Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas_masuk');
    }
    public function deletekasmasuk()
    {
        $id = $this->input->get('id_kas');
        $this->db->delete('kas_masuk', array('id_kas' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas Masuk Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas_masuk');
    }
}
