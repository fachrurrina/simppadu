<?php

class C_verifikasi_i extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->belum();
	}

	public function belum(){

		$data['belum'] = $this->m_fo->get_where_status_proses(array(2));

        $this->load->view('templates/top');
        $this->load->view('v_verifikasi_i_belum', $data);
        $this->load->view('templates/bottom');
	}

	public function tolak(){

		$data['tolak'] = $this->m_fo->get_where_status_proses(array(3));

        $this->load->view('templates/top');
        $this->load->view('v_verifikasi_i_tolak', $data);
        $this->load->view('templates/bottom');
	}

	public function sudah(){
		
		$data['sudah'] = $this->m_fo->get_where_status_proses(array(4, 6));

        $this->load->view('templates/top');
        $this->load->view('v_verifikasi_i_sudah', $data);
        $this->load->view('templates/bottom');
	}

	public function verifikasi($no_daftar){

		// ambil data dari t_fo
		$data['verifikasi'] = $this->m_fo->get_where_no_daftar($no_daftar);
		

		if($this->input->post('setujui')){

			// cek apakah jenis izin memilik retribusi ata tidak
			if($this->m_sub_modul->get_status_retribusi($data['verifikasi']->id_sub_modul)){

				// jika retribusi
				$this->m_fo->set_status_proses($no_daftar, 4);
			}else{
				
				// jika tidak retribusi
				$this->m_fo->set_status_proses($no_daftar, 6);
			}

			redirect('c_verifikasi_i');
			
		}

		if($this->input->post('tolak')){

            $pesan_tolak_v_i = $this->input->post('pesan_tolak_v_i');

            if($this->m_fo->tolak_verifikasi_i($no_daftar, $pesan_tolak_v_i)){
                redirect('c_verifikasi_i');
            }
        }

		// ------------------------------------------------
		// data tambahan untuk inputan pada form jenis izin
		
		$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
		// ------------------------------------------------

		$data['modul']      = $this->m_modul->get_all();
		$data['sub_modul']  = $this->m_sub_modul->get_all();

		$data['kec']         = $this->m_kec->get_all();
        $data['kel']         = $this->m_kel->get_all();
		
		
		$data['syarat']     = $this->m_syarat->get_where_id_sub_modul($data['verifikasi']->id_sub_modul);
		
		// load form berdasarkan jenis sub modul
		$data['form_verifikasi_tambahan'] = $this->load->view('verifikasi_i/'. $this->m_sub_modul->get_nama_sub_modul($data['verifikasi']->id_sub_modul), $data, true);


        $this->load->view('templates/top');
        $this->load->view('v_verifikasi_i', $data);
        $this->load->view('templates/bottom');
	}
}