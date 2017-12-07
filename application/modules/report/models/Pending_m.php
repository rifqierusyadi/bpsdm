<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pending_m extends MY_Model
{
	public $table = 'diklat'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array(''); //set kolom field database pada datatable secara berurutan
    public $column_search = array(''); //set kolom field database pada datatable untuk pencarian
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

    public function get_filter_pending($pengelola = null, $kategori=null, $periode=null)
    {
        $this->db->select('a.*, b.nip, b.nama, b.instansi, b.unker, b.satker, c.email, c.active, c.verify, c.pengelola_id');
		$this->db->from('diklat a');
        $this->db->join('identitas b','a.user_id = b.user_id','LEFT');
        $this->db->join('users c','a.user_id = c.id','LEFT');
        $this->db->where('a.deleted_at', NULL);
        $this->db->where('a.status', 0);
        if($pengelola){
            $this->db->where('c.pengelola_id', $pengelola);
        }
        
        if($kategori){
            $this->db->where('a.kategori_id', $kategori);
        }

        if($periode){
            $this->db->where('a.periode', $periode);
        }

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
    
    public function get_tahun()
	{
		$dropdown[''] = 'Pilih Periode';
		$awal = date('Y')+1;
		$akhir = date('Y')+3;
		
		for ($i=$awal ; $i <= $akhir; $i++)
		{
			$dropdown[$i] = $i;
		}
		
		return $dropdown;
	}
}