<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sarpras extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'report/sarpras/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_helper');
		$this->load->model('sarpras_m', 'data');
		signin();
		group(array('1','2','3'));
	}
	
	//halaman index
	public function index()
	{
		$id = $this->uri->segment(3);
		$data['head'] 		= 'Laporan Sarana Prasarana';
		$data['record'] 	= $this->data->get_id($id);
		//$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['list'] 		= $this->data->get_list_edit($id);

		$this->load->view('report/sarpras/default', $data);
	}
}
