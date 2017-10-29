<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'profil/profil/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_helper');
		$this->load->model('profil_m', 'data');
		signin();
		//group(array('1'));
	}
	
	//halaman index
	public function index()
	{
		// ini_set('memory_limit', '-1');
		// $data['head'] 		= 'Data Profil';
		// $data['record'] 	= $this->data->get_all();
		// $data['content'] 	= $this->folder.'default';
		// $data['style'] 		= $this->folder.'style';
		// $data['js'] 		= $this->folder.'js';
		
		// $this->load->view('template/default', $data);
		redirect('daftar');
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Data Profil';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['pengelola'] 	= $this->data->get_pengelola();
		$data['group'] 		= $this->data->get_group();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id)
	{
		$data['head'] 		= 'Ubah Data Profil';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['eselon'] 	= $this->data->get_eselon();
		$data['pangkat'] 	= $this->data->get_pangkat();
		$data['ktpu'] 		= $this->data->get_ktpu();
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_list()
    {
        ini_set('memory_limit', '-1');
		$record	= $this->data->get_datatables();
        $data 	= array();
        $no 	= $_POST['start'];
		
        foreach ($record as $row) {
            $no++;
            $col = array();
            $col[] = '<input type="checkbox" class="data-check" value="'.$row->id.'">';
            $col[] = $row->fullname;
			$col[] = $row->email;
			$col[] = $row->pengelola ? $row->pengelola : 'Semua';
			$col[] = level($row->level);
			$col[] = $row->active ? '<a type="button" class="btn btn-xs btn-flat btn-success"><i class="fa fa-check-circle"></i> </a>' : '<a type="button" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-circle-o"></i> </a>';
			
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" onclick="edit_data();" href="'.site_url('setting/password/updated/'.$row->id).'" data-toggle="tooltip" title="Ganti Password"><i class="fa fa-key"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('setting/profil/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
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
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'tmlahir' => $this->input->post('tmlahir'),
			'tglahir' => $this->input->post('tglahir'),
			'sex' => $this->input->post('sex'),
			'alamat' => $this->input->post('alamat'),
			'telpon' => $this->input->post('telpon'),
			'instansi' => $this->input->post('instansi'),
			'unker' => $this->input->post('unker'),
			'satker' => $this->input->post('satker'),
			'jenis_id' => $this->input->post('jenis_id'),
			'jabatan' => $this->input->post('jabatan'),
			'eselon_id' => $this->input->post('eselon_id'),
			'pangkat_id' => $this->input->post('pangkat_id'),
			'ktpu_id' => $this->input->post('ktpu_id'),
			'jurusan' => $this->input->post('jurusan'),
		);
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Data Profil");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'tmlahir' => $this->input->post('tmlahir'),
				'tglahir' => yyyymmdd($this->input->post('tglahir')),
				'sex' => $this->input->post('sex'),
				'alamat' => $this->input->post('alamat'),
				'telpon' => $this->input->post('telpon'),
				'instansi' => $this->input->post('instansi'),
				'unker' => $this->input->post('unker'),
				'satker' => $this->input->post('satker'),
				'jenis_id' => $this->input->post('jenis_id'),
				'jabatan' => $this->input->post('jabatan'),
				'eselon_id' => $this->input->post('eselon_id'),
				'pangkat_id' => $this->input->post('pangkat_id'),
				'ktpu_id' => $this->input->post('ktpu_id'),
				'jurusan' => $this->input->post('jurusan'),
            );
		$idx = $this->db->get_where('identitas', array('user_id'=> $id))->row()->id;
        if($this->validation($id)){
            $this->data->update($data, $idx);
			helper_log("edit", "Merubah Data Profil");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Data Profil");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Data Profil");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        $data = array('success' => false, 'messages' => array());
        
		// if(!isset($id)){
		// 	$this->form_validation->set_rules("fullname", "Nama Lengkap", "trim|required");
		// 	$this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]|max_length[18]");
		// 	$this->form_validation->set_rules("repassword", "Ulangi Password", "trim|required|matches[password]");
		// }else{
		// 	//$this->form_validation->set_rules("profilname", "Username", "trim|required");
		// }
        
		$this->form_validation->set_rules("nip", "NIP", "trim|required");
		$this->form_validation->set_rules("nama", "Nama Lengkap", "trim|required");
		$this->form_validation->set_rules("telpon", "Telpon", "trim|is_natural");
		
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
	
	public function ajax_csfr()
    {
        echo json_encode(array("token" => $this->security->get_csrf_token_name(), "key"=>$this->security->get_csrf_hash()));
    }
	
	public function get_satker(){
        $record = $this->data->get_id($this->uri->segment(4));
		$unker = $this->input->post('unker');
        $satker = $this->data->get_satker($unker);
        if(!empty($satker)){
            //$selected = (set_value('parent')) ? set_value('parent') : '';
			$selected = set_value('satker', $record->satker_id);
            echo form_dropdown('satker', $satker, $selected, "class='form-control select2' name='satker' id='satker'");
        }else{
            echo form_dropdown('satker', array(''=>'Pilih Satuan Kerja'), '', "class='form-control select2' name='satker' id='satker'");
        }
    }
}
