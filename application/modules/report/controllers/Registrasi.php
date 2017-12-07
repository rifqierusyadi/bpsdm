<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'report/registrasi/';
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('my_helper');
		$this->load->helper('help_helper');
		$this->load->model('registrasi_m', 'data');
		signin();
		group(array('1','2','3'));
	}
	
	//halaman index
	public function index()
	{
		$id = $this->uri->segment(3);
		$data['head'] 		= 'Laporan Registrasi Diklat';
		$data['record'] 	= $this->data->get_registrasi();
		$data['pengelola'] 	= $this->data->get_pengelola();
		$data['pangkat'] 	= $this->data->get_pangkat();
		$data['eselon'] 	= $this->data->get_eselon();
		$data['ktpu'] 		= $this->data->get_ktpu();
		//$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('report/registrasi/default', $data);
	}

	public function get_filter()
	{
		$id = $this->uri->segment(3);
		$pengelola = $this->input->post('pengelola');
		$eselon = $this->input->post('eselon');
		$pangkat = $this->input->post('pangkat');
		$pendidikan = $this->input->post('pendidikan');

		$data['head'] 		= 'Laporan Registrasi Diklat';
		$data['record'] 	= $this->data->get_filter($pengelola, $eselon, $pangkat, $pendidikan);
		$data['pengelola'] 	= $this->data->get_pengelola();
		$data['pangkat'] 	= $this->data->get_pangkat();
		$data['eselon'] 	= $this->data->get_eselon();
		$data['ktpu'] 		= $this->data->get_ktpu();
		//$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('report/registrasi/filter', $data);
	}
}
