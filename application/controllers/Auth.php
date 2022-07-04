<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'login Page';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $captcha = $this->input->post('captcha');
        $captcha_session = $this->session->userdata('captcha_session');
        if ($captcha != $captcha_session) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Captcha masih salah.
              </div>');
            redirect('auth');
        }

        $bendahara = $this->db->get_where('bendahara', ['email' => $email])->row_array();
        if ($bendahara) {
            if ($bendahara['is_active'] == 1) {
                if (password_verify($password, $bendahara['password'])) {
                    $data = [
                        "email" => $bendahara['email'],
                        "role_id" => $bendahara['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($bendahara['role_id'] == 1) {
                        redirect('dashboard');
                    } else if ($bendahara['role_id'] == 2) {
                        redirect('info');
                    } else {
                        redirect('info');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Salah!
                      </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email Belum Aktif!
              </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email Belum Tergistrasi!
          </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar</div>');
        redirect('auth');
    }
    public function login_santri()
    {

        $this->form_validation->set_rules('nis', 'Nis', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login Santri';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login_santri');
            $this->load->view('template/auth_footer');
        } else {

            $this->_loginsantri();
        }
    }

    private function _loginsantri()
    {
        $nis = $this->input->post('nis');
        $password = $this->input->post('password');

        $captcha = $this->input->post('captcha');
        $captcha_session = $this->session->userdata('captcha_session');
        if ($captcha != $captcha_session) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Captcha masih salah.
              </div>');
            redirect('auth');
        }

        $santri = $this->db->get_where('santri', ['nis' => $nis])->row_array();
        if ($santri) {
            if (password_verify($password, $santri['password'])) {
                $data = [
                    "nis" => $santri['nis'],
                    "role_id" => $santri['role_id']
                ];
                $this->session->set_userdata($data);
                if ($santri['role_id'] == 2) {
                    redirect('user_santri');
                } else {
                    redirect('user_santri');
                }
            } else {
                $this->session->set_flashdata('message7', '<div class="alert alert-danger" role="alert">
                    Password Salah!
                      </div>');
                redirect('auth/login_santri');
            }
            $this->session->set_flashdata('message7', '<div class="alert alert-danger" role="alert">NIS tidak aktif!</div>');
            redirect('auth/login_santri');
        } else {
            $this->session->set_flashdata('message7', '<div class="alert alert-danger" role="alert">NIS tidak terdaftar!</div>');
            redirect('auth/login_santri');
        }
    }

    public function logout_santri()
    {
        $this->session->unset_userdata('nis');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message7', '<div class="alert alert-success" role="alert">Anda telah keluar</div>');
        redirect('auth/login_santri');
    }

    public function getCaptcha()
    {
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
        $teks = $this->randomString(2);
        $this->session->set_userdata('captcha_session', $teks);
        $str = $this->session->userdata('captcha_session');
        $cap = $this->createCaptcha($str);
        return $cap;
    }

    public function randomString($length)
    {
        $str = "";
        // $characters = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        $characters = array_merge(range('0', '5'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public function createCaptcha($text = "")
    {
        $width = 75; //Ukuran lebar
        $height = 33; //Tinggi
        $im = imagecreate($width, $height);
        $bg = imagecolorallocate($im, 0, 0, 0);
        $len = 6; //Panjang karakter 
        $string = '';
        $string .= $text;

        //menambahkan titik2 gambar / noise
        $bgR = mt_rand(100, 200);
        $bgG = mt_rand(100, 200);
        $bgB = mt_rand(100, 200);
        $noise_color = imagecolorallocate($im, abs(255 - $bgR), abs(255 - $bgG), abs(255 - $bgB));

        for ($i = 0; $i < ($width * $height) / 3; $i++) {
            imagefilledellipse($im, mt_rand(0, $width), mt_rand(0, $height), 3, rand(2, 5), $noise_color);
        }

        // proses membuat tulisan
        $text_color = imagecolorallocate($im, 240, 240, 240);
        $rand_x = $width - 65; //rand(0, $width - 50);
        $rand_y = $height - 25; //rand(0, $height - 15);
        imagestring($im, 12, $rand_x, $rand_y, $string, $text_color);
        header("Content-type: image/png"); //Output format gambar
        $img = imagepng($im);

        return $img;
    }
}
