<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class signup extends CI_Controller {

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
	}
	
	function update()
	{
		echo 'guestid ';
		echo $this->input->post('guestid');
		echo ' rownum ';
		echo $this->input->post('rownum');
		echo ' item ';
		echo $this->input->post('items');
		echo ' dish ';
		echo $this->input->post('dish');
	}
}