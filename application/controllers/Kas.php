<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->library('session');
        $this->load->model('M_kas');
        $this->load->helper('url');
    }
    public function kas_masuk()
    {
        $data['title'] = 'Data Kas Masuk';
        $data['tgl_transaksi'] = date("Y-m-d");
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data['kas_masuk'] = $this->M_kas->tampil_kasmasuk()->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('kas_masuk/kas_masuk', $data);
        $this->load->view('template/footer');
    }
    public function kas_keluar()
    {
        $data['title'] = 'Data Kas keluar';
        $data['tgl_transaksi'] = date("Y-m-d");
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data['kas_keluar'] = $this->M_kas->tampil_kaskeluar()->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('kas_keluar/kas_keluar', $data);
        $this->load->view('template/footer');
    }
    function tambah_kasmasuk()
    {
        $id_kas = rand(0000, 9999);
        $tgl_transaksi = $this->input->post('tgl_transaksi');
        $keterangan = $this->input->post('keterangan');
        $uang_masuk = $this->input->post('uang_masuk');
        $jenis_kas = $this->input->post('jenis_kas');
        $data = array(
            'id_kas' => $id_kas,
            'jenis_kas' => 'Kas Masuk',
            'tgl_transaksi' => $tgl_transaksi,
            'keterangan' => $keterangan,
            'uang_masuk' => $uang_masuk,
            'jenis_kas' => 'Kas Masuk'
        );
        // var_dump($data);
        // die;
        $this->M_kas->input_data($data, 'kas');
        $this->session->set_flashdata('message5', '<div class="alert alert-success" role="alert">
        
        Tambah Kas Masuk Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas/kas_masuk');
    }
    function update_kasmasuk()
    {
        $id_kas = $this->input->post('id_kas');
        $tgl_transaksi = $this->input->post('tgl_transaksi');
        $keterangan = $this->input->post('keterangan');
        $uang_masuk = $this->input->post('uang_masuk');
        $jenis_kas = $this->input->post('jenis_kas');
        $data = array(
            'id_kas' => $id_kas,
            'tgl_transaksi' => $tgl_transaksi,
            'keterangan' => $keterangan,
            'uang_masuk' => $uang_masuk,
            'jenis_kas' => $jenis_kas
        );
        // var_dump($data);
        // die;
        $where = array('id_kas' => $id_kas);
        $this->M_kas->update_data_kasmasuk($where, $data, 'kas');
        $this->session->set_flashdata('message5', '<div class="alert alert-success" role="alert">
        Update Kas Masuk Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas/kas_masuk');
    }
    public function deletekasmasuk()
    {
        $id = $this->input->get('id_kas');
        $this->db->delete('kas', array('id_kas' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas Masuk Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas/kas_masuk');
    }
    function tambah_kaskeluar()
    {
        $id_kas = rand(00000, 99999);
        $tgl_transaksi = $this->input->post('tgl_transaksi');
        $keterangan = $this->input->post('keterangan');
        $uang_keluar = $this->input->post('uang_keluar');
        $jenis_kas = $this->input->post('jenis_kas');
        $data = array(
            'id_kas' => $id_kas,
            'jenis_kas' => 'Kas Masuk',
            'tgl_transaksi' => $tgl_transaksi,
            'keterangan' => $keterangan,
            'uang_keluar' => $uang_keluar,
            'jenis_kas' => 'Kas Keluar'
        );
        // var_dump($data);
        // die;
        $this->M_kas->input_data($data, 'kas');
        $this->session->set_flashdata('message6', '<div class="alert alert-success" role="alert">
        
        Tambah Kas Masuk Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas/kas_keluar');
    }
    function update_kaskeluar()
    {
        $id_kas = $this->input->post('id_kas');
        $tgl_transaksi = $this->input->post('tgl_transaksi');
        $keterangan = $this->input->post('keterangan');
        $uang_keluar = $this->input->post('uang_keluar');
        $jenis_kas = $this->input->post('jenis_kas');
        $data = array(
            'id_kas' => $id_kas,
            'tgl_transaksi' => $tgl_transaksi,
            'keterangan' => $keterangan,
            'uang_keluar' => $uang_keluar,
            'jenis_kas' => $jenis_kas
        );
        // var_dump($data);
        // die;
        $where = array('id_kas' => $id_kas);
        $this->M_kas->update_data_kaskeluar($where, $data, 'kas');
        $this->session->set_flashdata('message6', '<div class="alert alert-success" role="alert">
        Update Kas Keluar Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas/kas_keluar');
    }
    public function deletekaskeluar()
    {
        $id = $this->input->get('id_kas');
        $this->db->delete('kas', array('id_kas' => $id));
        $this->session->set_flashdata('message6', '<div class="alert alert-danger" role="alert">
        Hapus Kas Keluar Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('kas/kas_keluar');
    }
}
