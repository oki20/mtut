<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Listdoc_model extends CI_Model
{
	public function query_read($table,$where)
	{
		//$this->db->get($table);
		//$this->db->where($where);
		return $this->db->get_where($table,$where);
	}
}


	// public function update_data($where,$data,$table)
	// {
	// 	$this->db->where($where);
	// 	$this->db->update($table,$data);
	// }
