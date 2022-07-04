<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();

        $this->load->library('session');

        $this->load->library('session');
        $this->load->library('form_validation');
        if ($this->session->userdata('role_id') == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            this session has expired, please login again!
              </div>');
            redirect("auth");
        }
        $this->load->model('M_santri');
        $this->load->model('M_transaksi');
        $this->load->model('M_admin');
        $this->load->model('M_kas');
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['jumlahsantri'] = $this->M_santri->jumlahsantri();
        $data['jumlahuser'] = $this->M_admin->jumlahuser();
        $data['jumlahsppbulanan'] = $this->M_transaksi->jumlahsppbulanan();

        $this->db->select_sum('jumlah');
        $data['juml_spp'] = $this->db->get('spp_bulanan')->row_array();
        $this->db->select_sum('uang_masuk');
        $data['kas_msk'] = $this->db->get('kas')->row_array();
        $this->db->select_sum('uang_keluar');
        $data['kas_klr'] = $this->db->get('kas')->row_array();
        $this->db->select_sum('total_tagihan');
        $this->db->where_in('status_bayar', '0');
        $data['pem_lainya'] = $this->db->get('pembayaran_lainnya')->row_array();
        $data['kas_masuk'] = $this->M_kas->jumlahkas_masuk();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/footer', $data);
    }
}
