<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporankas extends CI_Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();
        $this->load->library('form_validation');
        if ($this->session->userdata('role_id') == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            this session has expired, please login again!
              </div>');
            redirect("auth");
        }
    }

    public function index()
    {
        $data['title'] = 'Laporan Kas Umum';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['jurnal'] = $this->db->query("SELECT a.id,a.id_kas,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a LEFT JOIN jurnal_detail b on a.id = b.id_jurnal order by a.tgl_transaksi asc")->result_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('laporankas/index', $data);
            $this->load->view('template/footer');
        } else {
            redirect('laporankas/index');
        }
    }
    public function bukukasumum()
    {
        $data['title'] = 'Laporan Kas';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['jurnal'] = $this->db->query("SELECT a.id,a.id_kas,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a LEFT JOIN jurnal_detail b on a.id = b.id_jurnal order by a.tgl_transaksi asc")->result_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('laporankas/index', $data);
            $this->load->view('template/footer');
        } else {
            redirect('laporankas/bukukasumum');
        }
    }
    public function search()
    {
        $data['title'] = 'Laporan Kas';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();

        $tgl_awal = $this->input->post('tanggal_awal');
        $tgl_akhir = $this->input->post('tanggal_akhir');

        $saldo_awal = "SELECT a.id,a.id_kas,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

        $query = "SELECT a.id,a.id_kas,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
        LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi)  between '$tgl_awal' and '$tgl_akhir'  order by a.tgl_transaksi asc";

        $data['saldo_awal'] = $this->db->query($saldo_awal)->result_array();
        $data['jurnal'] = $this->db->query($query)->result_array();

        $this->session->set_flashdata('tglawal', $tgl_awal);
        $this->session->set_flashdata('tglakhir', $tgl_akhir);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporankas/search', $data);
        $this->load->view('template/footer');
    }

    public function cetak()
    {
        $type = $this->input->get('p');
        $tgl_awal = $this->input->get('tglawal');
        $tgl_akhir = $this->input->get('tglakhir');
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['ket'] = 'Data Kas Keluar dari Tanggal ' . date('d-m-y', strtotime($tgl_awal)) . ' s/d ' . date('d-m-y', strtotime($tgl_akhir));
        ob_start();
        require('assets/fpdf/fpdf.php');

        if ($type = 'pdf') {
            if ($tgl_akhir == null && $tgl_awal == null) {
                $saldo_awal = "SELECT a.id,a.id_kas,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a
                LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

            $query = "SELECT a.id,a.id_kas,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
            LEFT JOIN jurnal_detail b on a.id = b.id_jurnal  order by a.tgl_transaksi asc";
                } else {
            $saldo_awal = "SELECT a.id,a.id_kas,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a
            LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi) < '$tgl_awal' order by a.tgl_transaksi asc";

            $query = "SELECT a.id,a.id_kas,a.keterangan,a.tgl_transaksi,kredit,debit FROM jurnal a 
            LEFT JOIN jurnal_detail b on a.id = b.id_jurnal where date(tgl_transaksi)  between '$tgl_awal' and '$tgl_akhir'  order by a.tgl_transaksi asc";
                }

            $data['saldo_awal'] = $this->db->query($saldo_awal)->result_array();
            $data['jurnal'] = $this->db->query($query)->result_array();

            $this->session->set_flashdata('tglawal', $tgl_awal);
            $this->session->set_flashdata('tglakhir', $tgl_akhir);

            $this->load->view('laporankas/preview', $data);
        } 
    }
}
