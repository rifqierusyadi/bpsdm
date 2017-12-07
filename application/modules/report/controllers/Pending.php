<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pending extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'report/pending/';
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('my_helper');
		$this->load->helper('help_helper');
		$this->load->model('pending_m', 'data');
		signin();
		group(array('1','2','3'));
	}
	
	//halaman index
	public function index()
	{
		$id = $this->uri->segment(3);
		$data['head'] 		= 'Laporan Pemohon Diklat';
		$data['record'] 	= $this->data->get_pending();
		$data['pengelola'] 	= $this->data->get_pengelola();
		$data['pangkat'] 	= $this->data->get_pangkat();
		$data['eselon'] 	= $this->data->get_eselon();
		$data['tahun'] 		= $this->data->get_tahun();
		//$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('report/pending/default', $data);
	}

	public function filter_pending()
	{
		$id = $this->uri->segment(3);
		$pengelola = $this->input->post('pengelola');
		$kategori = $this->input->post('kategori');
		$periode = $this->input->post('periode');
		
		$data['head'] 		= 'Laporan Pemohon Diklat';
		$data['record'] 	= $this->data->get_filter_pending($pengelola, $kategori, $periode);
		//$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('report/pending/filter', $data);
	}

	public function pending()
	{
		$id = $this->uri->segment(3);
		$data['head'] 		= 'Laporan Pemohon Diklat';
		$data['record'] 	= $this->data->get_pending();
		//$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('report/pending/pending', $data);
	}
}
