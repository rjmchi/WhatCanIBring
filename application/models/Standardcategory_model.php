<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class StandardCategory_model extends CI_Model{
		
	function __construct()
	{
		parent::__construct();
	}

	function getAll()
	{
		$q =  $this->db
			->get('standard-types');
		if ($q->num_rows > 0)
		{
			print_r($q->result());
			return $q->result();
		}
		return false;
	}
}