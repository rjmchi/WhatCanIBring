<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MyEvents extends CI_Controller {

	function __construct()
	{		
		parent::__construct();	
		if (!isset($_SESSION['username']))
		{
			redirect('welcome');
		}
		
		$this->m_data['username'] = $_SESSION['username'];
		$this->m_data['message'] = '';

		$this->load->model('event_model');
	}
	
	function index()
	{
		$this->m_data['events'] = $this->event_model->get_events($this->m_data['username']);
		$this->m_data['content'] = 'my_events_view';
		$this->load->view('layout/master', $this->m_data);
	}
	
	function create()
	{
		$this->m_data['events'] = $this->event_model->get_events($this->m_data['username']);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('event_name', 'Event Name', 'required');
		if ($this->form_validation->run() == false)
		{
		$this->m_data['content'] = 'my_events_view';
		$this->load->view('layout/master', $this->m_data);
		}
		else
		{
			$this->load->model('user_model');
			$user = $this->user_model->get_user($this->m_data['username']);
			
			$this->event_model->create_event($this->m_data['username'], $this->input->post('event_name'), $this->input->post('message'), $user, $this->input->post('location'),$this->input->post('date'),$this->input->post('time'));
		}
		redirect('/myevents/');
	}
	
	function manage()
	{
		$event = $this->uri->segment(3);
		$this->m_data['event'] = $this->event_model->get_event($event, $this->m_data['username']);
		$this->m_data['guests'] = $this->event_model->get_guests($this->m_data['event']->id);
		$this->m_data['types'] = $this->event_model->get_types($this->m_data['event']->id);
		$this->m_data['content'] = 'manage_events_view';
		$this->load->view('layout/master', $this->m_data);
	}
	
	function invite()
	{
		$eventname = $this->uri->segment(3);
		$event = $this->event_model->get_event($eventname, $this->m_data['username']);
		$this->event_model->add_guest($this->m_data['username'], 
			$event->id, 
			$this->input->post('first_name'),
			$this->input->post('last_name'),
			$this->input->post('email')
		);
		redirect('/myevents/manage/' . $eventname);
	}
	
	function types()
	{
		$eventname = $this->event_model->get_event_name($this->input->post('eventid'));
		$types = $this->event_model->get_types($this->input->post('eventid'));
		
		$sort = 10;
		
		foreach($types as $type)
		{
			$active = 0;
				if ($this->input->post($type->id) === 'x')
				{
					$active = 1;
				}
				$this->event_model->set_type_active($this->input->post('eventid'), $type->id, $active);
		}
		if ($this->input->post('newtype'))
		{
			$this->event_model->add_type($this->input->post('newtype'), $this->input->post('eventid'), $sort);
		}
		redirect('/myevents/manage/' . $eventname);
	}
	
	function signup()
	{
		$event = $this->uri->segment(3);
		$this->m_data['event'] = $this->event_model->get_event($event, $this->m_data['username']);
		$this->m_data['guests'] = $this->event_model->get_guests($this->m_data['event']->id);
		$this->m_data['types'] = $this->event_model->get_types($this->m_data['event']->id);
		$this->m_data['content'] = 'signup_view';
		$this->load->view('layout/master', $this->m_data);
	}
}