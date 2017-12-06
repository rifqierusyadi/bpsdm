<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penunjang_m extends MY_Model
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
	

    public function get_sekolah()
    {
        $this->db->select('a.ruang, a.tuna_id, b.*');
        $this->db->from('jenis b');
        $this->db->join('ruang a','a.id = b.ruang_id','LEFT');
        $this->db->where('b.deleted_at', NULL);
        $this->db->where('b.kategori_id', 3);
        $this->db->order_by('b.id','ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
}