<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fungsional extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'diklat/fungsional/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('help_helper');
		$this->load->helper('my_helper');
		$this->load->model('fungsional_m', 'data');
		signin();
		group(array('4'));
	}
	
	//halaman index
	public function index()
	{
		ini_set('memory_limit', '-1');
		// $data['head'] 		= 'Registrasi Diklat Fungsional';
		// $data['record'] 	= $this->data->get_all();
		// $data['content'] 	= $this->folder.'default';
		// $data['style'] 		= $this->folder.'style';
		// $data['js'] 		= $this->folder.'js';
		// $data['id']			= $this->session->userdata('userID');

		// $this->load->view('template/default', $data);
		redirect('daftar');
	}
	
	public function created()
	{
		$datas = $this->data->get_data($this->session->userdata('userID'));
		if($datas->nip == '' || $datas->nama == '' || $datas->tmlahir == '' || $datas->tglahir == '' || $datas->instansi == '' || $datas->unker == '' || $datas->satker == '' || $datas->jabatan == '')
		{
			$this->session->set_flashdata('flasherror','Silahkan Lengkapi/Perbaharui Data Profil Anda Terlebih Dahulu');
			redirect('daftar');
		}
		
		$data['head'] 		= 'Tambah Registrasi Diklat Fungsional';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['jenis'] 		= $this->data->get_jenis(2);
		$data['periode'] 	= $this->data->get_periode();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id)
	{
		$data['head'] 		= 'Ubah Registrasi Diklat Fungsional';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['pengelola'] 	= $this->data->get_pengelola();
		$data['group'] 		= $this->data->get_group();
		
		$this->load->view('template/default', $data);
	}

	public function deleted($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Registrasi Diklat");
		$this->session->set_flashdata('flashconfirm','Permintaan Registrasi Diklat Di Batalkan');
		redirect('daftar');
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
			$col[] = $row->nip;
			$col[] = $row->fullname;
			$col[] = $row->email;
			$col[] = $row->pengelola ? $row->pengelola : 'Semua';
			$col[] = level($row->level);
			$col[] = $row->active ? '<a type="button" class="btn btn-xs btn-flat btn-success"><i class="fa fa-check-circle"></i> </a>' : '<a type="button" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-circle-o"></i> </a>';
			$col[] = $row->verify ? '<button type="button" class="btn btn-xs btn-flat btn-success"><i class="fa fa-check-circle"></i> </button>' : '<button type="button" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-circle-o"></i> </button>';
            
            //add html for action
            
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
				'user_id' => $this->session->userdata('userID'),
				'kategori_id' => 2,
				'jenis_id' => $this->input->post('jenis_id'),
				'jenjang_id' => $this->input->post('jenjang_id'),
				'diklat_id' => $this->input->post('diklat_id'),
				'periode' => $this->input->post('periode'),
				'penyelenggara' => $this->input->post('penyelenggara'),
				'syarat' => 1,
				'kode' => $this->data->get_kode(),
				'pengelola_id' => pengelola($this->session->userdata('userID'))
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Registrasi Diklat Fungsional");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
                'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'telpon' => $this->input->post('telpon'),
				'pengelola_id' => $this->input->post('pengelola'),
				'level' => $this->input->post('level'),
				'active' => $this->input->post('active')
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Registrasi Diklat Fungsional");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Registrasi Diklat Fungsional");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Registrasi Diklat Fungsional");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        $data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("jenis_id", "Jenis Jabatan", "trim|required");
		$this->form_validation->set_rules("jenjang_id", "Jenjang Jabatan", "trim|required");
		$this->form_validation->set_rules("diklat_id", "Jenis Diklat", "trim|required");
		$this->form_validation->set_rules("periode", "Periode Diklat", "trim|required");
		$this->form_validation->set_rules("penyelenggara", "Penyelenggara Jabatan", "trim|required");
		
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
	
	public function get_jenjang(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $jenis = $this->input->post('jenis_id');
		$jenjang = $this->data->get_jenjang($jenis);
        if(!empty($jenjang)){
           $selected = set_value('jenjang_id', $record ? $record->jenjang_id : '');
            echo form_dropdown('jenjang_id', $jenjang, $selected, "class='form-control select2' name='jenjang_id' id='jenjang_id'");
        }else{
            echo form_dropdown('jenjang_id', array(''=>'Pilih Jenjang Jabatan'), '', "class='form-control select2' name='jenjang_id' id='jenjang_id'");
        }
	}
	
	public function get_diklat(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
		$jenis = $this->input->post('jenis_id');
		$jenjang = $this->input->post('jenjang_id');
		$diklat = $this->data->get_diklat($jenis, $jenjang);
        if(!empty($diklat)){
           $selected = set_value('diklat_id', $record ? $record->diklat_id : '');
            echo form_dropdown('diklat_id', $diklat, $selected, "class='form-control select2' name='diklat_id' id='diklat_id'");
        }else{
            echo form_dropdown('diklat_id', array(''=>'Pilih Diklat Jabatan'), '', "class='form-control select2' name='diklat_id' id='diklat_id'");
        }
	}
	
	public function get_syarat(){
		$diklat = $this->input->post('diklat_id');
		$syarat = $this->data->get_syarat($diklat);
        if($syarat){
				echo '<label>Pemenuhan Syarat</label>';
				foreach($syarat as $row){
					echo '<div class="checkbox">';
					echo '<label>';
					echo '<input type="checkbox" name="syarat[]" id="syarat">';
					echo $row->syarat;
					echo '</label>';
					echo '</div>';
				}
        }else{
				echo 'Belum Ada Persyaratan Tersedia';
		}
	}
}
