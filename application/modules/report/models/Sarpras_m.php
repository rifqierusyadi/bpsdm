<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sarpras_m extends MY_Model
{
	public $table = 'sarana'; // you MUST mention the table name
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
	
	public function get_new()
    {
        $record = new stdClass();
        $record->id = '';
        $record->kategori_id = '';
        $record->tahun = '';
		return $record;
    }
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    //urusan lawan ambil data
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->where('deleted_at', NULL);
        $this->db->where('users_id',$this->session->userdata('userID'));  
        $this->db->group_by('kategori_id');
        $this->db->group_by('tahun');
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_id($id=null)
    {
        $this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function get_list($kategori=null, $tahun=null, $id=null)
    {
        $this->db->where('kategori_id', $kategori);
        $this->db->where('tahun', $tahun);
        $this->db->where('users_id', $id);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function get_list_edit($id=null)
    {
        $row = $this->get_id($id);
        //var_dump($row->users_id);
        $this->db->where('kategori_id', $row->kategori_id);
        $this->db->where('tahun',$row->tahun);
        $this->db->where('users_id', $row->users_id);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function deleted($id=null)
    {
        $row = $this->get_id($id);
        //var_dump($row->users_id);
        $this->db->where('kategori_id', $row->kategori_id);
        $this->db->where('tahun',$row->tahun);
        $this->db->where('users_id', $row->users_id);
        return $this->db->delete($this->table);
        
    }

    public function get_jenis($kategori=null)
    {
        $this->db->where('kategori_id', $kategori);
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get('jenis');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function get_tahun()
	{
		$dropdown[''] = 'Pilih Salah Satu Tahun';
		$awal = date('Y')+1;
		$akhir = date('Y')+3;
		for ($i=$awal ; $i <= $akhir; $i++)
		{
			$dropdown[$i] = $i;
		}
		return $dropdown;
	}
}