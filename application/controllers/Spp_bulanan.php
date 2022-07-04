<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spp_bulanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('m_transaksi');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Data Pembayaran SPP Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['santri'] = $this->m_transaksi->tampil_data()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('spp_bulanan/index', $data1);
        $this->load->view('template/footer');
    }
    public function detail($nis)
    {
        $data['id_transaksi'] = $this->m_transaksi->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Data Pembayaran SPP Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('nis' => $nis);
        $data1['santri'] = $this->m_transaksi->tampil_detail($where1)->result();
        $data2['trans'] = $this->m_transaksi->tampil_transaksi($where1)->result();
        $data2['xtrans'] = $this->m_transaksi->tampil_xtrans($where1)->result();
        $data2['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();

        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE nis =' . $nis . '');
        if ($query->num_rows() == 0) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('spp_bulanan/detail', $data1);
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('spp_bulanan/detail', $data1);
            $this->load->view('spp_bulanan/detail_transaksi', $data2);
            $this->load->view('template/footer');
        }
    }
    function tambah_aksi()
    {
        $nis = $this->input->post('nis');
        $nama_santri = $this->input->post('nama_santri');
        $id_transaksi = $this->input->post('id_transaksi');
        $tgl_bayar = $this->input->post('tgl_bayar');
        $id_bulan = $this->input->post('bulan');
        $id_tahun = $this->input->post('tahun_ajaran');
        $id = $this->input->post('id');
        $metode_pembayaran = $this->input->post('metode_pembayaran');
        $data = array(
            'id_transaksi' => $id_transaksi,
            'nis' => $nis,
            'nama_santri' => $nama_santri,
            'id_bulan' => $id_bulan,
            'id_tahun' => $id_tahun,
            'tanggal_bayar' => $tgl_bayar,
            'id' => $id,
            'metode_pembayaran' => $metode_pembayaran,
        );
        $query = $this->db->query('SELECT * FROM spp_bulanan 
				WHERE id_bulan =' . $id_bulan . ' 
				AND id_tahun=' . $id_tahun . ' AND nis=' . $nis . '');
        if ($query->num_rows() > 0) {
            redirect('spp_bulanan/detail/' . $nis, '');
        } else {
            $this->m_transaksi->input_data($data, 'spp_bulanan');
            redirect('spp_bulanan/kurang_tunggakan/' . $nis . '/' . $id_tahun, '');
        }
    }
    function hapus($id_transaksi, $nis, $id_tahun)
    {
        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->m_transaksi->copy_input($where);
        $this->m_transaksi->hapus_data($where2, 'spp_bulanan');
        redirect('spp_bulanan/tambah_tunggakan/' . $nis . '/' . $id_tahun, '');
    }
    function tambah_tunggakan($nis, $id_tahun)
    {
        foreach ($this->db->query('SELECT tunggakan.tunggakan, tahun_ajaran.besar_spp FROM tahun_ajaran JOIN tunggakan 
        ON tahun_ajaran.id_tahun = tunggakan.id_tahun WHERE tunggakan.id_tahun=' . $id_tahun . '')->result() as $res); {
            $b_spp = $res->besar_spp;
            $totunggak = $res->tunggakan + $b_spp;
        }
        $data = array(
            'tunggakan' => $totunggak,
        );
        $where = array('nis' => $nis, 'id_tahun' => $id_tahun);
        $this->m_transaksi->update_tunggakan($where, $data, 'tunggakan');
        redirect('spp_bulanan/detail/' . $nis, '');
    }
    function kurang_tunggakan($nis, $id_tahun)
    {
        foreach ($this->db->query('SELECT tunggakan.tunggakan, tahun_ajaran.besar_spp FROM tahun_ajaran JOIN tunggakan 
        ON tahun_ajaran.id_tahun = tunggakan.id_tahun WHERE tunggakan.id_tahun=' . $id_tahun . '')->result() as $res); {
            $b_spp = $res->besar_spp;
            $totunggak = $res->tunggakan - $b_spp;
        }
        $data = array(
            'tunggakan' => $totunggak,
        );
        $where = array('nis' => $nis, 'id_tahun' => $id_tahun);
        $this->m_transaksi->update_tunggakan($where, $data, 'tunggakan');
        redirect('spp_bulanan/detail/' . $nis, '');
    }
    /*LAPORAN TRANSAKSI*/
    function laporan()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'spp_bulanan/cetak1?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $spp_bulanan = $this->m_transaksi->view_by_date($tanggal1, $tanggal2)->result();
            } else if ($filter == '2') {
                $nis = $_GET['nis'];
                $ket = 'Data Transaksi dari Santri dengan Nomor Induk ' . $nis;
                $url_cetak = 'spp_bulanan/cetak2?&nis=' . $nis;
                $spp_bulanan = $this->m_transaksi->view_by_nis($nis)->result();
            } else {
                $tahun = $_GET['tahun'];
                $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
                $url_cetak = 'spp_bulanan/cetak4?&tahun=' . $tahun;
                $spp_bulanan = $this->m_transaksi->view_by_year($tahun)->result();
            }
        } else {
            $ket = 'Semua Data Transaksi';
            $url_cetak = 'spp_bulanan/cetak';
            $spp_bulanan = $this->m_transaksi->view_all();
        }
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['spp_bulanan'] = $spp_bulanan;
        $data['nis'] = $this->m_transaksi->nis();
        $data['tahun'] = $this->m_transaksi->tahun();
        $data['title'] = 'Laporan Data Pembayaran SPP Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('spp_bulanan/laporan', $data);
        $this->load->view('template/footer');
    }
    public function cetak()
    {
        $ket = 'Semua Data Transaksi';
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->m_transaksi->view_all();
        $data['ket'] = $ket;
        $this->load->view('spp_bulanan/preview', $data);
    }
    public function cetak1()
    {
        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->m_transaksi->view_by_date($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        $this->load->view('spp_bulanan/preview', $data);
    }
    public function cetak2()
    {
        $nis = $_GET['nis'];
        $ket = 'Data Transaksi dari Santri dengan Nomor Induk ' . $nis;

        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->m_transaksi->view_by_nis($nis)->result();
        $data['ket'] = $ket;
        $this->load->view('spp_bulanan/preview', $data);
    }
    public function cetak3()
    {
        $kelas = $_GET['kelas'];
        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Kelas ' . $kelas . ' Tahun Ajaran' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->m_transaksi->view_by_kelas($kelas, $tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('spp_bulanan/preview', $data);
    }
    public function cetak4()
    {
        $tahun = $_GET['tahun'];
        $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['spp_bulanan'] = $this->m_transaksi->view_by_year($tahun)->result();
        $data['ket'] = $ket;
        $this->load->view('spp_bulanan/preview', $data);
    }
}
