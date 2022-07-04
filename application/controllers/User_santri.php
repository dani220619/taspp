<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_santri extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if ($this->session->userdata('role_id') == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            this session has expired, please login again!
              </div>');
            redirect("auth/login_santri");
        }
        $this->load->model('M_santri');
        $this->load->model('M_kartu');
        $this->load->model('M_transaksi');
    }

    public function index()
    {
        $data['title'] = 'Profil Saya';
        $data['santri'] = $this->db->get_where('santri', ['nis' => $this->session->userdata('nis')])->row_array();
        $data['sant'] = $this->db->get('santri')->row_array();
        $this->load->view('template_santri/header', $data);
        $this->load->view('template_santri/sidebar', $data);
        $this->load->view('template_santri/topbar', $data);
        $this->load->view('user_santri/index', $data);
        $this->load->view('template_santri/footer', $data);
        // var_dump($data['santri']);
        // die;
    }
    public function detail_santri($nis)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Data Pembayaran SPP Santri';
        $data['santri'] = $this->db->get_where('santri', ['nis' => $this->session->userdata('nis')])->row_array();
        // $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('nis');
        $data['santrii'] = $this->db->get('santri')->row_array();
        $where1 = array('nis' => $nis);
        $data1['santri'] = $this->M_transaksi->tampil_detail($where1)->result();
        $data1['pem_bulan'] = $this->M_transaksi->spp_bulanan()->result();
        // $this->db->select('nama_santri');
        // $data['santri'] = $this->db->get('santri')->row_array();
        $this->db->select('nama_santri');
        $this->db->select('nis,');
        $data['sant'] = $this->db->get('santri')->row_array();
        $sql = "
				SELECT a.id_pem_bulan,a.nis,a.tahun_ajaran,a.jenis_pembayaran,f.total_spp,f.jml_bulan,IF(f.jml_bulan = 12, 'Lunas', 'Belum Lunas') AS status_bayar 
				FROM pembayaran_bulanan a
				LEFT JOIN 
				(
					SELECT e.nis,e.tahun_ajaran,SUM(e.besar_spp) AS total_spp,COUNT(e.id_bulan) AS jml_bulan FROM 
					(
						SELECT b.id_transaksi,b.nis,b.id_bulan,b.id_tahun,c.tahun_ajaran,b.jumlah AS besar_spp
						FROM spp_bulanan b
						INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
						WHERE b.status='0'
					) e GROUP BY e.nis,e.tahun_ajaran
				) f ON a.nis = f.nis AND a.tahun_ajaran = f.tahun_ajaran
				WHERE a.nis = '" . $nis . "'
				";
        $data1['pembayaran_bulanan'] = $this->db->query($sql)->result();
        $data1['pembayaran_lainnya'] = $this->M_transaksi->pembayaran_lainnya($where1)->result();
        $data1['santri'] = $this->db->get_where('santri', ['nis' => $this->session->userdata('nis')])->result();
        // $data1['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();

        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE nis =' . $nis . '');
        if ($query->num_rows() == 0) {
            $this->load->view('template_santri/header', $data);
            $this->load->view('template_santri/sidebar', $data);
            $this->load->view('template_santri/topbar', $data);
            $this->load->view('user_santri/detail_santri', $data1);
            $this->load->view('template_santri/footer', $data);
        } else {
            $this->load->view('template_santri/header', $data);
            $this->load->view('template_santri/sidebar', $data);
            $this->load->view('template_santri/topbar', $data);
            $this->load->view('user_santri/detail_santri', $data1);
            $this->load->view('user_santri/pembayaran_bulanan', $data1);
            $this->load->view('user_santri/pembayaran_lainnya', $data1);
            $this->load->view('template_santri/footer');
        }
    }

    public function spp_bulanan($id, $nis)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Transaksi Pembayaran';
        $data1['santri'] = $this->db->get('santri')->row_array();
        $data11['santri'] = $this->db->get_where('santri', ['nis' => $this->session->userdata('nis')])->row_array();

        $where1 = array('nis' => $nis);
        $this->db->select('nama_santri');
        $this->db->select('nis,');
        $data['sant'] = $this->db->get('santri')->row_array();
        $data['santri'] = $this->M_transaksi->tampil_data($where1)->result();
        $data['santri'] = $this->M_transaksi->tampil_detail($where1)->result();
        $data['tahun'] = $this->M_transaksi->tahun();
        $data['tahun'] = $this->db->get('tahun_ajaran')->result_array();
        $data['tahun_ajaran'] = $this->M_transaksi->session_tahun()->result();
        //$data['pem_bulan'] = $this->M_transaksi->pem_bulan($where1)->result();
        //filter berdasarkan tahun ajaran dan nis
        $sql = "
				SELECT a.*, b.nama_bulan, c.tahun_ajaran 
				FROM spp_bulanan a 
				JOIN bulan b ON a.id_bulan = b.id_bulan 
				JOIN tahun_ajaran c ON a.id_tahun = c.id_tahun 
				WHERE a.nis='" . $nis . "' 
				AND c.tahun_ajaran IN (
					SELECT d.tahun_ajaran FROM pembayaran_bulanan d WHERE d.id_pem_bulan='" . $id . "' 
				)
				ORDER BY a.id_tahun,a.id_bulan
				";
        $data['pem_bulan'] = $this->db->query($sql)->result();
        $data['thaj'] = $this->db->query("SELECT b.id_tahun 
						FROM pembayaran_bulanan a
						inner join tahun_ajaran b ON a.tahun_ajaran = b.tahun_ajaran  
						WHERE a.id_pem_bulan='" . $id . "'")->row()->id_tahun;
        $data['id_pem_bulan'] = $id;
        $this->load->view('template_santri/header', $data);
        $this->load->view('template_santri/sidebar', $data);
        $this->load->view('template_santri/topbar', $data11);
        $this->load->view('user_santri/spp_bulanan', $data);
        $this->load->view('template_santri/footer', $data);
    }
    // function tambah_aksi()
    // {
    //     $nis = $this->input->post('nis');
    //     $id_transaksi = $this->input->post('id_transaksi');
    //     $tgl_bayar = $this->input->post('tgl_bayar');
    //     $id_bulan = $this->input->post('bulan');
    //     $id_tahun = $this->input->post('tahun_ajaran');
    //     $id = $this->input->post('id');
    //     $data = array(
    //         'id_transaksi' => $id_transaksi,
    //         'nis' => $nis,
    //         'id_bulan' => $id_bulan,
    //         'id_tahun' => $id_tahun,
    //         'tanggal_bayar' => $tgl_bayar,
    //         'id' => $id,
    //     );
    //     $query = $this->db->query('SELECT * FROM spp_bulanan 
    // 			WHERE id_bulan =' . $id_bulan . ' 
    // 			AND id_tahun=' . $id_tahun . ' AND nis=' . $nis . '');
    //     if ($query->num_rows() > 0) {
    //         redirect('spp_bulanan/detail/' . $nis, '');
    //     } else {
    //         $this->M_transaksi->input_data($data, 'spp_bulanan');
    //         redirect('spp_bulanan/kurang_tunggakan/' . $nis . '/' . $id_tahun, '');
    //     }
    // }
    public function tambah_aksi()
    {

        // Ambil data yang dikirim dari form
        $bulan = $this->input->post('bulan[]', TRUE);
        $nis = $this->input->post('nis');
        $nama_santri = $this->input->post('nama_santri');
        // $id_trans = rand(000000, 999999);
        $id_transaksi =  $this->input->post('id_transaksi');
        $tgl_bayar = $this->input->post('tgl_bayar');
        $id_tahun = $this->input->post('tahun_ajaran');
        $metode_pembayaran = $this->input->post('metode_pembayaran', TRUE);
        $id = $this->input->post('id');
        $idpembulan = $this->input->post('id_pem_bulan');
        $data = array();
        $statustype = $this->input->post('result_type');
        $statusdata = $this->input->post('result_data');
        $json = json_decode($statusdata, true);
        //echo $json['order_id'];exit;
        $status = ($metode_pembayaran == 'Manual' ? '0' : ($statustype == 'success' ? '0' : ($statustype == 'pending' ? '1' : '2')));
        $orderid = ($metode_pembayaran == 'Manual' ? '' : $json['order_id']);
        $index = 0; // Set index array awal dengan 0
        #penyesuaian tambahan untuk simpan jumlah tabel spp_bulanan
        $jmlspp = $this->db->query("select besar_spp from tahun_ajaran where id_tahun = '" . $id_tahun . "'")->row()->besar_spp;
        foreach ($bulan as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'id_bulan' => $key,
                'nis' => $nis,  // Ambil dan set data nama sesuai index array dari $index
                'nama_santri' => $nama_santri,
                // 'id_trans' => $id_trans,  // Ambil dan set data telepon sesuai index array dari $index
                'id_transaksi' => $id_transaksi++,
                'tanggal_bayar' => $tgl_bayar,
                'metode_pembayaran' => $metode_pembayaran,
                'jumlah' => $jmlspp,
                'id_tahun' => $id_tahun,
                'id' => $id,  // Ambil dan set data alamat sesuai index array dari $index
                'Status' => $status,
                'order_id' => $orderid
            ));

            $key;
        }
        // var_dump($data);
        // exit();
        $sql = $this->M_transaksi->save_batch($data);
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('user_santri/spp_bulanan/' . $idpembulan . '/' . $nis, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('user_santri/spp_bulanan/' . $idpembulan . '/' . $nis, '') . "';</script>";
        }
    }



    function hapus($id_transaksi, $nis, $idpembulan)
    {
        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->M_transaksi->copy_input($where);
        $this->M_transaksi->hapus_data($where2, 'spp_bulanan');
        if ($where2) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('user_santri/spp_bulanan/' . $idpembulan . '/' . $nis, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('user_santri/spp_bulanan/' . $idpembulan . '/' . $nis, '') . "';</script>";
        }
    }
    public function update_bayar()
    {
        // Ambil data yang dikirim dari form
        $idpemlainya = $this->input->post('id_pem_lainya');
        $nis = $this->input->post('nis');
        $tanggal_bayar = $this->input->post('tanggal_bayar');
        $metode_pembayaran = $this->input->post('metode_pembayaran', TRUE);
        $id = $this->input->post('nis');
        $data = array();
        $statustype = $this->input->post('result_type');
        $statusdata = $this->input->post('result_data');
        $json = json_decode($statusdata, true);
        //echo $json['order_id'];exit;
        $status_bayar = ($metode_pembayaran == 'Manual' ? '0' : ($statustype == 'success' ? '0' : ($statustype == 'pending' ? '1' : '')));
        $orderid = ($metode_pembayaran == 'Manual' ? '' : $json['order_id']);
        $index = 1; // Set index array awal dengan 0
        $data = array(
            'tanggal_bayar' => $tanggal_bayar,
            'metode_pembayaran' => $metode_pembayaran,
            'id' => $id,  // Ambil dan set data alamat sesuai index array dari $index
            'status_bayar' => $status_bayar,
            'order_id' => $orderid
        );

        $where = array('id_pem_lainya' => $idpemlainya);
        $sql = $this->M_transaksi->update_data($where, $data, 'pembayaran_lainnya');
        // var_dump($data);
        // die;
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('user_santri/detail_santri/' . $nis, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('user_santri/detail_santri/' . $nis, '') . "';</script>";
        }
        //     redirect('pembayaran/detail/' . $nis, '');
        // }
    }

    public function kartu()
    {
        $data['id_transaksi'] = $this->m_kartu->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Data Pembayaran SPP Siswa';
        $data['santri'] = $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array();
        $nis = $this->session->userdata('nis');
        $where1 = array('nis' => $nis);
        $data1['santri'] = $this->m_kartu->tampil_detail($where1)->result();
        $data2['trans'] = $this->m_kartu->tampil_transaksi($where1)->result();
        $data2['santri'] = $this->db->get_where('santri', ['nis' => $this->session->userdata('nis')])->row_array();

        $this->load->view('template_santri/header', $data);
        $this->load->view('template_santri/sidebar', $data);
        $this->load->view('template_santri/topbar', $data);
        $this->load->view('user_siswa/datadiri', $data1);
        $this->load->view('user_siswa/kartu', $data2);
        $this->load->view('template_santri/footer');
    }
    public function cetak_spp_bulanan($id, $nis)
    {
        $data['tgl_cetak'] = date("Y-m-d H:i:s");
        $data['title'] = 'Cetak Kartu SPP';
        $data['sant'] = $this->db->get('santri')->row_array();
        $data1['santri'] = $this->db->get_where('santri', ['nis' => $this->session->userdata('nis')])->row_array();
        $where1 = array('nis' => $nis);
        $data['santri'] = $this->M_transaksi->tampil_detail($where1)->row();
        //filter berdasarkan tahun ajaran dan nis
        $sql = "
				SELECT a.*, b.nama_bulan, c.tahun_ajaran 
				FROM spp_bulanan a 
				JOIN bulan b ON a.id_bulan = b.id_bulan 
				JOIN tahun_ajaran c ON a.id_tahun = c.id_tahun 
				WHERE a.nis='" . $nis . "' 
				AND c.tahun_ajaran IN (
					SELECT d.tahun_ajaran FROM pembayaran_bulanan d WHERE d.id_pem_bulan='" . $id . "' 
				)
				ORDER BY a.id_tahun,a.id_bulan
				";
        $data['pem_bulan'] = $this->db->query($sql)->result_array();
        $data['thaj'] = $this->db->query("SELECT b.tahun_ajaran 
						FROM pembayaran_bulanan a
						inner join tahun_ajaran b ON a.tahun_ajaran = b.tahun_ajaran  
						WHERE a.id_pem_bulan='" . $id . "'")->row()->tahun_ajaran;
        $data['id_pem_bulan'] = $id;
        $this->load->view('template_santri/header', $data);
        $this->load->view('template_santri/sidebar', $data);
        $this->load->view('template_santri/topbar', $data1);
        $this->load->view('user_santri/kartu_spp', $data);
        $this->load->view('template_santri/footer');
    }
    public function cetak_kwitansi_pembayaran($id, $nis)
    {
        $data['tgl_cetak'] = date("Y-m-d H:i:s");
        $data['title'] = 'Transaksi Pembayaran';
        $data2['santri'] = $this->db->get_where('santri', ['nis' => $this->session->userdata('nis')])->row_array();

        $data['santri'] = $this->db->get_where('santri', ['nis' => $this->session->userdata('nis')])->row_array();
        $where1 = array('nis' => $nis);
        $where2 = array('nis' => $nis, 'id_pem_lainya' => $id);
        $data['santri'] = $this->M_transaksi->tampil_detail($where1)->row();
        $data['pembayaran_lainnya'] = $this->db->query("SELECT * FROM pembayaran_lainnya WHERE id_pem_lainya=" . $id . " AND nis='" . $nis . "'")->row();
        $this->load->view('template_santri/header', $data);
        $this->load->view('template_santri/sidebar', $data);
        $this->load->view('template_santri/topbar', $data2);
        $this->load->view('user_santri/kwitansi_pembayaran', $data);
        $this->load->view('template_santri/footer');
    }
}
