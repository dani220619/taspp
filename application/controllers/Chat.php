<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Chat
 * @category Controller
 * @author dani lukman hakim
 */

class Chat extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Create room
	 * 
	 */
	public function create_room()
	{
		if ($this->input->method(TRUE) === 'POST' && $this->input->is_ajax_request()) {
			if (empty(aktif_sesi())) {
				$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

				if ($this->form_validation->run() === TRUE) {
					$this->output->set_content_type('application/json')->set_output(json_encode(array(
						'status' => 'success',
						'data' => $this->create_new_room($this->input->post())
					)));
				} else {
					$this->output->set_content_type('application/json')->set_output(json_encode(array(
						'status' => 'validation_errors',
						'data' => $this->form_validation->error_array()
					)));
				}
			} else {
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 'success',
					'data' => $this->create_new_room()
				)));
			}
		} else {
			show_404();
		}
	}

	/**
	 * Create new room
	 */
	private function create_new_room($data = array())
	{
		$new_room = 0;

		if (empty(aktif_sesi())) {
			$new_room =  $this->chat_room_model->create(array(
				'customer_name' => $data['full_name'],
				'customer_email' => $data['email'],
				'status' => 'menunggu'
			));
		} else {
			$new_room =  $this->chat_room_model->create(array(
				'customer' => aktif_sesi()['id'],
				'status' => 'menunggu'
			));
		}

		return $this->chat_room_model->view($new_room);
	}

	/**
	 * Get room info
	 * 
	 * @param  integer $roomd_id
	 */
	public function room_info($room_id = NULL)
	{
		$chat_room = $this->chat_room_model->view($room_id);

		if (!empty($chat_room)) {
			if (!empty($chat_room['customer'])) {
				$customer = $this->pengguna_model->view($chat_room['customer']);
				$chat_room['customer_name'] = $customer['nama_lengkap'];
				$chat_room['customer_email'] = $customer['email'];
				$chat_room['id'] = $chat_room['id'];
				$chat_room['customer'] = $chat_room['customer'];
				$chat_room['status'] = $chat_room['status'];
			}

			$this->output->set_content_type('application/json')->set_output(json_encode(array(
				'status' => 'success',
				'data' => $chat_room
			)));
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'failed', 'message' => 'chat_room_not_found')));
		}
	}

	/**
	 * Get chat message
	 * 
	 * @param  integer $room_id
	 * @param  integer $limit
	 * @param  integer $offset
	 */
	public function messages($room_id = NULL, $limit = 10, $offset = 0, $desc = FALSE)
	{
		$chat_room = $this->chat_room_model->view($room_id);

		if (!empty($chat_room)) {
			if (filter_var($desc, FILTER_VALIDATE_BOOLEAN)) {
				$this->db->order_by('id', 'desc');
			}

			$this->db->limit($limit, $offset);
			$messages = $this->db->get_where('chat_message', array('chat_room' => $chat_room['id']), $limit, $offset)->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode(
				array(
					'status' => 'success',
					'data' => array(
						'chat_room' => $chat_room,
						'messages' => $messages
					)
				)
			));
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'failed', 'message' => 'chat_room_not_found')));
		}
	}

	/**
	 * Update chat room
	 * 
	 * @param integer $room_id
	 */
	public function update_chat_room($room_id = NULL)
	{
		$this->chat_room_model->update($this->input->post(), array('id' => $room_id));
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'data' => $this->chat_room_model->view($room_id))));
	}

	/**
	 * Send message to chat room
	 * 
	 * @param  integer $room_id
	 */
	public function send_message($room_id = NULL)
	{
		if ($this->input->method(TRUE) === 'POST') {
			$chat_room = $this->chat_room_model->view($room_id);

			if (!empty($chat_room)) {
				$this->chat_message_model->create(array(
					'chat_room' => $chat_room['id'],
					'by' => $this->input->post('from'),
					'text' => $this->input->post('message')
				));

				$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'status' => 'success',
						'data' => array(
							'chat_room' => $chat_room,
							'message' => $this->input->post('message')
						)
					)
				));
			} else {
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'failed', 'message' => 'chat_room_not_found')));
			}
		} else {
			show_404();
		}
	}
}

/* End of file Chat.php */
/* Location : ./application/controllers/Chat.php */