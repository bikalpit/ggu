<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {	

public function _construct()
{
    parent::__construct();
    $this->load->helper("url");
}	
	public function index()
	{
		$this->load->view('dashboard');
	}
	
	public function facebookAds()
	{		
		$this->load->view('facebook');
	}
}
