<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('M_transaksi');
        $this->load->helper('url');
    }
    public function laporan()
    {
        $data['title'] = 'Data Pembayaran SPP Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data['santri'] = $this->M_transaksi->tampil_data()->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan/laporan_spp', $data);
        $this->load->view('template/footer');
    }
    public function laporan__kas()
    {
        $data['title'] = 'Data Pembayaran SPP Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data['santri'] = $this->M_transaksi->tampil_data()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan/laporan_kas', $data);
        $this->load->view('template/footer');
    }
    public function laporan__lainya()
    {
        $data['title'] = 'Data Pembayaran SPP Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data['santri'] = $this->M_transaksi->tampil_data()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan/laporan_lainya', $data);
        $this->load->view('template/footer');
    }

    /*LAPORAN TRANSAKSI*/
    function laporan_spp()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'laporan/cetak1?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $spp_bulanan = $this->M_transaksi->view_by_date($tanggal1, $tanggal2)->result();
            } else if ($filter == '2') {
                $nis = $_GET['nis'];
                $ket = 'Data Transaksi dari Santri dengan Nomor Induk ' . $nis;
                $url_cetak = 'laporan/cetak2?&nis=' . $nis;
                $spp_bulanan = $this->M_transaksi->view_by_nis($nis)->result();
            } else {
                $tahun = $_GET['tahun'];
                $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
                $url_cetak = 'laporan/cetak4?&tahun=' . $tahun;
                $spp_bulanan = $this->M_transaksi->view_by_year($tahun)->result();
            }
        } else {
            $ket = 'Semua Data Transaksi';
            $url_cetak = 'laporan/cetak';
            $spp_bulanan = $this->M_transaksi->view_all();
        }
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['spp_bulanan'] = $spp_bulanan;
        $data['nis'] = $this->M_transaksi->nis();
        $data['tahun'] = $this->M_transaksi->tahun();
        $data['title'] = 'Laporan Data Pembayaran SPP Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan/laporan_spp', $data);
        $this->load->view('template/footer');
    }
    public function cetak()
    {
        $ket = 'Semua Data Transaksi';
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->M_transaksi->view_all();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }
    public function cetak1()
    {
        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->M_transaksi->view_by_date($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }
    public function cetak2()
    {
        $nis = $_GET['nis'];
        $ket = 'Data Transaksi dari Santri dengan Nomor Induk ' . $nis;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->M_transaksi->view_by_nis($nis)->result();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }
    public function cetak3()
    {
        $kelas = $_GET['kelas'];
        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Kelas ' . $kelas . ' Tahun Ajaran' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->M_transaksi->view_by_kelas($kelas, $tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('laporan/preview', $data);
    }
    public function cetak4()
    {
        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->M_transaksi->view_by_year($tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }

    function laporan_lainya()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'laporan/cetak98?tanggal=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $pem_lainya = $this->M_transaksi->tanggal_lainya($tanggal1, $tanggal2)->result();
            } else if ($filter == '2') {
                $nis = $_GET['nis'];
                $ket = 'Data Transaksi dari Santri dengan Nomor Induk ' . $nis;
                $url_cetak = 'laporan/cetak97?&nis=' . $nis;
                $pem_lainya = $this->M_transaksi->nis_lainya($nis)->result();
            } else {
                $tahun = $_GET['tahun'];
                $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
                $url_cetak = 'laporan/cetak4?&tahun=' . $tahun;
                $pem_lainya = $this->M_transaksi->year_lainya($tahun)->result();
            }
        } else {
            $ket = 'Semua Data Transaksi';
            $url_cetak = 'laporan/cetak99';
            $pem_lainya = $this->M_transaksi->laporan_lainnya();
        }
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['pem_lainya'] = $pem_lainya;
        $data['nis'] = $this->M_transaksi->nis();
        $data['tahun'] = $this->M_transaksi->tahun();
        $data['title'] = 'Laporan Data Pembayaran Lainya';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan/laporan_lainya', $data);
        $this->load->view('template/footer');
    }
    public function cetak99()
    {
        $ket = 'Semua Data Transaksi';
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pem_lainya'] = $this->M_transaksi->laporan_lainnya();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_lainya', $data);
    }
    public function cetak98()
    {
        $tanggal1 = $_GET['tanggal'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pem_lainya'] = $this->M_transaksi->tanggal_lainya($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_lainya', $data);
    }
    public function cetak97()
    {
        $nis = $_GET['nis'];
        $ket = 'Data Transaksi dari Santri dengan Nomor Induk ' . $nis;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pem_lainya'] = $this->M_transaksi->nis_lainya($nis)->result();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_lainya', $data);
    }
    public function cetak96()
    {
        $kelas = $_GET['kelas'];
        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Kelas ' . $kelas . ' Tahun Ajaran' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->M_transaksi->view_by_kelas($kelas, $tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('laporan/preview', $data);
    }
    public function cetak95()
    {
        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->M_transaksi->view_by_year($tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }
    function laporan_kas()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'laporan/cetak12?tanggal=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $kas_umum = $this->M_transaksi->kas_masuk($tanggal1, $tanggal2)->result();
            } elseif ($filter == '2') {
                $tanggal1 = $_GET['tanggal11'];
                $tanggal2 = $_GET['tanggal12'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'laporan/cetak13?tanggal11=' . $tanggal1 . '&tanggal12=' . $tanggal2 . '';
                $kas_umum = $this->M_transaksi->kas_keluar($tanggal1, $tanggal2)->result();
            } else if ($filter == '3') {
                $tanggal1 = $_GET['tanggal111'];
                $tanggal2 = $_GET['tanggal122'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'laporan/cetak14?tanggal111=' . $tanggal1 . '&tanggal122=' . $tanggal2 . '';
                $kas_umum = $this->M_transaksi->kas_umum_laporan($tanggal1, $tanggal2)->result();
            }
        } else {
            $ket = 'Semua Data Transaksi kas';
            $url_cetak = 'laporan/cetak11';
            $kas_umum = $this->M_transaksi->laporan_kas_umum();
        }
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['kas_umum'] = $kas_umum;
        // $data['nis'] = $this->M_transaksi->nis();

        $data['tahun'] = $this->M_transaksi->per_tahun();
        $data['title'] = 'Laporan Data Kas';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan/laporan_kas', $data);
        $this->load->view('template/footer');
    }
    public function cetak11()
    {
        $ket = 'Semua Data Transaksi Kas';
        ob_start();
        require('assets/fpdf1/fpdf.php');
        $data['Kas_umum'] = $this->M_transaksi->laporan_kas_umum();
        $data['ket'] = $ket;
        // var_dump($data['Kas_umum']);
        // die;
        $this->load->view('laporan/cetak_kas', $data);
    }
    public function cetak12()
    {
        $tanggal1 = $_GET['tanggal'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf1/fpdf.php');
        $data['Kas_umum'] = $this->M_transaksi->kas_masuk($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        // var_dump($data['Kas_umum']);
        // die;
        $this->load->view('laporan/cetak_kas', $data);
    }
    public function cetak13()
    {
        $tanggal1 = $_GET['tanggal11'];
        $tanggal2 = $_GET['tanggal12'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf1/fpdf.php');
        $data['Kas_umum'] = $this->M_transaksi->kas_keluar($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        // var_dump($data['Kas_umum']);
        // die;
        $this->load->view('laporan/cetak_kas', $data);
    }
    public function cetak14()
    {
        $tanggal1 = $_GET['tanggal111'];
        $tanggal2 = $_GET['tanggal122'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf1/fpdf.php');
        $data['Kas_umum'] = $this->M_transaksi->kas_umum_laporan($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        // var_dump($data['Kas_umum']);
        // die;
        $this->load->view('laporan/cetak_kas', $data);
    }
	/*LAPORAN TUNGGAKAN*/
    function laporan_tunggakan()
    {
		$data['title'] = 'Laporan Tunggakan';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        //$this->load->view('laporan/laporan_tunggakan', $data);
		
		$this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan/laporan_tunggakan', $data);
        $this->load->view('template/footer');
    }
}
//