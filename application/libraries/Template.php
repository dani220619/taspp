<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Template 
 * @category Library
 * @author dani lukman hakim
 */

class Template
{
	protected $ci;

	/**
	 * constructor
	 */
	public function __construct()
	{
		$this->ci = &get_instance();
	}

	/**
	 * Site template
	 * 
	 * @param  string $page
	 * @param  array  $data
	 */
	public function site($page = '', $data = array())
	{
		$data['page'] = $this->ci->load->view('site/' . $page, $data, TRUE);
		$this->ci->load->view('site/base', $data);
	}

	/**
	 * Admin template
	 * 
	 * @param  string $page
	 * @param  array  $data
	 */
	public function admin($page = '', $data = array())
	{
		$data['page'] = $this->ci->load->view('admin/' . $page, $data, TRUE);
		$this->ci->load->view('admin/base', $data);
	}
}

/* End of file Template.php */
/* Location : ./application/libraries/Template.php */