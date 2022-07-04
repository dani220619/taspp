<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
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
		$params = array(
			'server_key' => $this->config->item('serverKey'),
			'production' => $this->config->item('isProduction'),
			'sanitized' => $this->config->item('isSanitized'),
			'3ds' => $this->config->item('is3ds')
		);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}


	public function index()
	{
		$this->load->view('midtrans/checkout_snap');
	}

	public function token()
	{
		$nis = $this->input->post('nis');
		$namasantri = $this->input->post('nama_santri');
		$bulan = $this->input->post('bulan', TRUE);
		$jmlspp = $this->input->post('jml_spp');
		$total = $this->input->post('total_spp');

		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $total
		);

		// Optional
		$item_details = array();
		for ($i = 0; $i < count($bulan); $i++) {
			// Optional
			$idbln = $bulan[$i];
			switch ($idbln) {
				case '01':
					$nmbulan = 'Januari';
					break;
				case '02':
					$nmbulan = 'Februari';
					break;
				case '03':
					$nmbulan = 'Maret';
					break;
				case '04':
					$nmbulan = 'April';
					break;
				case '05':
					$nmbulan = 'Mei';
					break;
				case '06':
					$nmbulan = 'Juni';
					break;
				case '07':
					$nmbulan = 'Juli';
					break;
				case '08':
					$nmbulan = 'Agustus';
					break;
				case '09':
					$nmbulan = 'September';
					break;
				case '10':
					$nmbulan = 'Oktober';
					break;
				case '11':
					$nmbulan = 'November';
					break;
				case '12':
					$nmbulan = 'Desember';
					break;
				default:
					$nmbulan = '';
			}

			$desc = "SPP " . $nmbulan . " " . date("Y");
			$details = array(
				'id' => "$idbln",
				'price' => $jmlspp,
				'quantity' => 1,
				'name' => "$desc"
			);

			array_push($item_details, $details);
		}
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
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'));
		echo 'RESULT <br><pre>';
		var_dump($result);
		echo '</pre>';
	}

	public function cekStatusTransaksi($idtransaksi, $nis, $orderid)
	{
		try {
			$statustype = $this->midtrans->status($orderid);
			if ($statustype->status_code == 200) {
				$sql = "UPDATE spp_bulanan SET status='0' WHERE id_transaksi='$idtransaksi' AND nis='$nis' AND order_id='$orderid'";
				$this->db->query($sql);
				echo 'success';
			} else {
				if ($statustype->transaction_status == 'pending') {
				} else {
					$sql = "UPDATE spp_bulanan SET status='1' WHERE id_transaksi='$idtransaksi' AND nis='$nis' AND order_id='$orderid'";
					$this->db->query($sql);
				}
				echo $statustype->transaction_status;
			}
		} catch (Exception $e) {
			echo 'Error: ' . $e->getCode() . ' ' . $e->getMessage();
		}
	}
}
//