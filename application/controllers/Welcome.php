<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->m_data['junk'] = 'junk';
//		session_start();
		if (isset($_SESSION['username']))
		{
			$this->m_data['username'] = $_SESSION['username'];
		}
	}
	
	function index()
	{
		if (isset($_SESSION['username']))
		{
			redirect('/myevents');
		}
		$this->m_data['content'] = "welcome_message";
		$this->load->view('layout/master', $this->m_data);
	}
}
