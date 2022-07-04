<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('menu_model', 'menu');
        if ($this->session->userdata('role_id') == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            this session has expired, please login again!
              </div>');
              
            redirect("auth");
        }
        $this->load->model('M_submenu');
            $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('sort', 'Sort', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'menu' => $this->input->post('menu'),
                'sort' => $this->input->post('sort'),
            ];
            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New menu added!
          </div>');
            redirect('menu');
        }
    }
    public function updatemenu()
    {
        $data['title'] = 'Data Donatur';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['user_menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('menu', 'menu', 'required');
        $this->form_validation->set_rules('sort', 'sort', 'required');

        $id = $this->input->post('id');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'menu' => $this->input->post('menu'),
                'sort' => $this->input->post('sort')
            ];
            $this->db->where('id', $id);
            $this->db->update('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Update donatur ' . $this->input->post('menu') . ' berhasil!
          </div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['submenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New submenu added!
          </div>');
            redirect('menu/submenu');
        }
    }
    public function update()
    {
        $data['title'] = 'Data Submenu';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['user_sub_menu'] = $this->db->get('user_sub_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->update('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New submenu edite!
          </div>');
            redirect('menu/submenu');
        }
    }
    function updateSubmenu()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');
        $data = array(
            'id' => $id,
            'title' => $title,
            'menu_id' => $menu_id,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active,
            
        );
        $where = array('id' => $id);
        $this->M_submenu->update_data($where, $data, 'user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Update Santri Berhasil!
          </div>');
        redirect('menu/submenu');
    }
    public function deleteSubmenu()
    {
        $id = $this->input->get('id');
        $this->db->delete('user_sub_menu', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('menu/submenu');
    }
    public function deleteMenu()
    {
        $id = $this->input->get('id');
        $this->db->delete('user_menu', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('menu');
    }
    public function user_access_menu()
    {
        $data['title'] = 'Data user access menu';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['user_access_menu'] = $this->db->get('user_access_menu')->result_array();

        $this->form_validation->set_rules('role_id', 'Role_id', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/user_access_menu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'role_id' => $this->input->post('role_id'),
                'menu_id' => $this->input->post('menu_id'),
            ];
            $this->db->insert('user_access_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New user_access_menu added!
          </div>');
            redirect('menu/user_access_menu');
        }
    }
    public function updateuser_access_menu()
    {
        $data['title'] = 'Data user access menu';
        $data['bendahara'] =  $this->db->get_where('bendahara', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['user_access_menu'] = $this->db->get('user_access_menu')->result_array();

        $this->form_validation->set_rules('role_id', 'Role_id', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required');
        $id = $this->input->post('title');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/user_access_menu', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'role_id' => $this->input->post('role_id'),
                'menu_id' => $this->input->post('menu_id')
            ];
            $this->db->insert('user_access_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New user_access_menu edite!
          </div>');
            redirect('menu/user_access_menu');
        }
    }
    public function deleteuser_access_menu()
    {
        $id = $this->input->get('id');
        $this->db->delete('user_access_menu', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('menu/user_access_menu');
    }
}
