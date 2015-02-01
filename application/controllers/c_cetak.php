<?php

class C_cetak extends CI_Controller{

	function __construct(){
		parent::__construct();
		
	}

	public function index(){
		$this->belum();
	}

	public function belum(){



		$data['belum'] = $this->m_fo->get_where_status_proses(array(10));

        $this->load->view('templates/top');
        $this->load->view('v_cetak_belum', $data);
        $this->load->view('templates/bottom');
	}

	public function sudah(){

		
		$data['belum'] = $this->m_fo->get_where_status_proses(array(11));

        $this->load->view('templates/top');
        $this->load->view('v_cetak_sudah', $data);
        $this->load->view('templates/bottom');
	}

	public function cetak($no_daftar){

		$data['id_sub_modul'] = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model'] = 'm_'. explode('_', $data['nama_sub_modul'])[0];
		$data['nama_function_cetak'] = 'cetak_'. $data['nama_sub_modul'];

		// proses cetak
		$this->$data['nama_model']->$data['nama_function_cetak']($no_daftar);

	}


}