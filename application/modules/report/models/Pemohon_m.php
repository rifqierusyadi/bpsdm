<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon_m extends MY_Model
{
	public $table = 'jenis'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array('id','tahun'); //set kolom field database pada datatable secara berurutan
    public $column_search = array('tahun'); //set kolom field database pada datatable untuk pencarian
    public $order = array('id' => 'asc'); //order baku 
	
	public function __construct()
	{
		$this->timestamps = TRUE;
		$this->soft_deletes = TRUE;
		parent::__construct();
	}
	

    public function get_pemohon()
    {
        $this->db->select('a.*, b.nip, b.nama, b.instansi, b.unker, b.satker, c.email, c.active, c.verify, c.pengelola_id');
		$this->db->from('diklat a');
        $this->db->join('identitas b','a.user_id = b.user_id','LEFT');
        $this->db->join('users c','a.user_id = c.id','LEFT');
        $this->db->where('a.deleted_at', NULL);
        $this->db->where('a.status', 1);
        $this->db->order_by('a.periode','ASC');
        $this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function get_pending()
    {
        $this->db->select('a.*, b.nip, b.nama, b.instansi, b.unker, b.satker, c.email, c.active, c.verify, c.pengelola_id');
		$this->db->from('diklat a');
        $this->db->join('identitas b','a.user_id = b.user_id','LEFT');
        $this->db->join('users c','a.user_id = c.id','LEFT');
        $this->db->where('a.deleted_at', NULL);
        $this->db->where('a.status', 0);
        $this->db->order_by('a.periode','ASC');
        $this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
}