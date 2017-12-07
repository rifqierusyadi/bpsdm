<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diklat extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'referensi/diklat/';
	
	public function __construct()
	{
		parent::__construct();
        $this->load->helper('help_helper');
        $this->load->model('diklat_m', 'data');
		signin();
		admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Referensi Jenis Diklat';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Referensi Jenis Diklat';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
        $data['js'] 		= $this->folder.'js';
        $data['jenis']  	= $this->data->get_jenis();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id)
	{
		$data['head'] 		= 'Ubah Referensi Jenis Diklat';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
        $data['js'] 		= $this->folder.'js';
        $data['jenis']  	= $this->data->get_jenis();
        $data['detail']  	= $this->data->get_detail($id);
		
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
            $col[] = kategori($row->kategori_id);
            $col[] = $row->jenis;
            $col[] = $row->jenjang;
            $col[] = $row->diklat;
			
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('referensi/diklat/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
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
            'jenis_id' => $this->input->post('jenis_id'),
            'jenjang_id' => $this->input->post('jenjang_id'),
            'diklat' => $this->input->post('diklat')
        );

        if($this->validation()){
            $insert = $this->data->insert($data);
            $syarat = $this->input->post('syarat');
			$result = array();
			foreach($syarat AS $key => $val){
				if($_POST['syarat'][$key] != ''){
					$result[] = array(
					 "diklat_id"  => $insert,
					 "syarat"  => $_POST['syarat'][$key]
					);
				}
			}
			$this->db->insert_batch('ref_diklat_detail', $result);
			helper_log("add", "Menambah Referensi Jenis Diklat");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
            'kategori_id' => $this->input->post('kategori_id'),
            'jenis_id' => $this->input->post('jenis_id'),
            'jenjang_id' => $this->input->post('jenjang_id'),
            'diklat' => $this->input->post('diklat')
        );

        if($this->validation($id)){
            $update = $this->data->update($data, $id);
            $this->data->hapus($id);
            $syarat = $this->input->post('syarat');
			$result = array();
			foreach($syarat AS $key => $val){
				if($_POST['syarat'][$key] != ''){
					$result[] = array(
					 "diklat_id"  => $id,
					 "syarat"  => $_POST['syarat'][$key]
					);
				}
			}
			$this->db->insert_batch('ref_diklat_detail', $result);
			helper_log("edit", "Merubah Referensi Jenis Diklat");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Referensi Jenis Diklat");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Referensi Jenis Diklat");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		if(!isset($id)){
            $this->form_validation->set_rules("jenis_id", "Jenis Jabatan", "trim|required");
            $this->form_validation->set_rules("jenjang_id", "Jenjang Jabatan", "trim|required");
            $this->form_validation->set_rules("diklat", "Nama Diklat", "trim|required");
		}else{
            $this->form_validation->set_rules("jenis_id", "Jenis Jabatan", "trim|required");
            $this->form_validation->set_rules("jenjang_id", "Jenjang Jabatan", "trim|required");
            $this->form_validation->set_rules("diklat", "Nama Diklat", "trim|required");
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

    public function get_jenis(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $kategori = $this->input->post('kategori_id');
		$jenis = $this->data->get_jenis($kategori);
        if(!empty($jenis)){
           $selected = set_value('jenis_id', $record ? $record->jenis_id : '');
            echo form_dropdown('jenis_id', $jenis, $selected, "class='form-control select2' name='jenis_id' id='jenis_id'");
        }else{
            echo form_dropdown('jenis_id', array(''=>'Pilih Jenis Jabatan'), '', "class='form-control select2' name='jenis_id' id='jenis_id'");
        }
    }

    public function get_jenjang(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $jenis = $this->input->post('jenis_id');
		$jenjang = $this->data->get_jenjang_id($jenis);
        if(!empty($jenjang)){
           $selected = set_value('jenjang_id', $record ? $record->jenjang_id : '');
            echo form_dropdown('jenjang_id', $jenjang, $selected, "class='form-control select2' name='jenjang_id' id='jenjang_id'");
        }else{
            echo form_dropdown('jenjang_id', array(''=>'Pilih Jenjang Jabatan'), '', "class='form-control select2' name='jenjang_id' id='jenjang_id'");
        }
    }
}
