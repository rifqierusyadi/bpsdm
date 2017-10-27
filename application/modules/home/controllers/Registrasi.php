<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'home/registrasi/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('registrasi_m', 'data');
		//signin();
	}
	
	public function index()
	{
		$data['head'] 		= 'Registrasi Pengguna Aplikasi';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['pengelola'] 	= $this->data->get_pengelola();
		$data['group'] 		= $this->data->get_group();
		
		$this->load->view('frontpage/default', $data);
	}

	public function register()
	{
		if($this->validation()){
			$api = $this->data->get_api($this->input->post('pengelola'));
			if($api){
				$url = $api->api.'?nip='.$this->input->post('nip');
				$data = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false)))); 
				$json = count(json_decode($data));
				if($json > 0){
					$verify = 1;
				}else{
					$verify = 0;
				}
			}else{
				$verify = 0;
			}
			
			$data = array(
				'nip' => $this->input->post('nip'),
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'telpon' => $this->input->post('telpon'),
				'pengelola_id' => $this->input->post('pengelola'),
				'level' => 4,
				'active' => 1,
				'verify' => $verify
			);
			$input = $this->data->insert($data);
			helper_log("add", "Menambah Pengaturan Pengguna");
			if($input){
				$this->session->set_flashdata('flashconfirm','Data Registrasi Berhasil!');
				redirect('home/registrasi');
			}else{
				$this->session->set_flashdata('flasherror','Data Registrasi Gagal, Harap Coba Kembali.');
				redirect('home/registrasi');
			}
		}else{
			$this->index();
		}
	}

	private function validation()
    {
        $this->form_validation->set_rules("nip", "NIP", "trim|required|is_unique[users.nip]|min_length[18]");
		$this->form_validation->set_rules("fullname", "Nama Lengkap", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]|max_length[18]");
		$this->form_validation->set_rules("repassword", "Ulangi Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("fullname", "Nama Lengkap", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("telpon", "Telpon", "trim|is_natural|required");
		$this->form_validation->set_rules("pengelola", "Wilayah Pengelola Kepegawaian", "trim|required");
		//$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        return $this->form_validation->run();
    }
}
