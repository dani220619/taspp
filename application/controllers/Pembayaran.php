<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    // var $data = array();
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('M_transaksi');
        $this->load->model('M_pem_bulanan');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Transaksi Pembayaran';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $data1['santri'] = $this->M_transaksi->tampil_data()->result();
        $data['tahun'] = $this->M_transaksi->tahun();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('pembayaran/index', $data1);
        $this->load->view('template/footer');
    }

    public function detail($nis)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Data Pembayaran SPP Santri';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('nis' => $nis);

        $th_ajaran = "SELECT pembayaran_bulanan.tahun_ajaran
        FROM pembayaran_bulanan";
        $data1['th_ajaran1'] = $this->db->query($th_ajaran)->row_array();
        $tr = $data1['th_ajaran1'];
        $data1['santri'] = $this->M_transaksi->tampil_detail($where1)->result();
        $data['santri'] = $this->M_transaksi->tampil_detail($where1)->result();
        // var_dump($tr);
        // exit();
        $sql = "SELECT a.id_tahun, a.nis, a.nama_santri, b.id_tahun, SUM(b.besar_spp), b.tahun_ajaran FROM spp_bulanan a, tahun_ajaran b
        WHERE a.id_tahun = b.id_tahun
        AND nis = $nis AND tahun_ajaran = '2020/2021'";
        $data1['coba'] = $this->db->query($sql)->row_array();
        $data1['spp'] = $data1['coba']['SUM(b.besar_spp)'];
        // var_dump($besar_spp['spp']);
        // exit();
        // var_dump($data1['coba']['SUM(a.besar_spp)']);
        // exit;

        //$data1['pembayaran_bulanan'] = $this->M_transaksi->pembayaran_bulanan($where1)->result();
        #total pembayaran spp pertahun ajaran
        /*$sql = "SELECT f.nis,f.tahun_ajaran,f.total_spp,f.jml_bulan,a.jenis_pembayaran,IF(f.jml_bulan = 12, 'Lunas', 'Belum Lunas') AS status_bayar FROM 
				(
					SELECT e.nis,e.tahun_ajaran,SUM(e.besar_spp) AS total_spp,COUNT(e.id_bulan) AS jml_bulan FROM 
					(
						SELECT b.id_transaksi,b.nis,b.id_bulan,b.id_tahun,c.tahun_ajaran,c.besar_spp
						FROM spp_bulanan b
						INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
						WHERE b.nis='".$nis."' AND b.status='0'
					) e GROUP BY e.nis,e.tahun_ajaran
				) f 
				INNER JOIN pembayaran_bulanan a ON f.nis = a.nis AND f.tahun_ajaran = a.tahun_ajaran";
		*/
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
        $data1['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();


        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE nis =' . $nis . '');
        if ($query->num_rows() == 0) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('pembayaran/detail_santri', $data);
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('pembayaran/detail_santri', $data1);
            $this->load->view('pembayaran/pembayaran_bulanan', $data1);
            $this->load->view('pembayaran/pembayaran_lainnya', $data1);
            $this->load->view('template/footer');
        }
    }
    //public function spp_bulanan($nis)
    public function spp_bulanan($id, $nis)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Transaksi Pembayaran';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('nis' => $nis);

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
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('pembayaran/spp_bulanan', $data);
        $this->load->view('template/footer');
    }

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
        $no_virtual = ($metode_pembayaran == 'Manual' ? '' : $json['va_numbers'][0]['va_number'] . '|' . $json['va_numbers'][0]['bank']);
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
                'order_id' => $orderid,
                'no_virtual' => $no_virtual
            ));

            $key;
        }
        // var_dump($orderid);
        // exit();
        $sql = $this->M_transaksi->save_batch($data);
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('pembayaran/spp_bulanan/' . $idpembulan . '/' . $nis, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('pembayaran/spp_bulanan/' . $idpembulan . '/' . $nis, '') . "';</script>";
        }
    }



    function hapus($id_transaksi, $nis, $idpembulan)
    {
        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->M_transaksi->copy_input($where);
        $this->M_transaksi->hapus_data($where2, 'spp_bulanan');
        if ($where2) { // Jika sukses
            echo "<script>alert('Data berhasil dihapus');window.location = '" . base_url('pembayaran/spp_bulanan/' . $idpembulan . '/' . $nis, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal dihapus');window.location = '" . base_url('pembayaran/spp_bulanan/' . $idpembulan . '/' . $nis, '') . "';</script>";
        }
    }
    public function index_bulanan()
    {
        $data['title'] = 'Pembayaran Bulanan';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $sql = "SELECT b.id_pem_bulan, a.nama_santri, b.nis, b.jenis_pembayaran, b.tahun_ajaran FROM santri a, pembayaran_bulanan b
        WHERE a.nis=b.nis";
        $data['pembayaran_bulanan'] = $this->db->query($sql)->result();
        // $data['pembayaran_bulanan'] = $this->M_transaksi->tampil_pem_bulanan();
        // $data1['tahun_aktif'] = $this->M_thaktif->tampil_data();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('pembayaran/index_bulanan', $data);
        $this->load->view('template/footer');
    }
    public function tambah_pem_bulanan()
    {

        // Ambil data yang dikirim dari form
        $id_pem_bulan = rand(0000, 9999);
        $nis = $this->input->post('nis[]', TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        // $id_trans = rand(000000, 999999);
        $jenis_pembayaran =  $this->input->post('jenis_pembayaran');
        $data = array();

        $index = 1; // Set index array awal dengan 0
        foreach ($nis as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'nis' => $key,
                'id_pem_bulan' => $id_pem_bulan++,  // Ambil dan set data nama sesuai index array dari $index
                'tahun_ajaran' => $tahun_ajaran,
                // 'id_trans' => $id_trans,  // Ambil dan set data telepon sesuai index array dari $index
                'jenis_pembayaran' => $jenis_pembayaran,

            ));

            $key;
        }

        $sql = $this->M_transaksi->save_pem_bulanan($data);
        // var_dump($data);
        // exit();
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('pembayaran/index_bulanan') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('pembayaran/index_bulanan') . "';</script>";
        }
    }
    public function delete_pem_bulanan()
    {
        $id_pem_bulan = $this->input->get('id_pem_bulan');
        $this->db->delete('pembayaran_bulanan', array('id_pem_bulan' => $id_pem_bulan));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('pembayaran/index_bulanan');
    }

    public function index_lainya()
    {
        $data['title'] = 'Pembayaran Lainnya';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $sql = "SELECT a.id_pem_lainya, a.tahun_ajaran, a.nis, a.jenis_pembayaran,a.total_tagihan, b.nama_santri
        FROM pembayaran_lainnya a, santri b
        WHERE a.nis=b.nis";
        $data['pembayaran_lainya'] = $this->db->query($sql)->result();
        $data['santri'] = $this->M_transaksi->tampil_data()->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('pembayaran/index_lainya', $data);
        $this->load->view('template/footer');
    }
    public function tambah_pem_lainya()
    {
        $id_pem_lainya = rand(0000, 9999);
        $nis = $this->input->post('nis[]', TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $total_tagihan = $this->input->post('total_tagihan');
        // $id_trans = rand(000000, 999999);
        $id = $this->input->post('id');
        $jenis_pembayaran =  $this->input->post('jenis_pembayaran');
        $data = array();
        $index = 0; // Set index array awal dengan 0
        foreach ($nis as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'nis' => $key,
                'id' => $id,
                'id_pem_lainya' => $id_pem_lainya++,  // Ambil dan set data nama sesuai index array dari $index
                'tahun_ajaran' => $tahun_ajaran,
                'total_tagihan' => $total_tagihan,
                // 'id_trans' => $id_trans,  // Ambil dan set data telepon sesuai index array dari $index
                'jenis_pembayaran' => $jenis_pembayaran,
            ));
            $key;
        }
        $sql = $this->M_transaksi->save_pem_lainya($data);
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('pembayaran/index_lainya') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('pembayaran/index_lainya') . "';</script>";
        }
    }
    public function update_bayar()
    {
        // Ambil data yang dikirim dari form
        $idpemlainya = $this->input->post('id_pem_lainya');
        $nis = $this->input->post('nis');
        $tanggal_bayar = $this->input->post('tanggal_bayar');
        $metode_pembayaran = $this->input->post('metode_pembayaran', TRUE);
        $id = $this->input->post('id');
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
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('pembayaran/detail/' . $nis, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('pembayaran/detail/' . $nis, '') . "';</script>";
        }
    }

    public function cetak_spp_bulanan($id, $nis)
    {
        $data['tgl_cetak'] = date("Y-m-d H:i:s");
        $data['title'] = 'Cetak Kartu SPP';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
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
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('pembayaran/kartu_spp', $data);
        $this->load->view('template/footer');
    }

    public function cetak_kwitansi_pembayaran($id, $nis)
    {
        $data['tgl_cetak'] = date("Y-m-d H:i:s");
        $data['title'] = 'Transaksi Pembayaran';
        $data['bendahara'] = $this->db->get_where('bendahara', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('nis' => $nis);
        $where2 = array('nis' => $nis, 'id_pem_lainya' => $id);
        $data['santri'] = $this->M_transaksi->tampil_detail($where1)->row();
        $data['pembayaran_lainnya'] = $this->db->query("SELECT * FROM pembayaran_lainnya WHERE id_pem_lainya=" . $id . " AND nis='" . $nis . "'")->row();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('pembayaran/kwitansi_pembayaran', $data);
        $this->load->view('template/footer');
    }
}
//