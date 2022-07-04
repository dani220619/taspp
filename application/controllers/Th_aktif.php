<?php
defined('BASEPATH') or exit('No direct script access allowed');

class th_aktif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('M_thaktif');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Data Santri Aktif';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['tahun_aktif'] = $this->M_thaktif->tampil_data();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('thaktif/index', $data1);
        $this->load->view('template/footer');
    }

    public function tambah_aksi()
    {

        // Ambil data yang dikirim dari form
        $id_thaktif = rand(0000, 9999);
        $nis = $this->input->post('nis[]', TRUE);

        $data = array();

        $index = 1; // Set index array awal dengan 0
        foreach ($nis as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'nis' => $key,
                'id_thaktif' => $id_thaktif++,  // Ambil dan set data nama sesuai index array dari $index
            ));
            $key;
        }
        $this->M_thaktif->save_thn_aktif($data);
        // var_dump($data);
        // exit();
        $this->session->set_flashdata('message11', '<div class="alert alert-success" role="alert">
        
        Tambah Santri Aktif Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('th_aktif');
    }

    public function deleteTahunaktif()
    {
        $nis = $this->input->get('nis');
        $this->db->delete('tahun_aktif', array('nis' => $nis));
        $this->session->set_flashdata('message11', '<div class="alert alert-danger" role="alert">
        
        Hapus Santri Aktif Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('th_aktif');
    }
}
