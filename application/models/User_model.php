<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
		
	function __construct()
	{
		parent::__construct();
//		$this->initiate();
	}
	function create_user($username, $email, $password, $firstname, $lastname)
	{
		$data = array(
			'username' => $username,
			'email' => $email,
			'password' => sha1($password),
			'first_name' => $firstname,
			'last_name' => $lastname
		);
		$this->db->insert('user', $data);
	}
	
	public function verify_user($username, $password)
	{
		$q = $this->db
			->where('username', $username)
			->where('password', sha1($password))
			->limit(1)
			->get('user');
					
		if ($q->num_rows > 0) {
			return $q->row();
		}
		return false;
	}
	
	public function user_name_exists($user_name)
	{
		$exists = false;
		$q = $this->db 
			->where('username', $user_name)
			->get('user');
		if ($q->num_rows > 0)
		{
			$exists = true;
		}
		return $exists;
	}
	public function get_user($username)
	{
		$q = $this->db
			->select('username, email, first_name, last_name')
			->where('username', $username)
			->limit(1)
			->get('user');
					
		if ($q->num_rows > 0) 
		{
			return $q->row();
		}
		return false;
	}
	
	public function update_profile($username, $firstname, $lastname, $email, $password)
	{
		$profile = $this->get_user($username);
		$data = array();
		if ($firstname && ($firstname !== $profile->first_name))
		{
			$data['first_name'] = $firstname;
		}
		if ($lastname && ($lastname !== $profile->last_name))
		{
			$data['last_name'] = $lastname;
		}
		if ($email && ($email !== $profile->email))
		{
			$data['email'] = $email;
		}
		if ($password)
		{
			$data['password'] = sha1($password);
		}
		$this->db->where('username', $username)
			->update('user', $data);
	}
	private function initiate() {
		$this->load->dbforge();	
		$fields = array(
        'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
        ),
        'email' => array(
                'type' =>'VARCHAR',
                'constraint' => '255'
        ),
        'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
        ),
        'first_name' => array(
                'type' =>'VARCHAR',
                'constraint' => '255'
        ),
        'last_name' => array(
                'type' =>'VARCHAR',
                'constraint' => '255'
        ),
		);		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);		
		$this->dbforge->create_table('user');
	}
}
