<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authentication extends CI_Controller {

	function __construct()
	{
//		session_start();
		parent::__construct();	
	}
	function index()
	{
//		$this->load->view('members_page');
		echo "here";
	}
	
	function login()
	{
		$this->load->helper('cookie');
		
		$data = '';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
		if ($this->form_validation->run() !== false)
		{
			$this->load->model('user_model');
			$row = $this->user_model->verify_user($this->input->post('user_name'), $this->input->post('password'));
			if ($row !== false)
			{
				if ($this->input->post('remember') == 'remember')
				{
					set_cookie('username', $this->input->post('user_name'));
				}
				$_SESSION['username'] = $this->input->post('user_name');
				redirect('/myevents/');
			}
			else
			{
				$data['error'] = 'Invalid Login';
			}
		}
		else
		{
		}
		$data['content'] = 'welcome_message';
		$this->load->view('layout/master', $data);
	}
	
	function signup()
	{
		$data = '';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('user_name', 'User Name', 'required|max_length[16]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		if ($this->form_validation->run() !== false)
		{
			if ($this->input->post('password') !== $this->input->post('confirmpassword'))
			{
				$data['error'] = 'passwords do not match';
			}
			else
			{
				$this->load->model('user_model');
				if ($this->user_model->user_name_exists($this->input->post('user_name')))
				{
					$data['error'] = 'user name already exists';
				}
				else
				{
					$row = $this->user_model->create_user($this->input->post('user_name'),$this->input->post('email_address'), $this->input->post('password'), $this->input->post('first_name'), $this->input->post('last_name'));
					if ($row !== false)
					{
						$_SESSION['username'] = $this->input->post('user_name');
						redirect('/MyEvents/');
					}
					else
					{
						$data['error'] = 'Invalid Login';
					}
				}
			}
		}
		else
		{
		}	
		$data['content'] = 'welcome_message';
		$this->load->view('layout/master', $data);
	}
	
	function logout()
	{
		session_destroy();
		redirect('/welcome');
	}
	
	function my_profile()
	{
		if ($this->uri->segment(3))
		{
			$data['message'] = "Profile Updated";
		}
		if (! isset($_SESSION['username']))
		{
			die ('no user');
		}
		$data['username'] = $_SESSION['username'];
		$this->load->model('user_model');
		$data['profile'] = $this->user_model->get_user($data['username']);
		$data['content'] = 'my_profile_view';
		$this->load->view('layout/master', $data);
	}
	
	function update_profile()
	{
		$data['username'] = $_SESSION['username'];
		$this->load->model('user_model');
		$this->user_model->update_profile(
			$data['username'],
			$this->input->post('first_name'),
			$this->input->post('last_name'),
			$this->input->post('email'),
			$this->input->post('password')			
		);
		redirect('/authentication/my_profile/update');
	}
	
	function forgot_password()
	{
		$data['content'] = 'forgot_password_view';
		$this->load->view('master/layout', $data);
	}
	function email_password()
	{
		$data['message'] = '';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
		if ($this->form_validation->run() !== false)
		{
			$data['message'] = "Your new password has been sent";
		}
		else
		{
		}
		$data['content'] = 'forgot_password_view';
		$this->load->view('master/layout', $data);
	}
}

