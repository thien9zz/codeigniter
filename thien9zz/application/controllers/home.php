<?php 

Class Home extends CI_Controller
{
	function index()
	{	$data = array();
		$data['temp'] = 'site/home/index.php';
		$this->load->view('site/layout', $data);
	}
}

