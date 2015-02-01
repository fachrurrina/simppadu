<?php

class C_verifikasi_ii extends CI_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model('m_kec');
		$this->load->model('m_kel');
	}

	public function index(){
		$this->belum();
	}

	public function belum(){
		$data['belum'] = $this->m_fo->get_where_status_proses(array(8));

        $this->load->view('templates/top');
        $this->load->view('v_verifikasi_ii_belum', $data);
        $this->load->view('templates/bottom');
	}

	public function sudah(){
		$data['sudah'] = $this->m_fo->get_where_status_proses(array(10));

        $this->load->view('templates/top');
        $this->load->view('v_verifikasi_ii_sudah', $data);
        $this->load->view('templates/bottom');
	}

	public function verifikasi($no_daftar){

		if($this->input->post('setujui')){
			
			$this->m_fo->set_status_proses($no_daftar, 10);

			$data['id_sub_modul']   = $this->m_fo->get_id_sub_modul($no_daftar);
			$data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
			$data['nama_model']     = 'm_'.explode('_', $data['nama_sub_modul'])[0];
			
			if (end(explode('_', $data['nama_sub_modul'])) != 'baru') { // jika selain proses baru
				$var_no_sk_lalu         = $data['nama_sub_modul'].'_no_sk';
				$data['fo']             = $this->m_fo->get_where_no_daftar($no_daftar);
				$data['data_lalu']      = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu); // contoh situ_perpanjangan_no_sk
				/*
				jika di setujui maka, matikan status berlaku sk_lalu
				*/
				$this->$data['nama_model']->set_status_berlaku($data['data_lalu']->no_daftar, 0);	
			}
			
			redirect('c_verifikasi_ii');
		}

		if($this->input->post('tolak')){

            $pesan_tolak_v_ii = $this->input->post('pesan_tolak_v_ii');

            if($this->m_fo->tolak_verifikasi_ii($no_daftar, $pesan_tolak_v_ii)){
                redirect('c_verifikasi_ii');
            }
        }


        $data['koif_luas']            = $this->m_koif_luas->get_all();
		$data['koif_tingkat']         = $this->m_koif_tingkat->get_all();
		$data['koif_guna']            = $this->m_koif_guna->get_all();
		$data['harga_dasar_bangunan'] = $this->m_harga_dasar_bangunan->get_all();
		$data['jenis_bangunan'] = $this->m_jenis_bangunan->get_all();
		$data['kepemilikan_tanah'] = $this->m_kepemilikan_tanah->get_all();

		$data['kec'] = $this->m_kec->get_all();
		$data['kel'] = $this->m_kel->get_all();
		$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
		$data['bidang_siujk'] = $this->m_bidang_siujk->get_all();
		$data['bidang_siuk'] = $this->m_bidang_siuk->get_all();
		$data['bidang_sib'] = $this->m_bidang_sib->get_all();
		$data['kbli_5'] = $this->m_kbli->get_5_digit();
		$data['kbli_4'] = $this->m_kbli->get_4_digit();
		$data['kelembagaan_siup'] = $this->m_kelembagaan_siup->get_all();
		$data['bidang_situ'] = $this->m_bidang_situ->get_all();
		$data['bidang_ho'] = $this->m_bidang_ho->get_all();
		$data['jenis_alat_tangkap'] = $this->m_jenis_alat_tangkap->get_all();

		$data['index_gangguan']    = $this->m_index_gangguan->get_all();
		$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
		$data['index_lokasi']      = $this->m_index_lokasi->get_all();
		$data['index_luas']        = $this->m_index_luas->get_all();

		$data['id_sub_modul']                = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul']              = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model']                  = 'm_'. explode('_', $data['nama_sub_modul'])[0];
		
		$data['verifikasi']                  = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
		$data['form_verifikasi_ii_tambahan'] = $this->load->view('verifikasi_ii/'. $data['nama_sub_modul'], $data, true);
		
		$this->load->view('templates/top');
        $this->load->view('v_verifikasi_ii', $data);
        $this->load->view('templates/bottom');
	}

	public function batalkan($no_daftar){

		$data['id_sub_modul'] = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model'] = 'm_'.explode('_', $data['nama_sub_modul'])[0];
		$data['fo'] = $this->m_fo->get_where_no_daftar($no_daftar);
		
		
		if($this->m_fo->set_status_proses($no_daftar, 8)){ // 8 : belum verifikasi ii
			
			redirect('c_verifikasi_ii/sudah');
		} 
		
	}
}
