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
		$this->load->helper('captcha');
		$config_captcha = array(
			'img_path'  => './captcha/',
			'img_url'  => base_url('captcha/'),
			'img_width'  => '130',
			'img_height' => 30,
			'word_length' => 4,
			'font_size'   => 30,
			'border' => 1,
			'expiration' => 7200,
			'pool'=> '0123456789',
			'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(210, 214, 222),
                'text' => array(0, 0, 0),
                'grid' => array(255, 190, 190)
        	)
		);
		  
		// create captcha image
		$cap = create_captcha($config_captcha);
		// store image html code in a variable
		$data['img'] = $cap['image'];
		// store the captcha word in a session
		$this->session->set_userdata('mycaptcha', $cap['word']);

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
		$secutity_code = $this->input->post('security_code');
		$mycaptcha = $this->session->userdata('mycaptcha');

		if($this->validation()){
			$this->upload_file();
			if($_FILES['file']['name'])
			{
				if ($secutity_code == $mycaptcha) {
					if ($this->upload->do_upload('file')){
						$api = $this->data->get_api($this->input->post('pengelola'));
						$dokumen = $this->upload->data();
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
						
						$x = array(
							'nip' => $this->input->post('nip'),
							'fullname' => $this->input->post('fullname'),
							'email' => $this->input->post('email'),
							'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telpon' => $this->input->post('telpon'),
							'pengelola_id' => $this->input->post('pengelola'),
							'level' => 4,
							'active' => 1,
							'verify' => $verify,
							'dokumen' => $dokumen['file_name'],
						);
			
						$insert = $this->data->insert($x);
						if($insert){
							$y = array(
								'nip' => $this->input->post('nip'),
								'nama' => $this->input->post('fullname'),
								'telpon' => $this->input->post('telpon'),
								'pengelola_id' => $this->input->post('pengelola'),
								'user_id' => $insert
							);
							$this->db->insert('identitas', $y);	
						}
						helper_log("add", "Menambah Pengaturan Pengguna");
						if($insert){
							$this->session->set_flashdata('flashconfirm','Data Registrasi Berhasil!');
							$this->send_mail($x['fullname'], $x['nip'], $x['email'], $this->input->post('password'));
							redirect('home/registrasi');
						}else{
							$this->session->set_flashdata('flasherror','Data Registrasi Gagal, Harap Coba Kembali.');
							redirect('home/registrasi');
						}
					}else{
						$this->session->set_flashdata('flasherror','Kode Verifikasi Anda Salah :(');
						$this->index();
					}
				}
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
		$this->form_validation->set_rules("security_code", "Kode Verifikasi", "trim|required");
		//$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        return $this->form_validation->run();
	}
	
	private function send_mail($nama=null, $nip=null,  $email=null, $password=null)
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
		$htmlContent = '<h3>Data Registrasi SIDA KALIBRASI BPSDM Provinsi Kalimantan Selatan</h3>';
		$htmlContent .= '<p>Anda telah mendaftarkan diri anda atas nama '.$nama.' dengan nip '.$nip.' pada SIDA KALIBRASI dengan password anda : '.$password.'</p>';
		$htmlContent .= '<p>Silahkan Login dan Isikan Profil Diri Anda Secara Lengkap dan Benar Pada SIDA Kalibrasi http://sida.kalselprov.go.id Hal Ini Akan Membantu Proses Verifikasi Data. Jika anda belum dapat melakukan akses pada halaman login http://sida.kalselprov.go.id kemungkinan akun anda belum dapat diverifikasi atau diaktifkan oleh administrator.</p>';

		$this->email->to($email);
		$this->email->from('rifqie.rusyadi@gmail.com','SIDA KALIBRASI');
		$this->email->subject('Data Registrasi SIDA KALIBRASI KALSEL');
		$this->email->message($htmlContent);
		//Send email
		$this->email->send();
	}

	private function upload_file(){
		$this->load->library('upload');
        $nmfile = "lapkin_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './document/'; //path folder
        $config['allowed_types'] = 'pdf|jpg|png'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        $config['max_width']  = '3000'; //lebar maksimum 1288 px
        $config['max_height']  = '3000'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);
	}
}
