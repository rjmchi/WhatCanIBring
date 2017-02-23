<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_model extends CI_Model{
		
	function __construct()
	{
		parent::__construct();
		$this->initiate();
	}
	function get_events($username)
	{
		$q = $this->db
			->where('username', $username)
			->get('events');
					
		if ($q->num_rows > 0) {
			return $q->result();
		}
		return false;
	}
	
	function create_event($username, $eventname, $message, $user, $location, $date, $time)
	{
		$datetime = $date . ' ' . $time;
		$data = array(
			'username' => $username,
			'name' => $eventname,
			'location' => $location,
			'datetime' => $datetime,
			'message' => $message
		);
		$this->db->insert('events', $data);
		$eventid = $this->db->insert_id();		
		$this->add_guest($username, $eventid, $user->first_name, $user->last_name, $user->email, true);
		
		$q = $this->db->get('standard-types');
		if ($q->num_rows > 0)
		{
			$types = $q->result();
			foreach ($types as $type)
			{
				$this->add_type($type->name, $eventid, $type->id);
			}
		}
	}
	
	function get_event($name, $username)
	{
		$q =  $this->db
			->where('username', $username)
			->where('name', $name)
			->get('events');
		if ($q->num_rows > 0)
		{
			$row = $q->result();
			return ($row[0]);
		}
	}
	function get_event_name($eventid)
	{
		$q = $this->db
			->select('name')
			->where('id', $eventid)
			->get('events');
			
		$r = $q->result();
		return $r[0]->name;
	}
	
	function get_guests($eventid)
	{
		$q =  $this->db
			->where('eventid', $eventid)
			->get('guests');
		if ($q->num_rows > 0)
		{
			return $q->result();
		}
		return false;
	}
	
	function add_guest($username, $eventid, $firstname, $lastname, $email, $host=false)
	{
		$guest_data['first_name'] = $firstname;
		$guest_data['last_name'] = $lastname;
		$guest_data['email'] = $email;
		$guest_data['eventid'] = $eventid;
		if ($host)
		{
			$guest_data['host'] = true;
		}
		
		$this->db->insert('guests', $guest_data);	
	}
	function add_type($name, $eventid, $sort)
	{
		$data = array(
			'typename' => $name,
			'sort_order' => $sort, 
			'eventid' => $eventid
		);
		$this->db->insert('type', $data);
	}
	
	function get_types($eventid)
	{
		$q =  $this->db
			->where('eventid', $eventid)
			->order_by('sort_order', 'asc')
			->get('type');
		if ($q->num_rows > 0)
		{
			return $q->result();
		}
		return false;
	}
	function set_type_active($eventid, $typeid, $active=false)
	{
		$data = array(
			'active'=> $active
		);
		
		$q = $this->db->where('eventid', $eventid)
			->where('id', $typeid)
			->update('type', $data);
	}
	function get_menu_items($eventid)
	{
		$q = $this->db
			->where('eventid', $eventid)
			->get('menu');
		if ($q->num_rows > 0)
		{
			return $q->result();
		}
		return false;
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
		$this->dbforge->create_table('events');
	}		
}

