<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'data/registrasi/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('help_helper');
		$this->load->model('registrasi_m', 'data');
		signin();
		group(array('1','2','3'));
	}
	
	//halaman index
	public function index()
	{
		ini_set('memory_limit', '-1');
		$data['head'] 		= 'Daftar Registrasi';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}

	public function get_profile()
	{
		$nip = $this->input->post('nip');
		$data['record']		= $this->data->get_data($nip);
		$data['verify']		= $this->data->get_verify($nip);

		$this->load->view('registrasi/modal', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Daftar Registrasi';
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
		$data['head'] 		= 'Ubah Daftar Registrasi';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['pengelola'] 	= $this->data->get_pengelola();
		$data['group'] 		= $this->data->get_group();
		
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
			$col[] = '<a href="" data-toggle="modal" data-target="#view-modal" data-id="'.$row->nip.'" id="getUser">'.$row->nip.'</a>';
			$col[] = $row->fullname;
			$col[] = $row->email;
			$col[] = $row->pengelola ? $row->pengelola : 'Semua';
			$col[] = level($row->level);
			$col[] = $row->active ? '<a type="button" class="btn btn-xs btn-flat btn-success"><i class="fa fa-check-circle"></i> </a>' : '<a type="button" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-circle-o"></i> </a>';
			$col[] = $row->verify ? '<button type="button" class="btn btn-xs btn-flat btn-success"><i class="fa fa-check-circle"></i> </button>' : '<button type="button" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-circle-o"></i> </button>';
			$col[] = $row->dokumen ? '<a href="'.base_url('document/'.$row->dokumen).'" class="btn btn-xs btn-flat btn-info" target="_blank"><i class="fa fa-file-text"></i> </a>' : '<a href="" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-file-text"></i> </a>';
            
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
                'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'telpon' => $this->input->post('telpon'),
				'pengelola_id' => $this->input->post('pengelola'),
				'level' => $this->input->post('level'),
				'active' => $this->input->post('active')
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Daftar Registrasi");
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
			helper_log("edit", "Merubah Daftar Registrasi");
        }
	}
	
	public function verify($id)
    {
			$find = $this->db->get_where('users', array('id'=>$id))->row();
			$verify = $find->verify == 1 ? '0' : '1';
			$data = array(
				'verify' => $verify
			);
			
			//$this->db->update('users', $data, array('id'=>$id));
			$update = $this->db->update('users', $data, array('id'=>$id));
			if($update){
				$this->send_mail($nama=$find->fullname, $nip=$find->nip,  $email=$find->email, $status=$verify);
			}
			helper_log("edit", "Merubah Daftar Pemohon Diklat");
			//echo json_encode(array("status" => TRUE));
			redirect('data/registrasi');
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Daftar Registrasi");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Daftar Registrasi");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        $data = array('success' => false, 'messages' => array());
        
		if(!isset($id)){
			$this->form_validation->set_rules("fullname", "Nama Lengkap", "trim|required");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]|max_length[18]");
			$this->form_validation->set_rules("repassword", "Ulangi Password", "trim|required|matches[password]");
		}else{
			//$this->form_validation->set_rules("registrasiname", "Username", "trim|required");
		}
        
		$this->form_validation->set_rules("fullname", "Nama Lengkap", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("telpon", "Telpon", "trim|is_natural");
		$this->form_validation->set_rules("unker", "Unit Kerja", "trim");
		$this->form_validation->set_rules("level", "Tingkat Pengguna", "trim|required");
		$this->form_validation->set_rules("active", "Status Pengguna", "trim|required");
		
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
	
	private function send_mail($nama=null, $nip=null,  $email=null, $status=null)
	{
		//Load email library
		$this->load->library('email');
		$this->load->library('encrypt');

		//SMTP & mail configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'rifqie@gmail.com',
			'smtp_pass' => 'Handaktahuaj4',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		if($status){
			$htmlContent = '<h3>Data Registrasi SIDA KALIBRASI BPSDM Provinsi Kalimantan Selatan</h3>';
			$htmlContent .= '<p>Anda telah mendaftarkan diri anda atas nama '.$nama.' dengan nip '.$nip.' pada SIDA KALIBRASI</p>';
			$htmlContent .= '<p>Saat ini akun anda telah di verifikasi. Silahkan anda login pada halaman berikut ini http://sida.kalselprov.go.id.</p>';
		}else{
			$htmlContent = '<h3>Data Registrasi SIDA KALIBRASI BPSDM Provinsi Kalimantan Selatan</h3>';
			$htmlContent .= '<p>Anda telah mendaftarkan diri anda atas nama '.$nama.' dengan nip '.$nip.' pada SIDA KALIBRASI</p>';
			$htmlContent .= '<p>Saat ini akun anda telah ditolak verifikasinya. Silahkan anda hubungi administrator pada halaman berikut ini http://sida.kalselprov.go.id.</p>';
		}
		$this->email->to($email);
		$this->email->from('rifqie.rusyadi@gmail.com','SIDA KALIBRASI');
		$this->email->subject('Data Registrasi SIDA KALIBRASI KALSEL');
		$this->email->message($htmlContent);
		//Send email
		$this->email->send();
	}
}
