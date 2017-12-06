<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sarana extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'report/sarana/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_helper');
		$this->load->model('sarana_m', 'data');
		signin();
		group(array('1','2'));
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Sarana Prasana';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$this->load->view('template', $data);	
	}
	
	public function ajax_list()
    {
        $record	= $this->data->get_datatables();
        $data 	= array();
        $no 	= $_POST['start'];
		
        foreach ($record as $row) {
            $no++;
            $col = array();
            $col[] = '<input type="checkbox" class="data-check" value="'.$row->kategori_id.'">';
			$col[] = sekolah($row->users_id);
			$col[] = kategori($row->kategori_id);
			$col[] = $row->tahun;
			
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" href="'.site_url('report/sarpras/'.$row->id).'" data-toggle="tooltip" title="Print" target="_blank"><i class="glyphicon glyphicon-print"></i></a>';
            $data[] = $col;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->data->count_all(),
                        "recordsFiltered" => $this->data->count_filtered(),
                        "data" => $data,
                );
        
		echo json_encode($output);
    }
}
