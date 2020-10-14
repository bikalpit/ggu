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
		//fopen('assets/readme/tokenStore.txt');
		if(file_exists("assets/readme/tokenStore.txt"))
		{
			$file = fopen('assets/readme/tokenStore.txt',"r");
			$token =  fgets($file);
			$pass_data = ['token'=>$token];
			fclose($file);	
		}
		else
		{
			$pass_data = ['token'=>""];
		}
		
		$this->load->view('facebook',$pass_data);
	}
	public function updatetoken()
	{
		$access_token = $this->input->post('access_token');
		if(!empty($access_token))
		{
				$myfile = fopen("assets/readme/tokenStore.txt", "w");
				fwrite($myfile, $access_token);
				fclose($myfile);
				echo "1";	
		}
		else
		{
			echo "0";
		}
	}
}
