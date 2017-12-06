<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'report/sekolah/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_helper');
		$this->load->model('sekolah_m', 'data');
		signin();
		group(array('1','2','3'));
	}
	
	//halaman index
	public function index()
	{
		$id = $this->uri->segment(3);
		$data['head'] 		= 'Laporan Sarana Prasarana';
		$data['record'] 	= $this->data->get_sekolah();
		//$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('report/sekolah/default', $data);
	}
}
