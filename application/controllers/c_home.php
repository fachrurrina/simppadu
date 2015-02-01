<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_home extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('templates/top');
		$this->load->view('v_home');
		$this->load->view('templates/bottom');
	}
}