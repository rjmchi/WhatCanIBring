<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
	}
	public function send_mail()
	{
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('robert@rjmchicago.com', 'Robert Milanowski');
		$this->email->to('robert@chicagopotters.com', 'Robert');
		$this->email->subject('Message from WhatCanIBring');
		$this->email->message("This is the test message");
		if ($this->email->send())
		{
			$data['message'] = "<h2>Thank You</h2><p>Your Message Has been Sent</p>";
		}		
		else
		{
			$data['message'] = "<h2>I'm sorry.  There was a problem sending your message.</h2><p>Your message has not been sent</p>";
		}
		echo $data['message'];
	}
}
