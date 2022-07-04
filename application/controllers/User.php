<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('m_admin');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Data Admin';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['bendahara'] = $this->m_admin->tampil_data()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data1);
        $this->load->view('template/footer');
    }
    function addUser()
    {
        $id_bendahara = rand(000000, 999999);
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        if (!empty($_FILES['image']['name'])) {
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        }
        $password1 = $this->input->post('password1');
        $role_id = $this->input->post('user_role');
        $is_active = $this->input->post('is_active');
        $data = array(
            'id_bendahara' => $id_bendahara,
            'name' => $name,
            'email' => $email,
            'image' => $upload,
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => $role_id,
            'is_active' => $is_active,
            'date_created' => time()
        );

        $this->m_admin->input_data($data, 'bendahara');
        $this->session->set_flashdata('message3', '<div class="alert alert-success" role="alert">

                Tambah Admin Berhasil!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">&times;</span> 
           </button>
              </div>');
        redirect('user');
    }
    private function _do_upload()
    {
        $config['upload_path']         = 'assets/img/profile/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']  = '2400';
        $config['max_width']  = '2024';
        $config['max_height']  = '2024';
        $config['file_name']             = round(microtime(true) * 1000);

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('msg', $this->upload->display_errors('', ''));
            redirect('user');
        }
        return $this->upload->data('file_name');
    }
    function update()
    {
        $id_bendahara = $this->input->post('id_bendahara');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        if (!empty($_FILES['image']['name'])) {
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        }
        $role_id = $this->input->post('user_role');
        $is_active = $this->input->post('is_active');
        $data = array(
            'name' => $name,
            'email' => $email,
            'image' => $upload,
            'role_id' => $role_id,
            'is_active' => $is_active,
            'date_created' => time()
        );
        $where = array('id_bendahara' => $id_bendahara);
        $this->m_admin->update_data($where, $data, 'bendahara');
        $this->session->set_flashdata('message3', '<div class="alert alert-success" role="alert">
        
            Update Admin Berhasil!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span> 
       </button>
          </div>');
        redirect('user');
    }
    public function deleteUser()
    {
        $id_bendahara = $this->input->get('id_bendahara');
        $this->db->delete('bendahara', array('id_bendahara' => $id_bendahara));
        $this->session->set_flashdata('message3', '<div class="alert alert-danger" role="alert">
        Hapus User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('user');
    }
    public function deleteuse()
    {
        $id_bendahara = $this->input->get('id_bendahara');
        $this->db->delete('bendahara', array('id_bendahara' => $id_bendahara));
        // var_dump($id_bendahara);
        // die;
        redirect('user');
    }

    function gantipassword()
    {
        $data['title'] = 'Ganti password anda';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/gantipassword', $data);
        $this->load->view('template/footer');
    }
    public function updatepassword()
    {
        $email = $this->session->userdata['email'];
        $this->form_validation->set_rules('baru', 'password_baru', 'required');
        $this->form_validation->set_rules('konfirmasi', 'konfirmasi_password', 'required|matches[baru]');
        $this->form_validation->set_message('required', '%s wajib diisi');
        $this->form_validation->set_error_delimiters('<p class="alert">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/gantipassword');
        } else {

            $data = array(
                'password' => password_hash($this->input->post('baru'), PASSWORD_DEFAULT),
            );
            $where = array('email' => $email);

            $this->m_admin->update_data($where, $data, 'bendahara');
            redirect('info');
        }
    }
}
