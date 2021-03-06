<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'referensi/jenis/';
	
	public function __construct()
	{
		parent::__construct();
        $this->load->helper('help_helper');
        $this->load->model('jenis_m', 'data');
		signin();
		admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Referensi Jenis Jabatan';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Referensi Jenis Jabatan';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
        $data['js'] 		= $this->folder.'js';
        $data['eselon'] 	= $this->data->get_eselon();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id)
	{
		$data['head'] 		= 'Ubah Referensi Jenis Jabatan';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
        $data['js'] 		= $this->folder.'js';
        $data['eselon'] 	= $this->data->get_eselon();
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_list()
    {
        $record	= $this->data->get_datatables();
        $data 	= array();
        $no 	= $_POST['start'];
		
        foreach ($record as $row) {
            $no++;
            $col = array();
            $col[] = '<input type="checkbox" class="data-check" value="'.$row->id.'">';
            $col[] = $row->kategori_id = 1 ?  'STRUKTURAL' : 'FUNGSIONAL';
            $col[] = $row->jenis;
            $col[] = eselon($row->eselon_id);
			
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('referensi/jenis/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" title="Hapus" onclick="deleted('."'".$row->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
 
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
	
	public function ajax_save()
    {
        $data = array(
                'kategori_id' => $this->input->post('kategori_id'),
                'eselon_id' => $this->input->post('eselon_id'),
                'jenis' => $this->input->post('jenis')
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Referensi Jenis Jabatan");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
            'kategori_id' => $this->input->post('kategori_id'),
            'eselon_id' => $this->input->post('eselon_id'),
            'jenis' => $this->input->post('jenis')
        );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Referensi Jenis Jabatan");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Referensi Jenis Jabatan");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Referensi Jenis Jabatan");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		if(!isset($id)){
			$this->form_validation->set_rules("eselon_id", "Tingkat Jabatan", "trim|required");
			$this->form_validation->set_rules("jenis", "Nama Jenis Jabatan", "trim|required|is_unique[ref_jenis.jenis]");
		}else{
			$this->form_validation->set_rules("eselon_id", "Tingkat Jabatan", "trim|required");
			$this->form_validation->set_rules("jenis", "Nama Jenis Jabatan", "trim|required");
		}
        
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        
        if($this->form_validation->run()){
            $data['success'] = true;
        }else{
            foreach ($_POST as $key => $value) {
                $data['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($data);
        return $this->form_validation->run();
    }
}
