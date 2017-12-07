<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_m extends MY_Model
{
	public $table = 'users'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array(); //set kolom field database pada datatable secara berurutan
    public $column_search = array(); //set kolom field database pada datatable untuk pencarian
    public $order = array('id' => 'asc'); //order baku 
	
	public function __construct()
	{
		$this->timestamps = TRUE;
		$this->soft_deletes = TRUE;
		parent::__construct();
	}
	

    public function get_registrasi()
    {
        $this->db->select('a.*, b.pengelola, c.tmlahir, c.tglahir, c.sex, c.agama_id, c.alamat, c.instansi, c.unker, c.satker, c.jabatan, c.jenis_id, c.eselon_id, c.pangkat_id, c.ktpu_id, c.jurusan, c.tahun');
		$this->db->from('users a');
        $this->db->join('ref_pengelola b','a.pengelola_id = b.kode','LEFT');
        $this->db->join('identitas c','a.id = c.user_id','LEFT');
        $this->db->where('a.deleted_at', NULL);
        $this->db->where('a.level', 4);
        $this->db->order_by('a.pengelola_id','ASC');
        $this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function get_filter($pengelola=null, $eselon=null, $pangkat=null, $pendidikan=null)
    {
        $this->db->select('a.*, b.pengelola, c.tmlahir, c.tglahir, c.sex, c.agama_id, c.alamat, c.instansi, c.unker, c.satker, c.jabatan, c.jenis_id, c.eselon_id, c.pangkat_id, c.ktpu_id, c.jurusan, c.tahun');
		$this->db->from('users a');
        $this->db->join('ref_pengelola b','a.pengelola_id = b.kode','LEFT');
        $this->db->join('identitas c','a.id = c.user_id','LEFT');
        $this->db->where('a.deleted_at', NULL);
        $this->db->where('a.level', 4);
        if($pengelola){
            $this->db->where('a.pengelola_id', $pengelola);
        }

        if($eselon){
            $this->db->where('c.eselon_id', $eselon);
        }

        if($pangkat){
            $this->db->where('c.pangkat_id', $pangkat);
        }

        if($pendidikan){
            $this->db->where('c.ktpu_id', $pendidikan);
        }

        $this->db->order_by('a.pengelola_id','ASC');
        $this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function get_pengelola()
	{
        $this->db->where('deleted_at',NULL);
        $query = $this->db->order_by('kode', 'ASC')->get('ref_pengelola');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Filter Pengelola Kepegawaian';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->kode.' - '.$row->pengelola;
		}
        }else{
            $dropdown[''] = 'Belum Ada Pengelola/Urusan Tersedia';
        }
		return $dropdown;
    }
    
    public function get_pangkat()
	{
        $this->db->where('deleted_at',NULL);
        $query = $this->db->order_by('kode', 'ASC')->get('ref_pangkat');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Filter Golongan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->golongan;
		}
        }else{
            $dropdown[''] = 'Belum Ada Tingkat Golongan Tersedia';
        }
		return $dropdown;
    }
    
    public function get_eselon()
	{
        $this->db->where('deleted_at',NULL);
        $query = $this->db->order_by('kode', 'ASC')->get('ref_eselon');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Filter Tingkat Jabatan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->eselon.' - '.$row->jabatan;
		}
        }else{
            $dropdown[''] = 'Belum Ada Tingkat Jabatan Tersedia';
        }
		return $dropdown;
    }
    
    public function get_ktpu()
	{
        $this->db->where('deleted_at',NULL);
        $query = $this->db->order_by('kode', 'ASC')->get('ref_ktpu');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Filter Tingkat Pendidikan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->ktpu;
		}
        }else{
            $dropdown[''] = 'Belum Ada Tingkat Pendidikan Tersedia';
        }
		return $dropdown;
	}
}