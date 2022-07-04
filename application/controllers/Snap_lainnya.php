<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap_lainnya extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        //$params = array('server_key' => 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k', 'production' => false, 'sanitized' => true, '3ds' => true);
        //$this->load->library('midtrans');
        //$this->midtrans->config($params);
        #Hendi, 2020-11-24
        require_once APPPATH . 'vendor\midtrans\midtrans-php\Midtrans.php';
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $this->config->item('serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction
        \Midtrans\Config::$isProduction = $this->config->item('isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = $this->config->item('isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = $this->config->item('is3ds');
        // Use new notification url(s) disregarding the settings on Midtrans Dashboard Portal (MAP)
        \Midtrans\Config::$overrideNotifUrl = base_url('snap');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('checkout_snap');
    }

    public function token()
    {
        $id = $this->input->post('id_bayar');
        $nis = $this->input->post('nis');
        $namasantri = $this->input->post('nama_santri');
        $total = $this->input->post('total');
        $jenispembayaran = $this->input->post('jenis_pembayaran');

        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $total
        );

        // Optional
        $item_details = array();
        $desc = $jenispembayaran;
        $details = array(
            'id' => "$id",
            'price' => $total,
            'quantity' => 1,
            'name' => "$desc"
        );

        array_push($item_details, $details);

        // Optional
        $billing_address = array(
            'first_name' => "$namasantri",
            'last_name' => 'a',
            'address' => 'a',
            'city' => 'a',
            'postal_code' => 'a',
            'phone' => 'a',
            'country_code' => 'IDN'
        );
        // Optional
        $shipping_address = array(
            'first_name' => "$namasantri",
            'last_name' => 'a',
            'address' => 'a',
            'city' => 'a',
            'postal_code' => 'a',
            'phone' => 'a',
            'country_code' => 'IDN'
        );
        // Optional
        $customer_details = array(
            'first_name' => "$namasantri",
            'last_name' => 'a',
            'email' => 'a',
            'phone' => 'a',
            'billing_address' => $billing_address,
            'shipping_address' => $shipping_address
        );
        //echo json_encode($item_details);exit;
        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
        );
        //'customer_details' => $customer_details	
        $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);
        echo $snapToken;
    }


    public function finish()
    {
        $result = json_decode($this->input->post('result_data'));
        echo 'RESULT <br><pre>';
        var_dump($result);
        echo '</pre>';
    }

    public function cekStatusTransaksi($idbayar, $nis, $orderid)
    {
        try {
            $response = \Midtrans\Transaction::status($orderid);
            if ($response->status_code == 200) {
                $sql = "UPDATE pembayaran_lainnya SET status_bayar='0' WHERE id_pem_lainya='$idbayar' AND nis='$nis' AND order_id='$orderid'";
                $this->db->query($sql);
                echo 'success';
            } else {
                if ($response->transaction_status == 'pending') {
                } else {
                    $sql = "UPDATE pembayaran_lainnya SET status_bayar='1' WHERE id_pem_lainya='$idbayar' AND nis='$nis' AND order_id='$orderid'";
                    $this->db->query($sql);
                }
                echo $response->transaction_status;
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getCode() . ' ' . $e->getMessage();
        }
    }
}
//