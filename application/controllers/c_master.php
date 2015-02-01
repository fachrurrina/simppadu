<?php  

class C_master extends CI_Controller{


	function __construct(){
		parent::__construct();
	}

	public function index(){

	}

	public function master_bidang_siujk(){

		$this->load->view('inc/header');
        $this->load->view('inc/top_nav');
        $this->load->view('v_master_bidang_siujk');
        $this->load->view('inc/footer');
	}
}