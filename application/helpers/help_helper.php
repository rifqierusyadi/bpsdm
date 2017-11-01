<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//data pribadi
if (! function_exists('identitas'))
{
	function identitas($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('user_id', $id);
		$query = $CI->db->get('identitas');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

if (! function_exists('biodata'))
{
	function biodata($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('user_id', $id);
		$query = $CI->db->get('identitas');
        if($query->num_rows() > 0){
			return $query->row_array();
		}else{
            return FALSE;
        }
	}
}

//cari agama
if (! function_exists('agama'))
{
	function agama($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_agama');
        if($query->num_rows() > 0){
			return $query->row()->agama;
		}else{
            return '-';
        }
	}
}

//cari golongan
if (! function_exists('gol'))
{
	function gol($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_pangkat');
        if($query->num_rows() > 0){
			return $query->row()->golongan;
		}else{
            return '-';
        }
	}
}

//cari pangkat
if (! function_exists('pkt'))
{
	function pkt($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_pangkat');
        if($query->num_rows() > 0){
			return $query->row()->pangkat;
		}else{
            return '-';
        }
	}
}

//cari pangkat
if (! function_exists('eselon'))
{
	function eselon($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_eselon');
        if($query->num_rows() > 0){
			return $query->row()->jabatan;
		}else{
            return '-';
        }
	}
}

//cari ktpu
if (! function_exists('ktpu'))
{
	function ktpu($ktpu=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $ktpu);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_ktpu');
        if($query->num_rows() > 0){
			return $query->row()->ktpu;
		}else{
            return '-';
        }
	}
}

if (! function_exists('sex'))
{
	function sex($id=null)
	{
		if($id == 1){
			$kode = 'LAKI-LAKI';
		}elseif($id == 2){
			$kode = 'PEREMPUAN';
		}else{
			$kode = '-';
		}
		return $kode;
	}
}


//pengelola
if (! function_exists('pengelola'))
{
	function pengelola($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('users');
        if($query->num_rows() > 0){
			return $query->row()->pengelola_id;
		}else{
            return FALSE;
        }
	}
}

if (! function_exists('struktural'))
{
	function struktural($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('user_id', $id);
		$CI->db->where('kategori_id', 1);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('diklat');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

if (! function_exists('jenis'))
{
	function jenis($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_jenis');
        if($query->num_rows() > 0){
			return $query->row()->jenis;
		}else{
            return FALSE;
        }
	}
}

if (! function_exists('jenjang'))
{
	function jenjang($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_jenjang');
        if($query->num_rows() > 0){
			return $query->row()->jenjang;
		}else{
            return FALSE;
        }
	}
}

if (! function_exists('diklat'))
{
	function diklat($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_diklat');
        if($query->num_rows() > 0){
			return $query->row()->diklat;
		}else{
            return FALSE;
        }
	}
}