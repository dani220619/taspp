<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('M_jenis_pembayaran');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Jenis Pembayaran';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data['jen_pembayaran'] = $this->M_jenis_pembayaran->tampil_data()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('jenis_pembayaran/index', $data);
        $this->load->view('template/footer');
    }
    function tambah_aksi()
    {
        $id = rand(00, 99);
        $jenis_pembayaran = $this->input->post('jenis_pembayaran');
        $data = array(
            'id' => $id,
            'jenis_pembayaran' => $jenis_pembayaran,
            'date_created' => time()

        );
        $this->M_jenis_pembayaran->input_data($data, 'jenis_pembayaran');
        $this->session->set_flashdata('message12', '<div class="alert alert-success" role="alert">
        
        Tambah Jenis Pembayaran Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('jenis_pembayaran');
    }
    function update()
    {
        $id = $this->input->post('id');
        $jenis_pembayaran = $this->input->post('jenis_pembayaran');
        $data = array(
            'id' => $id,
            'jenis_pembayaran' => $jenis_pembayaran,
        );
        // var_dump($data);
        // die;
        $where = array('id' => $id);
        $this->M_jenis_pembayaran->update_data($where, $data, 'jenis_pembayaran');

        $this->session->set_flashdata('message12', '<div class="alert alert-warning " role="alert">
        
        Update Jenis Pembayaran Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('jenis_pembayaran');
    }
    public function delete_jenis_pembayaran()
    {
        $id = $this->input->get('id');
        $this->db->delete('jenis_pembayaran', array('id' => $id));
        $this->session->set_flashdata('message12', '<div class="alert alert-danger" role="alert">
        
        Hapus Jenis Pembayaran Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('jenis_pembayaran');
    }
}
