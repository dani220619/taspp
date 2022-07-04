<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('M_santri');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Data Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['santri'] = $this->M_santri->tampil_data()->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('santri/index', $data1);
        $this->load->view('template/footer');
    }
    public function data_santri()
    {
        $data['title'] = 'Data Pengajian Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['santri'] = $this->M_santri->tampil_data()->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('santri/data_santri', $data1);
        $this->load->view('template/footer');
    }
    function tambah_aksi()
    {
        $nis = $this->input->post('nis');
        $nama_santri = $this->input->post('nama_santri');
        if (!empty($_FILES['image']['name'])) {
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        }
        $email = $this->input->post('email');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');
        $no_hp = $this->input->post('no_hp');
        $ayah = $this->input->post('ayah');
        $ibu = $this->input->post('ibu');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $password1 = $this->input->post('password1');

        $data = array(
            'nis' => $nis,
            'nama_santri' => $nama_santri,
            'image' => $upload,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'tanggal_lahir' => $tanggal_lahir,
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'no_hp' => $no_hp,
            'ayah' => $ayah,
            'ibu' => $ibu,
            'email' => $email,
            'role_id' => 3,
            'date_created' => time()

        );
        $this->M_santri->input_data($data, 'santri');
        // var_dump($upload);
        // die;
        $this->session->set_flashdata('message2', '<div class="alert alert-success" role="alert">
        
            Tambah Santri Berhasil!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span> 
       </button>
          </div>');
        redirect('santri');
    }
    private function _do_upload()
    {
        $config['upload_path']         = 'assets/img/santri/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']  = '2400';
        $config['max_width']  = '2024';
        $config['max_height']  = '2024';
        $config['file_name']             = round(microtime(true) * 1000);

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('msg', $this->upload->display_errors('', ''));
            redirect('santri');
        }
        return $this->upload->data('file_name');
    }
    function update()
    {
        $nis = $this->input->post('nis');
        $nama_santri = $this->input->post('nama_santri');
        if (!empty($_FILES['image']['name'])) {
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        }
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');
        $no_hp = $this->input->post('no_hp');
        $ayah = $this->input->post('ayah');
        $ibu = $this->input->post('ibu');
        $data = array(
            'nis' => $nis,
            'nama_santri' => $nama_santri,
            'image' => $upload,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'no_hp' => $no_hp,
            'ayah' => $ayah,
            'ibu' => $ibu,
            'role_id' => 2,
        );
        $where = array('nis' => $nis);
        $this->M_santri->update_data($where, $data, 'santri');

        $this->session->set_flashdata('message2', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Update Santri Berhasil!
            
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
     <span aria-hidden="true">&times;</span> 
</button>
          </div>');
        $_SESSION['nis'] = $nis;
        $_SESSION['nama_santri'] = $nama_santri;
        $_SESSION['jenis_kelamin'] = $jenis_kelamin;
        $_SESSION['alamat'] = $alamat;
        $_SESSION['no_hp'] = $no_hp;
        redirect('santri');
    }
    function update_santri()
    {
        $nis = $this->input->post('nis');
        $nama_santri = $this->input->post('nama_santri');
       
        $pengampu = $this->input->post('pengampu');
        $kamar = $this->input->post('kamar');
        $angkatan = $this->input->post('angkatan');
        $jenis = $this->input->post('jenis');
        $surat = $this->input->post('surat');
        $wali_kelas = $this->input->post('wali_kelas');
        $kelas = $this->input->post('kelas');
        $univ = $this->input->post('univ');
        $jurusan = $this->input->post('jurusan');
        $status = $this->input->post('status');
        $data = array(
            'nis' => $nis,
            'nama_santri' => $nama_santri,
            
            'pengampu' => $pengampu,
            'kamar' => $kamar,
            'angkatan' => $angkatan,
            'jenis' => $jenis,
            'surat' => $surat,
            'wali_kelas' => $wali_kelas,
            'kelas' => $kelas,
            'univ' => $univ,
            'jurusan' => $jurusan,
            'status' => $status,
        );
        // var_dump($data);
        // die;
        $where = array('nis' => $nis);
        $this->M_santri->update_data($where, $data, 'santri');

        $this->session->set_flashdata('message2', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Update Pengajian Santri Berhasil!
            
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
     <span aria-hidden="true">&times;</span> 
</button>
          </div>');
        redirect('santri/data_santri');
    }

    public function deleteSantri()
    {
        $id = $this->input->get('nis');
        $this->db->delete('santri', array('nis' => $id));
        $this->session->set_flashdata('message2', '<div class="alert alert-danger" role="alert">
        
            Hapus Santri Berhasil!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
     <span aria-hidden="true">&times;</span> 
</button>
          </div>');
        redirect('santri');
    }
}
