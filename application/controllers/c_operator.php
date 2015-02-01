<?php

class C_operator extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_kec');
		$this->load->model('m_kel');
	}

	public function index(){
		$this->belum();
	}

	public function belum(){

		$data['belum'] = $this->m_fo->get_where_status_proses(array(7));

        $this->load->view('templates/top');
        $this->load->view('v_operator_belum', $data);
        $this->load->view('templates/bottom');
	}

	public function sudah(){
		$data['sudah'] = $this->m_fo->get_where_status_proses(array(8));

        $this->load->view('templates/top');
        $this->load->view('v_operator_sudah', $data);
        $this->load->view('templates/bottom');
	}

	public function tolak(){
		$data['tolak'] = $this->m_fo->get_where_status_proses(array(9));

        $this->load->view('templates/top');
        $this->load->view('v_operator_tolak', $data);
        $this->load->view('templates/bottom');
	}

	public function edit_tolak($no_daftar){

		
		$data['id_sub_modul'] = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model'] = 'm_'.explode('_', $data['nama_sub_modul'])[0];

		$var_no_sk_lalu = $data['nama_sub_modul'].'_no_sk';

		$data['fo'] = $this->m_fo->get_where_no_daftar($no_daftar);

		switch ($data['nama_sub_modul']) {

			case 'imb_baru':
				
				$data['agenda']               = $this->m_imb->get_where_no_daftar($no_daftar);
				$data['koif_luas']            = $this->m_koif_luas->get_all();
				$data['koif_tingkat']         = $this->m_koif_tingkat->get_all();
				$data['koif_guna']            = $this->m_koif_guna->get_all();
				$data['harga_dasar_bangunan'] = $this->m_harga_dasar_bangunan->get_all();
				$data['jenis_bangunan']       = $this->m_jenis_bangunan->get_all();
				$data['kepemilikan_tanah']    = $this->m_kepemilikan_tanah->get_all();
				break;

			case 'tdp_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_5']    = $this->m_kbli->get_5_digit();
				$data['agenda']    = $this->m_tdp->get_where_no_daftar($no_daftar);
				break;
			case 'tdp_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_5']    = $this->m_kbli->get_5_digit();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				break;
			case 'tdp_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_5']    = $this->m_kbli->get_5_digit();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				break;
			case 'siup_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['agenda']           = $this->m_siup->get_where_no_daftar($no_daftar);
				$data['kelembagaan_siup'] = $this->m_kelembagaan_siup->get_all();
				$data['kbli_4']           = $this->m_kbli->get_4_digit();
				break;
			case 'siup_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_4']           = $this->m_kbli->get_4_digit();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['kelembagaan_siup'] = $this->m_kelembagaan_siup->get_all();
				break;

			case 'siup_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_4']           = $this->m_kbli->get_4_digit();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['kelembagaan_siup'] = $this->m_kelembagaan_siup->get_all();
				break;

			case 'situ_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['bidang_situ'] = $this->m_bidang_situ->get_all();
				break;

			case 'situ_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_situ'] = $this->m_bidang_situ->get_all();
				break;

			case 'situ_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_situ'] = $this->m_bidang_situ->get_all();
				break;

			case 'sia_perpanjangan':
				
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				

				break;


			case 'ho_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['agenda']    = $this->m_ho->get_where_no_daftar($no_daftar);
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				break;

			case 'ho_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu']         = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru']         = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				break;

			case 'ho_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu']         = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru']         = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				break;
			
			case 'siujk_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['agenda']      = $this->m_siujk->get_where_no_daftar($no_daftar);
				$data['bidang_siujk'] = $this->m_bidang_siujk->get_all();
				break;

			case 'siujk_perpanjangan':
				
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_siujk'] = $this->m_bidang_siujk->get_all();
				break;

			case 'siujk_perubahan':
				
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_siujk'] = $this->m_bidang_siujk->get_all();
				break;

			case 'siuk_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['agenda']      = $this->m_siuk->get_where_no_daftar($no_daftar);
				$data['bidang_siuk'] = $this->m_bidang_siuk->get_all();
				break;

			case 'siuk_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				break;

			case 'siuk_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				break;

			case 'tdi_baru':
				$data['agenda']      = $this->m_tdi->get_where_no_daftar($no_daftar);
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				break;

			case 'tdi_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				// $data['bidang_situ'] = $this->m_bidang_situ->get_all();
				break;

			case 'sipl_baru':
				$data['agenda']      = $this->m_sipl->get_where_no_daftar($no_daftar);
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				break;

			case 'sisbw_baru':
				$data['agenda']      = $this->m_sisbw->get_where_no_daftar($no_daftar);
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				break;

			case 'sib_baru':
				$data['agenda']      = $this->m_sib->get_where_no_daftar($no_daftar);
				$data['bidang_sib'] = $this->m_bidang_sib->get_all();
				break;

			case 'sipd_baru':
				$data['agenda']      = $this->m_sipd->get_where_no_daftar($no_daftar);
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				break;
			
			default:
				// $data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				break;
		}
		

		if($this->input->post('simpan')){

			

			switch ($data['nama_sub_modul']) {

				case 'siujk_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siujk', array(
						'ket'               => 'B',
						'guna'              => 'BARU',
						'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
						'kualifikasi'       => $this->input->post('kualifikasi'),
						'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						'rt_perusahaan'     => $this->input->post('rt_perusahaan'),
						'rw_perusahaan'     => $this->input->post('rw_perusahaan'),
						'id_kec_perusahaan' => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan' => $this->input->post('id_kel_perusahaan'),
						'kode_pos'          => $this->input->post('kode_pos'),
						'no_telp'           => $this->input->post('no_telp'),
						'no_fax'            => $this->input->post('no_fax'),
						'nama_pemilik'      => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'    => $this->input->post('no_ktp_pemilik'),
						'npwp'              => $this->input->post('npwp'),
						'id_bidang_siujk'   => implode('|', $this->input->post('id_bidang_siujk')),
						'status_berlaku'    => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siujk_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siujk', array(
						'ket'               => 'P',
						'guna'              => 'PERPANJANGAN',
						'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
						'kualifikasi'       => $this->input->post('kualifikasi'),
						'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						'rt_perusahaan'     => $this->input->post('rt_perusahaan'),
						'rw_perusahaan'     => $this->input->post('rw_perusahaan'),
						'id_kec_perusahaan' => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan' => $this->input->post('id_kel_perusahaan'),
						'kode_pos'          => $this->input->post('kode_pos'),
						'no_telp'           => $this->input->post('no_telp'),
						'no_fax'            => $this->input->post('no_fax'),
						'nama_pemilik'      => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'    => $this->input->post('no_ktp_pemilik'),
						'npwp'              => $this->input->post('npwp'),
						'id_bidang_siujk'   => implode('|', $this->input->post('id_bidang_siujk')),
						'status_berlaku'    => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siujk_perubahan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siujk', array(
						'ket'               => 'PR',
						'guna'              => 'PERUBAHAN',
						'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
						'kualifikasi'       => $this->input->post('kualifikasi'),
						'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						'rt_perusahaan'     => $this->input->post('rt_perusahaan'),
						'rw_perusahaan'     => $this->input->post('rw_perusahaan'),
						'id_kec_perusahaan' => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan' => $this->input->post('id_kel_perusahaan'),
						'kode_pos'          => $this->input->post('kode_pos'),
						'no_telp'           => $this->input->post('no_telp'),
						'no_fax'            => $this->input->post('no_fax'),
						'nama_pemilik'      => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'    => $this->input->post('no_ktp_pemilik'),
						'npwp'              => $this->input->post('npwp'),
						'id_bidang_siujk'   => implode('|', $this->input->post('id_bidang_siujk')),
						'status_berlaku'    => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siup_baru':
				
					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siup', array(

						'alasan_penerbitan'          => 'PB',
						'ket'                        => 'PB',
						'guna'                       => 'BARU',
						'nama_perusahaan'            => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'       => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'          => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'          => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'          => $this->input->post('id_kel_perusahaan'),
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'             => $this->input->post('no_ktp_pemilik'),
						'jabatan_pemilik'            => $this->input->post('jabatan_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'tenaga_kerja_a'             => $this->input->post('tenaga_kerja_a'),
						'tenaga_kerja_b'             => $this->input->post('tenaga_kerja_b'),
						'tenaga_kerja_c'             => $this->input->post('tenaga_kerja_c'),
						'tenaga_kerja_d'             => $this->input->post('tenaga_kerja_d'),
						'no_telp'                    => $this->input->post('no_telp'),
						'no_fax'                     => $this->input->post('no_fax'),
						'modal_perusahaan'           => $this->input->post('modal_perusahaan'),
						'id_kelembagaan'             => $this->input->post('id_kelembagaan'),
						'barang_jasa_dagangan_utama' => $this->input->post('barang_jasa_dagangan_utama'),
						'status_berlaku'             => 1,
						'pembaharuan_ke'             => 0

					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siup_perpanjangan':

					if($data['fo']->siup_perpanjangan_status_perubahan){
						if($data['fo']->siup_perpanjangan_alasan_penerbitan == 'PS'){
							$ket = $this->input->post('ket_lalu').' - '.$this->input->post('ket');
						}elseif($data['fo']->siup_perpanjangan_alasan_penerbitan == 'PL'){
							$ket = 'P'. romawi($this->input->post('pembaharuan_ke'));
						}
					}else{
						$ket = 'P'. romawi($this->input->post('pembaharuan_ke'));
					}

					/*
					jika perubahan nya adalah perubahan status, maka pembaharuan_ke kembali jadi 0
					*/
					if($data['fo']->siup_perpanjangan_status_perubahan){
						if($data['fo']->siup_perpanjangan_alasan_penerbitan == 'PS'){
							$pembaharuan_ke = 0;
						}else{
							$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
						}
					}else{
						$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
					}

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siup', array(
						
						
						'alasan_penerbitan'          => $data['fo']->siup_perpanjangan_alasan_penerbitan,
						'ket'                        => $ket,
						'guna'                       => 'PERPANJANGAN',
						'nama_perusahaan'            => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'       => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'          => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'          => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'          => $this->input->post('id_kel_perusahaan'),
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'             => $this->input->post('no_ktp_pemilik'),
						'jabatan_pemilik'            => $this->input->post('jabatan_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'tenaga_kerja_a'             => $this->input->post('tenaga_kerja_a'),
						'tenaga_kerja_b'             => $this->input->post('tenaga_kerja_b'),
						'tenaga_kerja_c'             => $this->input->post('tenaga_kerja_c'),
						'tenaga_kerja_d'             => $this->input->post('tenaga_kerja_d'),
						'no_telp'                    => $this->input->post('no_telp'),
						'no_fax'                     => $this->input->post('no_fax'),
						'modal_perusahaan'           => $this->input->post('modal_perusahaan'),
						'id_kelembagaan'             => $this->input->post('id_kelembagaan'),
						'barang_jasa_dagangan_utama' => $this->input->post('barang_jasa_dagangan_utama'),
						'status_berlaku'             => 1,
						'pembaharuan_ke'           	=> $pembaharuan_ke

					));

					

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}

					break;

				case 'siup_perubahan':

					
					if($data['fo']->siup_perubahan_alasan_penerbitan == 'PS'){
						$ket = $this->input->post('ket_lalu').' - '.$this->input->post('ket');
					}elseif($data['fo']->siup_perubahan_alasan_penerbitan == 'PL'){
						$ket = 'P'. romawi($this->input->post('pembaharuan_ke'));
					}


					if($data['fo']->siup_perubahan_status_perubahan){
						if($data['fo']->siup_perubahan_alasan_penerbitan == 'PS'){
							$pembaharuan_ke = 0;
						}else{
							$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
						}
					}else{
						$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke;
					}
				

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siup', array(
						
						
						'alasan_penerbitan'          => $data['fo']->siup_perubahan_alasan_penerbitan,
						'ket'                        => $ket,
						'guna'                       => 'PERUBAHAN',
						'nama_perusahaan'            => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'       => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'          => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'          => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'          => $this->input->post('id_kel_perusahaan'),
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'             => $this->input->post('no_ktp_pemilik'),
						'jabatan_pemilik'            => $this->input->post('jabatan_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'tenaga_kerja_a'             => $this->input->post('tenaga_kerja_a'),
						'tenaga_kerja_b'             => $this->input->post('tenaga_kerja_b'),
						'tenaga_kerja_c'             => $this->input->post('tenaga_kerja_c'),
						'tenaga_kerja_d'             => $this->input->post('tenaga_kerja_d'),
						'no_telp'                    => $this->input->post('no_telp'),
						'no_fax'                     => $this->input->post('no_fax'),
						'modal_perusahaan'           => $this->input->post('modal_perusahaan'),
						'id_kelembagaan'             => $this->input->post('id_kelembagaan'),
						'barang_jasa_dagangan_utama' => $this->input->post('barang_jasa_dagangan_utama'),
						'status_berlaku'             => 1,
						'pembaharuan_ke'             => $pembaharuan_ke

					));

					

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}

					break;

				case 'tdp_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdp', array(
						
						'alasan_penerbitan'    => 'PB',
						'ket'                  => 'PB',
						'guna'                 => 'BARU',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'status_perusahaan'    => $this->input->post('status_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'       => $this->input->post('no_ktp_pemilik'),
						'npwp'                 => $this->input->post('npwp'),
						'no_telp'              => $this->input->post('no_telp'),
						'no_fax'               => $this->input->post('no_fax'),
						'no_akte_notaris'      => $this->input->post('no_akte_notaris'),
						'status_berlaku'       => 1,
						'pembaharuan_ke  '     => 0
						
					
					));

					$this->m_fo->set_status_proses($no_daftar, 8);

					if($simpan){
						redirect('c_operator/tolak');
					}

					break;

				case 'tdp_perpanjangan':

					if($data['fo']->tdp_perpanjangan_status_perubahan){
						if($data['fo']->tdp_perpanjangan_alasan_penerbitan == 'PS'){
							$ket = $this->input->post('ket_lalu').' - '.$this->input->post('ket');
						}elseif($data['fo']->tdp_perpanjangan_alasan_penerbitan == 'PL'){
							$ket = 'P'. (romawi($data['data_lalu']->pembaharuan_ke + 1));
						}
					}else{
						$ket = 'P'. (romawi($data['data_lalu']->pembaharuan_ke + 1));
					}

					/*
					jika perubahan nya adalah perubahan status, maka pembaharuan_ke kembali jadi 0
					*/
					if($data['fo']->tdp_perpanjangan_status_perubahan){
						if($data['fo']->tdp_perpanjangan_alasan_penerbitan == 'PS'){
							$pembaharuan_ke = 0;
						}else{
							$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
						}
					}else{
						$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
					}

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdp', array(
						
						
						'alasan_penerbitan'    => $data['fo']->tdp_perpanjangan_alasan_penerbitan,
						'ket'                  => $ket,
						'guna'                 => 'PERPANJANGAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'status_perusahaan'    => $this->input->post('status_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'       => $this->input->post('no_ktp_pemilik'),
						'npwp'                 => $this->input->post('npwp'),
						'no_telp'              => $this->input->post('no_telp'),
						'no_fax'               => $this->input->post('no_fax'),
						'no_akte_notaris'      => $this->input->post('no_akte_notaris'),
						'status_berlaku'       => 1,
						'pembaharuan_ke'       => $pembaharuan_ke
					));

					
					

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}

					break;
				
				case 'tdp_perubahan':


					if($data['fo']->tdp_perubahan_alasan_penerbitan == 'PS'){
						$ket = $this->input->post('ket_status_modal').' - '.$this->input->post('ket_status_modal_baru');
					}elseif($data['fo']->tdp_perubahan_alasan_penerbitan == 'PL'){
						$ket = 'P'. romawi($data['data_lalu']->pembaharuan_ke + 1);
					}

					if($data['fo']->tdp_perubahan_status_perubahan){
						if($data['fo']->tdp_perubahan_alasan_penerbitan == 'PS'){
							$pembaharuan_ke = 0;
						}else{
							$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke;
						}
					}else{
						$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke;
					}
				

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdp', array(
						
						
						'alasan_penerbitan'    => $data['fo']->tdp_perubahan_alasan_penerbitan,
						'ket'                  => $ket,
						'guna'                 => 'PERUBAHAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'status_perusahaan'    => $this->input->post('status_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'       => $this->input->post('no_ktp_pemilik'),
						'npwp'                 => $this->input->post('npwp'),
						'no_telp'              => $this->input->post('no_telp'),
						'no_fax'               => $this->input->post('no_fax'),
						'no_akte_notaris'      => $this->input->post('no_akte_notaris'),
						'status_berlaku'       => 1,
						'pembaharuan_ke'       => $pembaharuan_ke
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}

					break;


				case 'situ_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_situ', array(

						
						'ket'                  => 'B',
						'guna'                 => 'BARU',
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'npwpd_npwrd'          => $this->input->post('npwpd_npwrd'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'panjang_tempat_usaha' => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'   => $this->input->post('lebar_tempat_usaha'),
						'nama_bidang_situ'       => $this->input->post('nama_bidang_situ'),
						'klasifikasi'          => $this->input->post('klasifikasi'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'situ_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_situ', array(
						'ket'                  => 'P',
						'guna'                 => 'PERPANJANGAN',
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'npwpd_npwrd'          => $this->input->post('npwpd_npwrd'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'panjang_tempat_usaha' => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'   => $this->input->post('lebar_tempat_usaha'),
						'nama_bidang_situ'       => $this->input->post('nama_bidang_situ'),
						'klasifikasi'          => $this->input->post('klasifikasi'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'situ_perubahan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_situ', array(
						'ket'                  => 'PR',
						'guna'                 => 'PERUBAHAN',
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'npwpd_npwrd'          => $this->input->post('npwpd_npwrd'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'panjang_tempat_usaha' => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'   => $this->input->post('lebar_tempat_usaha'),
						'nama_bidang_situ'       => $this->input->post('nama_bidang_situ'),
						'klasifikasi'          => $this->input->post('klasifikasi'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'imb_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_imb', array(


						'guna'                        => 'BARU',
						'nama_pemilik'                => $this->input->post('nama_pemilik'),
						
						'alamat_pemilik'              => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'              => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'              => $this->input->post('id_kel_pemilik'),
						
						'alamat_bangunan'             => $this->input->post('alamat_bangunan'),
						'id_kec_bangunan'             => $this->input->post('id_kec_bangunan'),
						'id_kel_bangunan'             => $this->input->post('id_kel_bangunan'),
						
						'id_jenis_bangunan'           => $this->input->post('id_jenis_bangunan'),
						'id_hak_kepemilikan'          => $this->input->post('id_hak_kepemilikan'),
						'luas_bangunan'               => $this->input->post('luas_bangunan'),
						'id_koif_luas'                => $this->input->post('id_koif_luas'),
						'id_koif_tingkat'             => $this->input->post('id_koif_tingkat'),
						'id_koif_guna'                => $this->input->post('id_koif_guna'),
						'id_harga_dasar'              => $this->input->post('id_harga_dasar'),
						
						'nilai_retribusi'             => $this->input->post('nilai_retribusi'),
						
						'no_sertifikat_tanah'         => $this->input->post('no_sertifikat_tanah'),
						'tanggal_peninjauan_lapangan' => $this->input->post('tanggal_peninjauan_lapangan'),
						'tanggal_daftar'              => $this->input->post('tanggal_daftar'),
						'tanggal_terbit'              => $this->input->post('tanggal_terbit'),
						'status_berlaku'              => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'ho_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_ho', array(


						'guna'                                => 'BARU',
						'nama_pemilik'                        => $this->input->post('nama_pemilik'),
						'jenis_kelamin_pemilik'               => $this->input->post('jenis_kelamin_pemilik'),
						'pekerjaan_pemilik'                   => $this->input->post('pekerjaan_pemilik'),
						'alamat_pemilik'                      => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'                      => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'                      => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'                     => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'                => $this->input->post('id_bentuk_perusahaan'),
						'nama_bidang_usaha'                   => $this->input->post('nama_bidang_usaha'),
						'alamat_perusahaan'                   => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'                   => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'                   => $this->input->post('id_kel_perusahaan'),
						'npwpd_npwrd'                         => $this->input->post('npwpd_npwrd'),
						'status_kepemilikan_tanah'            => $this->input->post('status_kepemilikan_tanah'),
						'batas_utara'                         => $this->input->post('batas_utara'),
						'batas_selatan'                       => $this->input->post('batas_selatan'),
						'batas_timur'                         => $this->input->post('batas_timur'),
						'batas_barat'                         => $this->input->post('batas_barat'),
						'tinggi_tower'                        => $this->input->post('tinggi_tower'),
						'ket_luas_tempat_usaha'               => $this->input->post('ket_luas_tempat_usaha'),
						'panjang_tempat_usaha'                => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'                  => $this->input->post('lebar_tempat_usaha'),
						'kode_index_luas'                     => $this->input->post('kode_index_luas'),
						'kode_index_gangguan'                 => $this->input->post('kode_index_gangguan'),
						'kode_index_lokasi'                   => $this->input->post('kode_index_lokasi'),
						'kode_index_harga_dasar'              => $this->input->post('kode_index_harga_dasar'),
						'nilai_retribusi'                     => $this->input->post('nilai_retribusi'),
						'mesin_penggerak'                     => $this->input->post('mesin_penggerak'),
						'bahan_bakar'                         => $this->input->post('bahan_bakar'),
						'pembangkit_listrik'                  => $this->input->post('pembangkit_listrik'),
						'no_surat_ket_usaha'                  => $this->input->post('no_surat_ket_usaha'),
						'tanggal_permohonan'                  => $this->input->post('tanggal_permohonan'),
						'tanggal_surat_ket_usaha'             => $this->input->post('tanggal_surat_ket_usaha'),
						'tanggal_peninjauan_lapangan'         => $this->input->post('tanggal_peninjauan_lapangan'),
						'tanggal_surat_pernyataan_lingkungan' => $this->input->post('tanggal_surat_pernyataan_lingkungan'),
						'status_berlaku'                      => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'ho_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_ho', array(


						'guna'                                => 'PERPANJANGAN',
						'nama_pemilik'                        => $this->input->post('nama_pemilik'),
						'jenis_kelamin_pemilik'               => $this->input->post('jenis_kelamin_pemilik'),
						'pekerjaan_pemilik'                   => $this->input->post('pekerjaan_pemilik'),
						'alamat_pemilik'                      => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'                      => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'                      => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'                     => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'                => $this->input->post('id_bentuk_perusahaan'),
						'nama_bidang_usaha'                   => $this->input->post('nama_bidang_usaha'),
						'alamat_perusahaan'                   => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'                   => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'                   => $this->input->post('id_kel_perusahaan'),
						'npwpd_npwrd'                         => $this->input->post('npwpd_npwrd'),
						'status_kepemilikan_tanah'            => $this->input->post('status_kepemilikan_tanah'),
						'batas_utara'                         => $this->input->post('batas_utara'),
						'batas_selatan'                       => $this->input->post('batas_selatan'),
						'batas_timur'                         => $this->input->post('batas_timur'),
						'batas_barat'                         => $this->input->post('batas_barat'),
						'tinggi_tower'                        => $this->input->post('tinggi_tower'),
						'ket_luas_tempat_usaha'               => $this->input->post('ket_luas_tempat_usaha'),
						'panjang_tempat_usaha'                => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'                  => $this->input->post('lebar_tempat_usaha'),
						'kode_index_luas'                     => $this->input->post('kode_index_luas'),
						'kode_index_gangguan'                 => $this->input->post('kode_index_gangguan'),
						'kode_index_lokasi'                   => $this->input->post('kode_index_lokasi'),
						'kode_index_harga_dasar'              => $this->input->post('kode_index_harga_dasar'),
						'nilai_retribusi'                     => $this->input->post('nilai_retribusi'),
						'mesin_penggerak'                     => $this->input->post('mesin_penggerak'),
						'bahan_bakar'                         => $this->input->post('bahan_bakar'),
						'pembangkit_listrik'                  => $this->input->post('pembangkit_listrik'),
						'no_surat_ket_usaha'                  => $this->input->post('no_surat_ket_usaha'),
						'tanggal_permohonan'                  => $this->input->post('tanggal_permohonan'),
						'tanggal_surat_ket_usaha'             => $this->input->post('tanggal_surat_ket_usaha'),
						'tanggal_peninjauan_lapangan'         => $this->input->post('tanggal_peninjauan_lapangan'),
						'tanggal_surat_pernyataan_lingkungan' => $this->input->post('tanggal_surat_pernyataan_lingkungan'),
						'status_berlaku'                      => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'ho_perubahan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_ho', array(


						'guna'                                => 'PERPANJANGAN',
						'nama_pemilik'                        => $this->input->post('nama_pemilik'),
						'jenis_kelamin_pemilik'               => $this->input->post('jenis_kelamin_pemilik'),
						'pekerjaan_pemilik'                   => $this->input->post('pekerjaan_pemilik'),
						'alamat_pemilik'                      => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'                      => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'                      => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'                     => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'                => $this->input->post('id_bentuk_perusahaan'),
						'nama_bidang_usaha'                   => $this->input->post('nama_bidang_usaha'),
						'alamat_perusahaan'                   => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'                   => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'                   => $this->input->post('id_kel_perusahaan'),
						'npwpd_npwrd'                         => $this->input->post('npwpd_npwrd'),
						'status_kepemilikan_tanah'            => $this->input->post('status_kepemilikan_tanah'),
						'batas_utara'                         => $this->input->post('batas_utara'),
						'batas_selatan'                       => $this->input->post('batas_selatan'),
						'batas_timur'                         => $this->input->post('batas_timur'),
						'batas_barat'                         => $this->input->post('batas_barat'),
						'tinggi_tower'                        => $this->input->post('tinggi_tower'),
						'ket_luas_tempat_usaha'               => $this->input->post('ket_luas_tempat_usaha'),
						'panjang_tempat_usaha'                => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'                  => $this->input->post('lebar_tempat_usaha'),
						'kode_index_luas'                     => $this->input->post('kode_index_luas'),
						'kode_index_gangguan'                 => $this->input->post('kode_index_gangguan'),
						'kode_index_lokasi'                   => $this->input->post('kode_index_lokasi'),
						'kode_index_harga_dasar'              => $this->input->post('kode_index_harga_dasar'),
						'nilai_retribusi'                     => $this->input->post('nilai_retribusi'),
						'mesin_penggerak'                     => $this->input->post('mesin_penggerak'),
						'bahan_bakar'                         => $this->input->post('bahan_bakar'),
						'pembangkit_listrik'                  => $this->input->post('pembangkit_listrik'),
						'no_surat_ket_usaha'                  => $this->input->post('no_surat_ket_usaha'),
						'tanggal_permohonan'                  => $this->input->post('tanggal_permohonan'),
						'tanggal_surat_ket_usaha'             => $this->input->post('tanggal_surat_ket_usaha'),
						'tanggal_peninjauan_lapangan'         => $this->input->post('tanggal_peninjauan_lapangan'),
						'tanggal_surat_pernyataan_lingkungan' => $this->input->post('tanggal_surat_pernyataan_lingkungan'),
						'status_berlaku'                      => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siuk_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siuk', array(

						
						'ket'                  => 'B',
						'guna'                 => 'BARU',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_bidang_usaha'       => $this->input->post('nama_bidang_usaha'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'siuk_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siuk', array(

						
						'ket'                  => 'P',
						'guna'                 => 'PERPANJANGAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_bidang_usaha'       => $this->input->post('nama_bidang_usaha'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siuk_perubahan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siuk', array(

						
						'ket'                  => 'PR',
						'guna'                 => 'PERUBAHAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_bidang_usaha'       => $this->input->post('nama_bidang_usaha'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;



				case 'tdi_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdi', array(

						
						'ket'                  => 'B',
						'guna'                 => 'BARU',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'nipik'                => $this->input->post('nipik'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'komoditi_industri'    => $this->input->post('komoditi_industri'),
						'alamat_pabrik'        => $this->input->post('alamat_pabrik'),
						'id_kec_pabrik'        => $this->input->post('id_kec_pabrik'),
						'id_kel_pabrik'        => $this->input->post('id_kel_pabrik'),
						'mesin_utama'          => $this->input->post('mesin_utama'),
						'mesin_pembantu'       => $this->input->post('mesin_pembantu'),						
						'tenaga_penggerak'     => $this->input->post('tenaga_penggerak'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'kapasitas_produksi'   => $this->input->post('kapasitas_produksi'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'tdi_perubahan':



					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdi', array(

						
						'ket'                  => 'PR',
						'guna'                 => 'PERUBAHAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'nipik'                => $this->input->post('nipik'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'komoditi_industri'    => $this->input->post('komoditi_industri'),
						'alamat_pabrik'        => $this->input->post('alamat_pabrik'),
						'id_kec_pabrik'        => $this->input->post('id_kec_pabrik'),
						'id_kel_pabrik'        => $this->input->post('id_kel_pabrik'),
						'mesin_utama'          => $this->input->post('mesin_utama'),
						'mesin_pembantu'       => $this->input->post('mesin_pembantu'),						
						'tenaga_penggerak'     => $this->input->post('tenaga_penggerak'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'kapasitas_produksi'   => $this->input->post('kapasitas_produksi'),
						'no_sk_lalu'           => $this->input->post('no_sk_lalu'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipl_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipl', array(

						
						'ket'                       => 'B',
						'guna'                      => 'BARU',
						'nama_pemilik'              => $this->input->post('nama_pemilik'),
						'nama_perusahaan'           => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'      => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'         => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'         => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'         => $this->input->post('id_kel_perusahaan'),
						'jenis_limbah'              => $this->input->post('jenis_limbah'),
						'jumlah_ton'                => $this->input->post('jumlah_ton'),
						'alamat_penyimpanan'        => $this->input->post('alamat_penyimpanan'),
						'id_kel_penyimpanan'        => $this->input->post('id_kel_penyimpanan'),
						'id_kec_penyimpanan'        => $this->input->post('id_kec_penyimpanan'),
						'maksud_penyimpanan'        => $this->input->post('maksud_penyimpanan'),
						'waktu_keberangkatan'       => $this->input->post('waktu_keberangkatan'),
						'dipindahkan_kepada'        => $this->input->post('dipindahkan_kepada'),
						'alamat_pindah'             => $this->input->post('alamat_pindah'),
						'jumlah_ton_pindah'         => $this->input->post('jumlah_ton_pindah'),
						'kendaraan_angkutan'        => $this->input->post('kendaraan_angkutan'),
						'nopol_kendaraan'           => $this->input->post('nopol_kendaraan'),
						'lokasi_penyimpanan_pindah' => $this->input->post('lokasi_penyimpanan_pindah'),
						'maksud_penyimpanan_pindah' => $this->input->post('maksud_penyimpanan_pindah'),
						'keterangan_barang'         => implode('|', $this->input->post('keterangan_barang')),
						'status_berlaku'            => 1
					));

				case 'sisbw_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sisbw', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',
						'nama_pemilik'   => $this->input->post('nama_pemilik'),
						
						'alamat_pemilik' => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik' => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik' => $this->input->post('id_kel_pemilik'),
						
						'npwpd_npwrd'    => $this->input->post('npwpd_npwrd'),
						'alamat_usaha'   => $this->input->post('alamat_usaha'),
						'id_kec_usaha'   => $this->input->post('id_kec_usaha'),
						'id_kel_usaha'   => $this->input->post('id_kel_usaha'),
						
						'no_telp'        => $this->input->post('no_telp'),
						'klasifikasi'    => $this->input->post('klasifikasi'),
						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siuakb_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siuakb', array(

						
						'ket'               => 'B',
						'guna'              => 'BARU',
						'nama_pemilik'      => $this->input->post('nama_pemilik'),
						'alamat_pemilik'    => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'    => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'    => $this->input->post('id_kel_pemilik'),
						
						'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
						'jenis_usaha'       => $this->input->post('jenis_usaha'),
						
						'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan' => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan' => $this->input->post('id_kel_pemilik'),
						
						'npwp'              => $this->input->post('npwp'),
						'npwpd_npwrd'       => $this->input->post('npwpd_npwrd'),
						'jumlah_kendaraan'  => $this->input->post('jumlah_kendaraan'),
						'jenis_usaha'       => $this->input->post('jenis_usaha'),
						
						'status_berlaku'    => 1



					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'sib_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sib', array(

						'alasan_penerbitan'          => 'PB',
						'ket'                        => 'PB',
						'guna'                       => 'BARU',
                        
						'nama_perusahaan'            => $this->input->post('nama_perusahaan'),
						'merek_perusahaan'           => $this->input->post('merek_perusahaan'),
						'alamat_perusahaan'          => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'          => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'          => $this->input->post('id_kel_perusahaan'),
						'no_telp'                    => $this->input->post('no_telp'),
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'npwpd'                      => $this->input->post('npwpd'),
						'modal'                      => $this->input->post('modal'),
						
						'kelembagaan'                => $this->input->post('kelembagaan'),
						'id_bidang_sib'              => $this->input->post('id_bidang_sib'),
						'barang_jasa_dagangan_utama' => $this->input->post('barang_jasa_dagangan_utama'),
						
						'no_sk_lalu'                 => $this->input->post('no_sk_lalu'),
						

						'status_berlaku'             => 1,
						'pembaharuan_ke'             => 0

					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'sipd_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipd', array(

						
						'ket'                  => 'PB',
						'guna'                 => 'BARU',
						
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'jenis_bahan'          => $this->input->post('jenis_bahan'),
						'alamat_lokasi'        => $this->input->post('alamat_lokasi'),
						'id_kec_lokasi'        => $this->input->post('id_kec_lokasi'),
						'id_kel_lokasi'        => $this->input->post('id_kel_lokasi'),
						'luas_wilayah'         => $this->input->post('luas_wilayah'),
						'batas_utara'          => $this->input->post('batas_utara'),
						'batas_selatan'        => $this->input->post('batas_selatan'),
						'batas_timur'          => $this->input->post('batas_timur'),
						'batas_barat'          => $this->input->post('batas_barat'),
						
						'koordinat_n'             => implode('|', $this->input->post('koordinat_n')),
                		'koordinat_e'             => implode('|', $this->input->post('koordinat_e')),
						
						'status_berlaku'       => 1,
						

					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipb_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipb', array(

						
						'ket'                      => 'B',
						'guna'                     => 'BARU',
						
						'nama_pemilik'             => $this->input->post('nama_pemilik'),
						'alamat_pemilik'           => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'           => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'           => $this->input->post('id_kel_pemilik'),
						'nama_tempat_praktek'      => $this->input->post('nama_tempat_praktek'),
						'no_surat_tanda_reg_bidan' => $this->input->post('no_surat_tanda_reg_bidan'),
						'alamat_tempat_praktek'    => $this->input->post('alamat_tempat_praktek'),
						'id_kec_tempat_praktek'    => $this->input->post('id_kec_tempat_praktek'),
						'id_kel_tempat_praktek'    => $this->input->post('id_kel_tempat_praktek'),
						'status_berlaku'           => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sikb_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sikb', array(

						
						'ket'                        => 'B',
						'guna'                       => 'BARU',
						
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'tempat_lahir'               => $this->input->post('tempat_lahir'),
						'tanggal_lahir'              => $this->input->post('tanggal_lahir'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'nama_tempat_kerja'          => $this->input->post('nama_tempat_kerja'),
						'no_sib_str' 				 => $this->input->post('no_sib_str'),
						'alamat_tempat_kerja'        => $this->input->post('alamat_tempat_kerja'),
						'id_kec_tempat_kerja'        => $this->input->post('id_kec_tempat_kerja'),
						'id_kel_tempat_kerja'        => $this->input->post('id_kel_tempat_kerja'),
						'status_berlaku'             => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'sikp_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sikp', array(

						
						'ket'                        => 'B',
						'guna'                       => 'BARU',
						
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'tempat_lahir'               => $this->input->post('tempat_lahir'),
						'tanggal_lahir'              => $this->input->post('tanggal_lahir'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'nama_tempat_kerja'          => $this->input->post('nama_tempat_kerja'),
						'no_sib_str' 				 => $this->input->post('no_sib_str'),
						'alamat_tempat_kerja'        => $this->input->post('alamat_tempat_kerja'),
						'id_kec_tempat_kerja'        => $this->input->post('id_kec_tempat_kerja'),
						'id_kel_tempat_kerja'        => $this->input->post('id_kel_tempat_kerja'),
						'status_berlaku'             => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'sipp_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipp', array(

						
						'ket'                        => 'B',
						'guna'                       => 'BARU',
						
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'nama_tempat_praktek'        => $this->input->post('nama_tempat_praktek'),
						'no_surat_tanda_reg_perawat' => $this->input->post('no_surat_tanda_reg_perawat'),
						'alamat_tempat_praktek'      => $this->input->post('alamat_tempat_praktek'),
						'id_kec_tempat_praktek'      => $this->input->post('id_kec_tempat_praktek'),
						'id_kel_tempat_praktek'      => $this->input->post('id_kel_tempat_praktek'),
						'status_berlaku'             => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipo_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipo', array(

						'ket'                   => 'B',
						'guna'                  => 'BARU',
						
						'nama_pemilik'          => $this->input->post('nama_pemilik'),
						'alamat_pemilik'        => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'        => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'        => $this->input->post('id_kel_pemilik'),
						'no_surat_izin_kerja'   => $this->input->post('no_surat_izin_kerja'),
						
						'nama_optik'            => $this->input->post('nama_optik'),
						'alamat_optik'          => $this->input->post('alamat_optik'),
						'id_kec_optik'          => $this->input->post('id_kec_optik'),
						'id_kel_optik'          => $this->input->post('id_kel_optik'),
						
						'nama_pemilik_sarana'   => $this->input->post('nama_pemilik_sarana'),
						'alamat_pemilik_sarana' => $this->input->post('alamat_pemilik_sarana'),
						'id_kec_pemilik_sarana' => $this->input->post('id_kec_pemilik_sarana'),
						'id_kel_pemilik_sarana' => $this->input->post('id_kel_pemilik_sarana'),

						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				
				case 'sipo_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipo', array(
						'ket'            => 'P',
						'guna'           => 'PERPANJANGAN',
						
						'nama_pemilik'   => $this->input->post('nama_pemilik'),
						'alamat_pemilik' => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik' => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik' => $this->input->post('id_kel_pemilik'),
						'nama_optik'     => $this->input->post('nama_optik'),
						
						'alamat_optik'   => $this->input->post('alamat_optik'),
						'id_kec_optik'   => $this->input->post('id_kec_optik'),
						'id_kel_optik'   => $this->input->post('id_kel_optik'),
						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;



				case 'sia_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sia', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',
						
						'nama_pemilik'                 => $this->input->post('nama_pemilik'),
						'alamat_pemilik'               => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'               => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'               => $this->input->post('id_kel_pemilik'),
						'no_sipa'                      => $this->input->post('no_sipa'),
						'nama_apotek'                  => $this->input->post('nama_apotek'),
						'alamat_apotek'                => $this->input->post('alamat_apotek'),
						'id_kec_apotek'                => $this->input->post('id_kec_apotek'),
						'id_kel_apotek'                => $this->input->post('id_kel_apotek'),
						'nama_pemilik_sarana'          => $this->input->post('nama_pemilik_sarana'),
						'alamat_pemilik_sarana'        => $this->input->post('alamat_pemilik_sarana'),
						'id_kec_pemilik_sarana'        => $this->input->post('id_kec_pemilik_sarana'),
						'id_kel_pemilik_sarana'        => $this->input->post('id_kel_pemilik_sarana'),
						'no_akte_perjanjian'           => $this->input->post('no_akte_perjanjian'),
						'tanggal_akte_perjanjian'      => $this->input->post('tanggal_akte_perjanjian'),
						'nama_notaris_akte_perjanjian' => $this->input->post('nama_notaris_akte_perjanjian'),
						'tempat_akte_perjanjian'       => $this->input->post('tempat_akte_perjanjian'),

						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sia_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sia', array(

						
						'ket'            => 'P',
						'guna'           => 'PERPANJANGAN',
						
						'nama_pemilik'                 => $this->input->post('nama_pemilik'),
						'alamat_pemilik'               => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'               => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'               => $this->input->post('id_kel_pemilik'),
						'no_sipa'                      => $this->input->post('no_sipa'),
						'nama_apotek'                  => $this->input->post('nama_apotek'),
						'alamat_apotek'                => $this->input->post('alamat_apotek'),
						'id_kec_apotek'                => $this->input->post('id_kec_apotek'),
						'id_kel_apotek'                => $this->input->post('id_kel_apotek'),
						'nama_pemilik_sarana'          => $this->input->post('nama_pemilik_sarana'),
						'alamat_pemilik_sarana'        => $this->input->post('alamat_pemilik_sarana'),
						'id_kec_pemilik_sarana'        => $this->input->post('id_kec_pemilik_sarana'),
						'id_kel_pemilik_sarana'        => $this->input->post('id_kel_pemilik_sarana'),
						'no_akte_perjanjian'           => $this->input->post('no_akte_perjanjian'),
						'tanggal_akte_perjanjian'      => $this->input->post('tanggal_akte_perjanjian'),
						'nama_notaris_akte_perjanjian' => $this->input->post('nama_notaris_akte_perjanjian'),
						'tempat_akte_perjanjian'       => $this->input->post('tempat_akte_perjanjian'),
						'no_sk_lalu'       => $this->input->post('no_sk_lalu'),
						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						$this->m_sia->set_status_berlaku($data['data_lalu']->no_daftar, 0);
						redirect('c_operator');
					}
					break;

				case 'sik_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sik', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',

						'nama_pemilik' => $this->input->post('nama_pemilik'),
						'alamat_pemilik' => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik' => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik' => $this->input->post('id_kel_pemilik'),
						'nama_klinik' => $this->input->post('nama_klinik'),
						'alamat_klinik' => $this->input->post('alamat_klinik'),
						'id_kec_klinik' => $this->input->post('id_kec_klinik'),
						'id_kel_klinik' => $this->input->post('id_kel_klinik'),
						'jasa_pelayanan' => $this->input->post('jasa_pelayanan'),
						'nama_pimpinan' => $this->input->post('nama_pimpinan'),
						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'siot_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siot', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',

						'no_surat_dirjen_buk'      => $this->input->post('no_surat_dirjen_buk'),
						'tanggal_surat_dirjen_buk' => $this->input->post('tanggal_surat_dirjen_buk'),
						'nama_rumah_sakit'         => $this->input->post('nama_rumah_sakit'),
						'klasifikasi_kelas_menkes' => $this->input->post('klasifikasi_kelas_menkes'),
						'alamat_rumah_sakit'       => $this->input->post('alamat_rumah_sakit'),
						'id_kec_rumah_sakit'       => $this->input->post('id_kec_rumah_sakit'),
						'id_kel_rumah_sakit'       => $this->input->post('id_kel_rumah_sakit'),
						'nama_pemilik'             => $this->input->post('nama_pemilik'),
						'alamat_pemilik'           => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'           => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'           => $this->input->post('id_kel_pemilik'),
						'dokter_penanggung_jawab'  => $this->input->post('dokter_penanggung_jawab'),
						'no_sip_dokter'            => $this->input->post('no_sip_dokter'),
						'tanggal_berlaku_sip'      => $this->input->post('tanggal_berlaku_sip'),


						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sios_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sios', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',

						
						'nama_rumah_sakit'         => $this->input->post('nama_rumah_sakit'),
						
						'alamat_rumah_sakit'       => $this->input->post('alamat_rumah_sakit'),
						'id_kec_rumah_sakit'       => $this->input->post('id_kec_rumah_sakit'),
						'id_kel_rumah_sakit'       => $this->input->post('id_kel_rumah_sakit'),
						'nama_pemilik'             => $this->input->post('nama_pemilik'),
						'alamat_pemilik'           => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'           => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'           => $this->input->post('id_kel_pemilik'),
						'dokter_penanggung_jawab'  => $this->input->post('dokter_penanggung_jawab'),
						'no_sip_dokter'            => $this->input->post('no_sip_dokter'),
						'tanggal_berlaku_sip'      => $this->input->post('tanggal_berlaku_sip'),


						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipi_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipi', array(

						
						'ket'                    => 'B',
						'guna'                   => 'BARU',
						
						'nama'                   => $this->input->post('nama'),
						'alamat'                 => $this->input->post('alamat'),
						'id_kec'                 => $this->input->post('id_kec'),
						'id_kel'                 => $this->input->post('id_kel'),
						'no_ktp'                 => $this->input->post('no_ktp'),
						'nama_kapal'             => $this->input->post('nama_kapal'),
						'tempat_reg_kapal'       => $this->input->post('tempat_reg_kapal'),
						'no_reg_kapal'           => $this->input->post('no_reg_kapal'),
						'tempat_gelar_kapal'     => $this->input->post('tempat_gelar_kapal'),
						'nama_panggilan_kapal'   => $this->input->post('nama_panggilan_kapal'),
						'tanda_gelar_kapal'      => $this->input->post('tanda_gelar_kapal'),
						'asal_kapal'             => $this->input->post('asal_kapal'),
						'negara_asal_kapal'      => $this->input->post('negara_asal_kapal'),
						'tempat_pembuatan_kapal' => $this->input->post('tempat_pembuatan_kapal'),
						'jenis_kapal'            => $this->input->post('jenis_kapal'),
						'id_jenis_alat_tangkap'  => $this->input->post('id_jenis_alat_tangkap'),
						'nilai_retribusi'        => $this->input->post('nilai_retribusi'),
						'tonase_kotor'           => $this->input->post('tonase_kotor'),
						'tonase_bersih'          => $this->input->post('tonase_bersih'),
						'kekuatan_mesin'         => $this->input->post('kekuatan_mesin'),
						'merek_mesin'            => $this->input->post('merek_mesin'),
						'no_seri_mesin'          => $this->input->post('no_seri_mesin'),
						'bahan_kasco'            => $this->input->post('bahan_kasco'),
						'no_iup'                 => $this->input->post('no_iup'),
						'tanggal_iup'            => $this->input->post('tanggal_iup'),
						'no_permohonan_iup'      => $this->input->post('no_permohonan_iup'),
						'tanggal_permohonan_iup' => $this->input->post('tanggal_permohonan_iup'),
						'daerah_penangkapan'     => $this->input->post('daerah_penangkapan'),
						'daerah_terlarang'       => $this->input->post('daerah_terlarang'),
						'pelabuhan_penangkalan'  => $this->input->post('pelabuhan_penangkalan'),
						'anak_buah_kapal'        => $this->input->post('anak_buah_kapal'),
						
						'status_berlaku'         => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;



				default:
					# code...
					break;
			}
		}

		$data['kec'] = $this->m_kec->get_all();
		$data['kel'] = $this->m_kel->get_all();


		
		$data['edit'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
		$data['pesan_tolak_v_ii'] = $this->m_fo->get_where_no_daftar($no_daftar)->pesan_tolak_v_ii;

		$data['form_edit_tolak'] = $this->load->view('edit_tolak_verifikasi_ii/'. $data['nama_sub_modul'], $data, true);

		$this->load->view('templates/top');
        $this->load->view('v_operator_edit_tolak', $data);
        $this->load->view('templates/bottom');
	}


	public function entry($no_daftar){

		$data['no_daftar'] = $no_daftar;

		$data['id_sub_modul'] = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model'] = 'm_'.explode('_', $data['nama_sub_modul'])[0];

		$var_no_sk_lalu = $data['nama_sub_modul'].'_no_sk';

		$data['fo'] = $this->m_fo->get_where_no_daftar($no_daftar);

		// echo "<pre>";
		// print_r($data['fo']);
		// echo "</pre>";
		// load data tergantung kebutuhan jenis izin
		switch ($data['nama_sub_modul']) {

			case 'tdp_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_5']    = $this->m_kbli->get_5_digit();
				$data['agenda']    = $this->m_tdp->get_where_no_daftar($no_daftar);
				break;
			case 'tdp_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_5']    = $this->m_kbli->get_5_digit();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				break;
			case 'tdp_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_5']    = $this->m_kbli->get_5_digit();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				break;
			case 'siup_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['agenda']           = $this->m_siup->get_where_no_daftar($no_daftar);
				$data['kelembagaan_siup'] = $this->m_kelembagaan_siup->get_all();
				$data['kbli_4']           = $this->m_kbli->get_4_digit();
				break;
			case 'siup_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_4']           = $this->m_kbli->get_4_digit();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['kelembagaan_siup'] = $this->m_kelembagaan_siup->get_all();
				break;

			case 'siup_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['kbli_4']            = $this->m_kbli->get_4_digit();
				$data['data_lalu']         = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru']         = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['kelembagaan_siup']  = $this->m_kelembagaan_siup->get_all();
				break;

			case 'situ_baru':
				$data['agenda']      = $this->m_situ->get_where_no_daftar($no_daftar);
				$data['bidang_situ'] = $this->m_bidang_situ->get_all();
				break;

			case 'situ_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				/*
				get_where_no_sk :: where no_sk == "" and status_berlaku == 1
				Ambil data lalu yang masih berlaku (status_berlaku == 1) 
				untuk menghindari mengambil data lalu yg salah
				*/
				$data['data_lalu']         = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru']         = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_situ']       = $this->m_bidang_situ->get_all();
				break;

			case 'situ_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu']         = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru']         = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_situ']       = $this->m_bidang_situ->get_all();
				break;

			case 'sia_perpanjangan':
				// $data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				// $data['bidang_situ'] = $this->m_bidang_situ->get_all();
				break;

			case 'tdi_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				// $data['bidang_situ'] = $this->m_bidang_situ->get_all();
				break;

			case 'imb_baru':
				
				$data['agenda']    = $this->m_imb->get_where_no_daftar($no_daftar);
				$data['koif_luas']            = $this->m_koif_luas->get_all();
				$data['koif_tingkat']         = $this->m_koif_tingkat->get_all();
				$data['koif_guna']            = $this->m_koif_guna->get_all();
				$data['harga_dasar_bangunan'] = $this->m_harga_dasar_bangunan->get_all();
				$data['jenis_bangunan'] = $this->m_jenis_bangunan->get_all();
				$data['kepemilikan_tanah'] = $this->m_kepemilikan_tanah->get_all();
				break;

			case 'ho_baru':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['agenda']    = $this->m_ho->get_where_no_daftar($no_daftar);
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				break;

			case 'ho_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				break;

			case 'ho_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				break;
			
			case 'siujk_baru':
				$data['agenda']      = $this->m_siujk->get_where_no_daftar($no_daftar);
				$data['bidang_siujk'] = $this->m_bidang_siujk->get_all();
				break;

			case 'siujk_perpanjangan':
				// $data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_siujk'] = $this->m_bidang_siujk->get_all();
				break;

			case 'siujk_perubahan':
				// $data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_siujk'] = $this->m_bidang_siujk->get_all();
				break;

			case 'siuk_baru':
				$data['agenda']      = $this->m_siuk->get_where_no_daftar($no_daftar);
				
				break;

			case 'siuk_perpanjangan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_siuk'] = $this->m_bidang_siuk->get_all();
				break;

			case 'siuk_perubahan':
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				$data['data_baru'] = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				$data['bidang_siuk'] = $this->m_bidang_siuk->get_all();
				break;

			case 'tdi_baru':
				$data['agenda']      = $this->m_tdi->get_where_no_daftar($no_daftar);
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				break;

			case 'sipl_baru':
				$data['agenda']      = $this->m_sipl->get_where_no_daftar($no_daftar);
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				break;

			case 'sisbw_baru':
				$data['agenda']      = $this->m_sisbw->get_where_no_daftar($no_daftar);
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				break;

			case 'siuakb_baru':
				$data['agenda']      = $this->m_siuakb->get_where_no_daftar($no_daftar);
				
				break;

			case 'sib_baru':
				$data['agenda']      = $this->m_sib->get_where_no_daftar($no_daftar);
				$data['bidang_sib'] = $this->m_bidang_sib->get_all();
				break;

			case 'sipd_baru':
				$data['agenda']      = $this->m_sipd->get_where_no_daftar($no_daftar);
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->ge20okt_all();
				break;

			case 'sipb_baru':
				$data['agenda']      = $this->m_sipb->get_where_no_daftar($no_daftar);
				break;

			case 'sikb_baru':
				$data['agenda']      = $this->m_sikb->get_where_no_daftar($no_daftar);
				break;



			case 'sikp_baru':
				$data['agenda']      = $this->m_sikp->get_where_no_daftar($no_daftar);
				break;

			case 'sipp_baru':
				$data['agenda']      = $this->m_sipp->get_where_no_daftar($no_daftar);
				break;

			case 'sipo_baru':
				$data['agenda']      = $this->m_sipo->get_where_no_daftar($no_daftar);
				break;
			
			case 'sipo_perpanjangan':
				$data['data_lalu']         = $this->$data['nama_model']->get_where_no_sk_2($data['fo']->$var_no_sk_lalu);
				$data['data_baru']         = $this->$data['nama_model']->get_where_no_daftar($no_daftar);
				break;

			case 'sia_baru':
				$data['agenda']      = $this->m_sia->get_where_no_daftar($no_daftar);
				break;

			case 'sik_baru':
				$data['agenda']      = $this->m_sik->get_where_no_daftar($no_daftar);
				break;

			case 'siot_baru':
				$data['agenda']      = $this->m_siot->get_where_no_daftar($no_daftar);
				break;

			case 'sios_baru':
				$data['agenda']      = $this->m_sios->get_where_no_daftar($no_daftar);
				break;

			case 'sipi_baru':
				$data['agenda']    = $this->m_sipi->get_where_no_daftar($no_daftar);
				$data['jenis_alat_tangkap'] = $this->m_jenis_alat_tangkap->get_all();
				break;
			
			default:
				// $data['data_lalu'] = $this->$data['nama_model']->get_where_no_sk($data['fo']->$var_no_sk_lalu);
				break;
		}

		if($this->input->post('simpan')){

			switch ($data['nama_sub_modul']) {


				case 'situ_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_situ', array(
						'ket'                  => 'B',
						'guna'                 => 'BARU',
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'npwpd_npwrd'          => $this->input->post('npwpd_npwrd'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'panjang_tempat_usaha' => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'   => $this->input->post('lebar_tempat_usaha'),
						'nama_bidang_situ'       => $this->input->post('nama_bidang_situ'),
						'klasifikasi'          => $this->input->post('klasifikasi'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'situ_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_situ', array(
						'ket'                  => 'P',
						'guna'                 => 'PERPANJANGAN',
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'npwpd_npwrd'          => $this->input->post('npwpd_npwrd'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'panjang_tempat_usaha' => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'   => $this->input->post('lebar_tempat_usaha'),
						'nama_bidang_situ'     => $this->input->post('nama_bidang_situ'),
						'klasifikasi'          => $this->input->post('klasifikasi'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'situ_perubahan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_situ', array(
						'ket'                  => 'PR',
						'guna'                 => 'PERUBAHAN',
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'npwpd_npwrd'          => $this->input->post('npwpd_npwrd'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'panjang_tempat_usaha' => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'   => $this->input->post('lebar_tempat_usaha'),
						'nama_bidang_situ'       => $this->input->post('nama_bidang_situ'),
						'klasifikasi'          => $this->input->post('klasifikasi'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siup_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siup', array(
						'alasan_penerbitan'          => 'PB',
						'ket'                        => 'PB',
						'guna'                       => 'BARU',
						'nama_perusahaan'            => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'       => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'          => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'          => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'          => $this->input->post('id_kel_perusahaan'),
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'             => $this->input->post('no_ktp_pemilik'),
						'jabatan_pemilik'            => $this->input->post('jabatan_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'tenaga_kerja_a'             => $this->input->post('tenaga_kerja_a'),
						'tenaga_kerja_b'             => $this->input->post('tenaga_kerja_b'),
						'tenaga_kerja_c'             => $this->input->post('tenaga_kerja_c'),
						'tenaga_kerja_d'             => $this->input->post('tenaga_kerja_d'),
						'no_telp'                    => $this->input->post('no_telp'),
						'no_fax'                     => $this->input->post('no_fax'),
						'modal_perusahaan'           => $this->input->post('modal_perusahaan'),
						'id_kelembagaan'             => $this->input->post('id_kelembagaan'),
						'barang_jasa_dagangan_utama' => $this->input->post('barang_jasa_dagangan_utama'),
						'status_berlaku'             => 1,
						'pembaharuan_ke'             => 0

					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siup_perpanjangan':

					if($data['fo']->siup_perpanjangan_status_perubahan){
						if($data['fo']->siup_perpanjangan_alasan_penerbitan == 'PS'){
							$ket = $this->input->post('ket_lalu').' - '.$this->input->post('ket');
						}elseif($data['fo']->siup_perpanjangan_alasan_penerbitan == 'PL'){
							$ket = 'P'. (romawi($data['data_lalu']->pembaharuan_ke + 1));
						}
					}else{
						$ket = 'P'. (romawi($data['data_lalu']->pembaharuan_ke + 1));
					}

					/*
					jika perubahan nya adalah perubahan status, maka pembaharuan_ke kembali jadi 0
					*/
					if($data['fo']->siup_perpanjangan_status_perubahan){
						if($data['fo']->siup_perpanjangan_alasan_penerbitan == 'PS'){
							$pembaharuan_ke = 0;
						}else{
							$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
						}
					}else{
						$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
					}

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siup', array(
						'alasan_penerbitan'          => $data['fo']->siup_perpanjangan_alasan_penerbitan,
						'ket'                        => $ket,
						'guna'                       => 'PERPANJANGAN',
						'nama_perusahaan'            => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'       => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'          => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'          => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'          => $this->input->post('id_kel_perusahaan'),
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'             => $this->input->post('no_ktp_pemilik'),
						'jabatan_pemilik'            => $this->input->post('jabatan_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'tenaga_kerja_a'             => $this->input->post('tenaga_kerja_a'),
						'tenaga_kerja_b'             => $this->input->post('tenaga_kerja_b'),
						'tenaga_kerja_c'             => $this->input->post('tenaga_kerja_c'),
						'tenaga_kerja_d'             => $this->input->post('tenaga_kerja_d'),
						'no_telp'                    => $this->input->post('no_telp'),
						'no_fax'                     => $this->input->post('no_fax'),
						'modal_perusahaan'           => $this->input->post('modal_perusahaan'),
						'id_kelembagaan'             => $this->input->post('id_kelembagaan'),
						'barang_jasa_dagangan_utama' => $this->input->post('barang_jasa_dagangan_utama'),
						'no_sk_lalu'                 => $this->input->post('no_sk_lalu'),
						'status_berlaku'             => 1,
						'pembaharuan_ke'             => $pembaharuan_ke

					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}

					break;

				case 'siup_perubahan':

					
					if($data['fo']->siup_perubahan_alasan_penerbitan == 'PS'){
						$ket = $this->input->post('ket_lalu').' - '.$this->input->post('ket');
					}elseif($data['fo']->siup_perubahan_alasan_penerbitan == 'PL'){
						$ket = 'P'. (romawi($data['data_lalu']->pembaharuan_ke + 1));
					}


					if($data['fo']->siup_perubahan_status_perubahan){
						if($data['fo']->siup_perubahan_alasan_penerbitan == 'PS'){
							$pembaharuan_ke = 0;
						}else{
							$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke;
						}
					}else{
						$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke;
					}
				

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siup', array('alasan_penerbitan'          => $data['fo']->siup_perubahan_alasan_penerbitan,
						'ket'                        => $ket,
						'guna'                       => 'PERUBAHAN',
						'nama_perusahaan'            => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'       => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'          => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'          => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'          => $this->input->post('id_kel_perusahaan'),
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'             => $this->input->post('no_ktp_pemilik'),
						'jabatan_pemilik'            => $this->input->post('jabatan_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'tenaga_kerja_a'             => $this->input->post('tenaga_kerja_a'),
						'tenaga_kerja_b'             => $this->input->post('tenaga_kerja_b'),
						'tenaga_kerja_c'             => $this->input->post('tenaga_kerja_c'),
						'tenaga_kerja_d'             => $this->input->post('tenaga_kerja_d'),
						'no_telp'                    => $this->input->post('no_telp'),
						'no_fax'                     => $this->input->post('no_fax'),
						'modal_perusahaan'           => $this->input->post('modal_perusahaan'),
						'id_kelembagaan'             => $this->input->post('id_kelembagaan'),
						'barang_jasa_dagangan_utama' => $this->input->post('barang_jasa_dagangan_utama'),
						'no_sk_lalu'                 => $this->input->post('no_sk_lalu'),
						'status_berlaku'             => 1,
						'pembaharuan_ke'             => $pembaharuan_ke
					));

					

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}

					break;

				case 'tdp_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdp', array(
						
						'alasan_penerbitan'    => 'PB',
						'ket'                  => 'PB',
						'guna'                 => 'BARU',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'status_perusahaan'    => $this->input->post('status_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'       => $this->input->post('no_ktp_pemilik'),
						'npwp'                 => $this->input->post('npwp'),
						'no_telp'              => $this->input->post('no_telp'),
						'no_fax'               => $this->input->post('no_fax'),
						'no_akte_notaris'      => $this->input->post('no_akte_notaris'),
						'status_berlaku'       => 1,
						'pembaharuan_ke'     => 0
					));

					

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8); // status_proses = sudah_entry
						redirect('c_operator');
					}

					break;

				case 'tdp_perpanjangan':

					if($data['fo']->tdp_perpanjangan_status_perubahan){
						if($data['fo']->tdp_perpanjangan_alasan_penerbitan == 'PS'){
							$ket = $this->input->post('ket_lalu').' - '.$this->input->post('ket');
						}elseif($data['fo']->tdp_perpanjangan_alasan_penerbitan == 'PL'){
							$ket = 'P'. (romawi($data['data_lalu']->pembaharuan_ke + 1));
						}
					}else{
						$ket = 'P'. (romawi($data['data_lalu']->pembaharuan_ke + 1));
					}

					/*
					jika perubahan nya adalah perubahan status, maka pembaharuan_ke kembali jadi 0
					*/
					if($data['fo']->tdp_perpanjangan_status_perubahan){
						if($data['fo']->tdp_perpanjangan_alasan_penerbitan == 'PS'){
							$pembaharuan_ke = 0;
						}else{
							$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
						}
					}else{
						$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke + 1;
					}

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdp', array(
						
						
						'alasan_penerbitan'    => $data['fo']->tdp_perpanjangan_alasan_penerbitan,
						'ket'                  => $ket,
						'guna'                 => 'PERPANJANGAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'status_perusahaan'    => $this->input->post('status_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'       => $this->input->post('no_ktp_pemilik'),
						'npwp'                 => $this->input->post('npwp'),
						'no_telp'              => $this->input->post('no_telp'),
						'no_fax'               => $this->input->post('no_fax'),
						'no_akte_notaris'      => $this->input->post('no_akte_notaris'),
						'status_berlaku'       => 1,
						'pembaharuan_ke'       => $pembaharuan_ke
					));


					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}

					break;

				case 'tdp_perubahan':

					
					if($data['fo']->tdp_perubahan_alasan_penerbitan == 'PS'){
						$ket = $this->input->post('ket_status_modal').' - '.$this->input->post('ket_status_modal_baru');
					}elseif($data['fo']->tdp_perubahan_alasan_penerbitan == 'PL'){
						$ket = 'P'. romawi($data['data_lalu']->pembaharuan_ke + 1);
					}

					if($data['fo']->tdp_perubahan_status_perubahan){
						if($data['fo']->tdp_perubahan_alasan_penerbitan == 'PS'){
							$pembaharuan_ke = 0;
						}else{
							$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke;
						}
					}else{
						$pembaharuan_ke = $data['data_lalu']->pembaharuan_ke;
					}
				

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdp', array(
						
						
						'alasan_penerbitan'    => $data['fo']->tdp_perubahan_alasan_penerbitan,
						'ket'                  => $ket,
						'guna'                 => 'PERUBAHAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'status_perusahaan'    => $this->input->post('status_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'       => $this->input->post('no_ktp_pemilik'),
						'npwp'                 => $this->input->post('npwp'),
						'no_telp'              => $this->input->post('no_telp'),
						'no_fax'               => $this->input->post('no_fax'),
						'no_akte_notaris'      => $this->input->post('no_akte_notaris'),
						'status_berlaku'       => 1,
						'pembaharuan_ke'       => $pembaharuan_ke
					));

					
					

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}

					break;

				case 'imb_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_imb', array(


						'guna'                        => 'BARU',
						'nama_pemilik'                => $this->input->post('nama_pemilik'),
						
						'alamat_pemilik'              => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'              => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'              => $this->input->post('id_kel_pemilik'),
						
						'alamat_bangunan'             => $this->input->post('alamat_bangunan'),
						'id_kec_bangunan'             => $this->input->post('id_kec_bangunan'),
						'id_kel_bangunan'             => $this->input->post('id_kel_bangunan'),
						
						'id_jenis_bangunan'           => $this->input->post('id_jenis_bangunan'),
						'id_hak_kepemilikan'          => $this->input->post('id_hak_kepemilikan'),
						'luas_bangunan'               => $this->input->post('luas_bangunan'),
						'id_koif_luas'                => $this->input->post('id_koif_luas'),
						'id_koif_tingkat'             => $this->input->post('id_koif_tingkat'),
						'id_koif_guna'                => $this->input->post('id_koif_guna'),
						'id_harga_dasar'              => $this->input->post('id_harga_dasar'),
						
						'nilai_retribusi'             => $this->input->post('nilai_retribusi'),
						
						'no_sertifikat_tanah'         => $this->input->post('no_sertifikat_tanah'),
						'tanggal_peninjauan_lapangan' => $this->input->post('tanggal_peninjauan_lapangan'),
						'tanggal_daftar'              => $this->input->post('tanggal_daftar'),
						'tanggal_terbit'              => $this->input->post('tanggal_terbit'),
						'status_berlaku'              => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'ho_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_ho', array(


						'guna'                                => 'BARU',
						'nama_pemilik'                        => $this->input->post('nama_pemilik'),
						'jenis_kelamin_pemilik'               => $this->input->post('jenis_kelamin_pemilik'),
						'pekerjaan_pemilik'                   => $this->input->post('pekerjaan_pemilik'),
						'alamat_pemilik'                      => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'                      => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'                      => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'                     => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'                => $this->input->post('id_bentuk_perusahaan'),
						'nama_bidang_usaha'                   => $this->input->post('nama_bidang_usaha'),
						'alamat_perusahaan'                   => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'                   => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'                   => $this->input->post('id_kel_perusahaan'),
						'npwpd_npwrd'                         => $this->input->post('npwpd_npwrd'),
						'status_kepemilikan_tanah'            => $this->input->post('status_kepemilikan_tanah'),
						'batas_utara'                         => $this->input->post('batas_utara'),
						'batas_selatan'                       => $this->input->post('batas_selatan'),
						'batas_timur'                         => $this->input->post('batas_timur'),
						'batas_barat'                         => $this->input->post('batas_barat'),
						'tinggi_tower'                        => $this->input->post('tinggi_tower'),
						'ket_luas_tempat_usaha'               => $this->input->post('ket_luas_tempat_usaha'),
						'panjang_tempat_usaha'                => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'                  => $this->input->post('lebar_tempat_usaha'),
						'kode_index_luas'                     => $this->input->post('kode_index_luas'),
						'kode_index_gangguan'                 => $this->input->post('kode_index_gangguan'),
						'kode_index_lokasi'                   => $this->input->post('kode_index_lokasi'),
						'kode_index_harga_dasar'              => $this->input->post('kode_index_harga_dasar'),
						'nilai_retribusi'                     => $this->input->post('nilai_retribusi'),
						'mesin_penggerak'                     => $this->input->post('mesin_penggerak'),
						'bahan_bakar'                         => $this->input->post('bahan_bakar'),
						'pembangkit_listrik'                  => $this->input->post('pembangkit_listrik'),
						'no_surat_ket_usaha'                  => $this->input->post('no_surat_ket_usaha'),
						'tanggal_surat_pernyataan_lingkungan' => $this->input->post('tanggal_surat_pernyataan_lingkungan'),
						'tanggal_permohonan'                  => $this->input->post('tanggal_permohonan'),
						'tanggal_surat_ket_usaha'             => $this->input->post('tanggal_surat_ket_usaha'),
						'tanggal_peninjauan_lapangan'         => $this->input->post('tanggal_peninjauan_lapangan'),
						'status_berlaku'                      => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'ho_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_ho', array(


						'guna'                                => 'PERPANJANGAN',
						'nama_pemilik'                        => $this->input->post('nama_pemilik'),
						'jenis_kelamin_pemilik'               => $this->input->post('jenis_kelamin_pemilik'),
						'pekerjaan_pemilik'                   => $this->input->post('pekerjaan_pemilik'),
						'alamat_pemilik'                      => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'                      => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'                      => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'                     => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'                => $this->input->post('id_bentuk_perusahaan'),
						'nama_bidang_usaha'                   => $this->input->post('nama_bidang_usaha'),
						'alamat_perusahaan'                   => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'                   => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'                   => $this->input->post('id_kel_perusahaan'),
						'npwpd_npwrd'                         => $this->input->post('npwpd_npwrd'),
						'status_kepemilikan_tanah'            => $this->input->post('status_kepemilikan_tanah'),
						'batas_utara'                         => $this->input->post('batas_utara'),
						'batas_selatan'                       => $this->input->post('batas_selatan'),
						'batas_timur'                         => $this->input->post('batas_timur'),
						'batas_barat'                         => $this->input->post('batas_barat'),
						'tinggi_tower'                        => $this->input->post('tinggi_tower'),
						'ket_luas_tempat_usaha'               => $this->input->post('ket_luas_tempat_usaha'),
						'panjang_tempat_usaha'                => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'                  => $this->input->post('lebar_tempat_usaha'),
						'kode_index_luas'                     => $this->input->post('kode_index_luas'),
						'kode_index_gangguan'                 => $this->input->post('kode_index_gangguan'),
						'kode_index_lokasi'                   => $this->input->post('kode_index_lokasi'),
						'kode_index_harga_dasar'              => $this->input->post('kode_index_harga_dasar'),
						'nilai_retribusi'                     => $this->input->post('nilai_retribusi'),
						'mesin_penggerak'                     => $this->input->post('mesin_penggerak'),
						'bahan_bakar'                         => $this->input->post('bahan_bakar'),
						'pembangkit_listrik'                  => $this->input->post('pembangkit_listrik'),
						'no_surat_ket_usaha'                  => $this->input->post('no_surat_ket_usaha'),
						'tanggal_surat_pernyataan_lingkungan' => $this->input->post('tanggal_surat_pernyataan_lingkungan'),
						'tanggal_permohonan'                  => $this->input->post('tanggal_permohonan'),
						'tanggal_surat_ket_usaha'             => $this->input->post('tanggal_surat_ket_usaha'),
						'tanggal_peninjauan_lapangan'         => $this->input->post('tanggal_peninjauan_lapangan'),
						'status_berlaku'                      => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'ho_perubahan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_ho', array(

						'guna'                                => 'PERUBAHAN',
						'nama_pemilik'                        => $this->input->post('nama_pemilik'),
						'jenis_kelamin_pemilik'               => $this->input->post('jenis_kelamin_pemilik'),
						'pekerjaan_pemilik'                   => $this->input->post('pekerjaan_pemilik'),
						'alamat_pemilik'                      => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'                      => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'                      => $this->input->post('id_kel_pemilik'),
						'nama_perusahaan'                     => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'                => $this->input->post('id_bentuk_perusahaan'),
						'nama_bidang_usaha'                   => $this->input->post('nama_bidang_usaha'),
						'alamat_perusahaan'                   => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'                   => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'                   => $this->input->post('id_kel_perusahaan'),
						'npwpd_npwrd'                         => $this->input->post('npwpd_npwrd'),
						'status_kepemilikan_tanah'            => $this->input->post('status_kepemilikan_tanah'),
						'batas_utara'                         => $this->input->post('batas_utara'),
						'batas_selatan'                       => $this->input->post('batas_selatan'),
						'batas_timur'                         => $this->input->post('batas_timur'),
						'batas_barat'                         => $this->input->post('batas_barat'),
						'tinggi_tower'                        => $this->input->post('tinggi_tower'),
						'ket_luas_tempat_usaha'               => $this->input->post('ket_luas_tempat_usaha'),
						'panjang_tempat_usaha'                => $this->input->post('panjang_tempat_usaha'),
						'lebar_tempat_usaha'                  => $this->input->post('lebar_tempat_usaha'),
						'kode_index_luas'                     => $this->input->post('kode_index_luas'),
						'kode_index_gangguan'                 => $this->input->post('kode_index_gangguan'),
						'kode_index_lokasi'                   => $this->input->post('kode_index_lokasi'),
						'kode_index_harga_dasar'              => $this->input->post('kode_index_harga_dasar'),
						'nilai_retribusi'                     => $this->input->post('nilai_retribusi'),
						'mesin_penggerak'                     => $this->input->post('mesin_penggerak'),
						'bahan_bakar'                         => $this->input->post('bahan_bakar'),
						'pembangkit_listrik'                  => $this->input->post('pembangkit_listrik'),
						'no_surat_ket_usaha'                  => $this->input->post('no_surat_ket_usaha'),
						'tanggal_surat_pernyataan_lingkungan' => $this->input->post('tanggal_surat_pernyataan_lingkungan'),
						'tanggal_permohonan'                  => $this->input->post('tanggal_permohonan'),
						'tanggal_surat_ket_usaha'             => $this->input->post('tanggal_surat_ket_usaha'),
						'tanggal_peninjauan_lapangan'         => $this->input->post('tanggal_peninjauan_lapangan'),
						'status_berlaku'                      => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;
				
				case 'siujk_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siujk', array(
						'ket'               => 'B',
						'guna'              => 'BARU',
						'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
						'kualifikasi'       => $this->input->post('kualifikasi'),
						'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						'rt_perusahaan'     => $this->input->post('rt_perusahaan'),
						'rw_perusahaan'     => $this->input->post('rw_perusahaan'),
						'id_kec_perusahaan' => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan' => $this->input->post('id_kel_perusahaan'),
						'kode_pos'          => $this->input->post('kode_pos'),
						'no_telp'           => $this->input->post('no_telp'),
						'no_fax'            => $this->input->post('no_fax'),
						'nama_pemilik'      => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'    => $this->input->post('no_ktp_pemilik'),
						'npwp'              => $this->input->post('npwp'),
						'id_bidang_siujk'   => implode('|', $this->input->post('id_bidang_siujk')),
						'status_berlaku'    => 1
					));

					
					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siujk_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siujk', array(
						'ket'               => 'P',
						'guna'              => 'PERPANJANGAN',
						'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
						'kualifikasi'       => $this->input->post('kualifikasi'),
						'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						'rt_perusahaan'     => $this->input->post('rt_perusahaan'),
						'rw_perusahaan'     => $this->input->post('rw_perusahaan'),
						'id_kec_perusahaan' => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan' => $this->input->post('id_kel_perusahaan'),
						'kode_pos'          => $this->input->post('kode_pos'),
						'no_telp'           => $this->input->post('no_telp'),
						'no_fax'            => $this->input->post('no_fax'),
						'nama_pemilik'      => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'    => $this->input->post('no_ktp_pemilik'),
						'npwp'              => $this->input->post('npwp'),
						'id_bidang_siujk'   => implode('|', $this->input->post('id_bidang_siujk')),
						'status_berlaku'    => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siujk_perubahan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siujk', array(
						'ket'               => 'PR',
						'guna'              => 'PERUBAHAN',
						'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
						'kualifikasi'       => $this->input->post('kualifikasi'),
						'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						'rt_perusahaan'     => $this->input->post('rt_perusahaan'),
						'rw_perusahaan'     => $this->input->post('rw_perusahaan'),
						'id_kec_perusahaan' => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan' => $this->input->post('id_kel_perusahaan'),
						'kode_pos'          => $this->input->post('kode_pos'),
						'no_telp'           => $this->input->post('no_telp'),
						'no_fax'            => $this->input->post('no_fax'),
						'nama_pemilik'      => $this->input->post('nama_pemilik'),
						'no_ktp_pemilik'    => $this->input->post('no_ktp_pemilik'),
						'npwp'              => $this->input->post('npwp'),
						'id_bidang_siujk'   => implode('|', $this->input->post('id_bidang_siujk')),
						'status_berlaku'    => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siuk_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siuk', array(

						
						'ket'                  => 'B',
						'guna'                 => 'BARU',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_bidang_usaha'       => $this->input->post('nama_bidang_usaha'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siuk_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siuk', array(

						
						'ket'                  => 'P',
						'guna'                 => 'PERPANJANGAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_bidang_usaha'       => $this->input->post('nama_bidang_usaha'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siuk_perubahan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siuk', array(

						
						'ket'                  => 'PR',
						'guna'                 => 'PERUBAHAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'no_telp'              => $this->input->post('no_telp'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'nama_bidang_usaha'       => $this->input->post('nama_bidang_usaha'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'tdi_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdi', array(

						
						'ket'                  => 'B',
						'guna'                 => 'BARU',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'nipik'                => $this->input->post('nipik'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'komoditi_industri'    => $this->input->post('komoditi_industri'),
						'alamat_pabrik'        => $this->input->post('alamat_pabrik'),
						'id_kec_pabrik'        => $this->input->post('id_kec_pabrik'),
						'id_kel_pabrik'        => $this->input->post('id_kel_pabrik'),
						'mesin_utama'          => $this->input->post('mesin_utama'),
						'mesin_pembantu'       => $this->input->post('mesin_pembantu'),						
						'tenaga_penggerak'     => $this->input->post('tenaga_penggerak'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'kapasitas_produksi'   => $this->input->post('kapasitas_produksi'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'tdi_perubahan':

					

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_tdi', array(

						
						'ket'                  => 'PR',
						'guna'                 => 'PERUBAHAN',
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'npwp'                 => $this->input->post('npwp'),
						'nipik'                => $this->input->post('nipik'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_pemilik'       => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'       => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'       => $this->input->post('id_kel_pemilik'),
						'komoditi_industri'    => $this->input->post('komoditi_industri'),
						'alamat_pabrik'        => $this->input->post('alamat_pabrik'),
						'id_kec_pabrik'        => $this->input->post('id_kec_pabrik'),
						'id_kel_pabrik'        => $this->input->post('id_kel_pabrik'),
						'mesin_utama'          => $this->input->post('mesin_utama'),
						'mesin_pembantu'       => $this->input->post('mesin_pembantu'),						
						'tenaga_penggerak'     => $this->input->post('tenaga_penggerak'),
						'nilai_investasi'      => $this->input->post('nilai_investasi'),
						'kapasitas_produksi'   => $this->input->post('kapasitas_produksi'),
						'no_sk_lalu'           => $this->input->post('no_sk_lalu'),
						'status_berlaku'       => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						$this->m_tdi->set_status_berlaku($data['data_lalu']->no_daftar, 0);
						redirect('c_operator');
					}
					break;

				case 'sipl_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipl', array(

						
						'ket'                       => 'B',
						'guna'                      => 'BARU',
						'nama_pemilik'              => $this->input->post('nama_pemilik'),
						'nama_perusahaan'           => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan'      => $this->input->post('id_bentuk_perusahaan'),
						'alamat_perusahaan'         => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'         => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'         => $this->input->post('id_kel_perusahaan'),
						'jenis_limbah'              => $this->input->post('jenis_limbah'),
						'jumlah_ton'                => $this->input->post('jumlah_ton'),
						'alamat_penyimpanan'        => $this->input->post('alamat_penyimpanan'),
						'id_kel_penyimpanan'        => $this->input->post('id_kel_penyimpanan'),
						'id_kec_penyimpanan'        => $this->input->post('id_kec_penyimpanan'),
						'maksud_penyimpanan'        => $this->input->post('maksud_penyimpanan'),
						'waktu_keberangkatan'       => $this->input->post('waktu_keberangkatan'),
						'dipindahkan_kepada'        => $this->input->post('dipindahkan_kepada'),
						'alamat_pindah'             => $this->input->post('alamat_pindah'),
						'jumlah_ton_pindah'         => $this->input->post('jumlah_ton_pindah'),
						'kendaraan_angkutan'        => $this->input->post('kendaraan_angkutan'),
						'nopol_kendaraan'           => $this->input->post('nopol_kendaraan'),
						'lokasi_penyimpanan_pindah' => $this->input->post('lokasi_penyimpanan_pindah'),
						'maksud_penyimpanan_pindah' => $this->input->post('maksud_penyimpanan_pindah'),
						'keterangan_barang'         => implode('|', $this->input->post('keterangan_barang')),
						'status_berlaku'            => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sisbw_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sisbw', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',
						'nama_pemilik'   => $this->input->post('nama_pemilik'),
						
						'alamat_pemilik' => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik' => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik' => $this->input->post('id_kel_pemilik'),
						
						'npwpd_npwrd'    => $this->input->post('npwpd_npwrd'),
						'alamat_usaha'   => $this->input->post('alamat_usaha'),
						'id_kec_usaha'   => $this->input->post('id_kec_usaha'),
						'id_kel_usaha'   => $this->input->post('id_kel_usaha'),
						
						'no_telp'        => $this->input->post('no_telp'),
						'klasifikasi'    => $this->input->post('klasifikasi'),
						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siuakb_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siuakb', array(

						
						'ket'               => 'B',
						'guna'              => 'BARU',
						'nama_pemilik'      => $this->input->post('nama_pemilik'),
						'alamat_pemilik'    => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'    => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'    => $this->input->post('id_kel_pemilik'),
						
						'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
						'jenis_usaha'       => $this->input->post('jenis_usaha'),
						
						'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan' => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan' => $this->input->post('id_kel_pemilik'),
						
						'npwp'              => $this->input->post('npwp'),
						'npwpd_npwrd'       => $this->input->post('npwpd_npwrd'),
						'jumlah_kendaraan'  => $this->input->post('jumlah_kendaraan'),
						'jenis_usaha'       => $this->input->post('jenis_usaha'),
						
						'status_berlaku'    => 1



					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sib_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sib', array(

						'alasan_penerbitan'          => 'PB',
						'ket'                        => 'PB',
						'guna'                       => 'BARU',
                        
						'nama_perusahaan'            => $this->input->post('nama_perusahaan'),
						'merek_perusahaan'           => $this->input->post('merek_perusahaan'),
						'alamat_perusahaan'          => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'          => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'          => $this->input->post('id_kel_perusahaan'),
						'no_telp'                    => $this->input->post('no_telp'),
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'npwpd'                      => $this->input->post('npwpd'),
						'modal'                      => $this->input->post('modal'),
						
						'kelembagaan'                => $this->input->post('kelembagaan'),
						'id_bidang_sib'              => $this->input->post('id_bidang_sib'),
						'barang_jasa_dagangan_utama' => $this->input->post('barang_jasa_dagangan_utama'),
						
						
						

						'status_berlaku'             => 1,
						'pembaharuan_ke'             => 0

					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipd_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipd', array(

						
						'ket'                  => 'PB',
						'guna'                 => 'BARU',
						
						'nama_perusahaan'      => $this->input->post('nama_perusahaan'),
						'id_bentuk_perusahaan' => $this->input->post('id_bentuk_perusahaan'),
						'nama_pemilik'         => $this->input->post('nama_pemilik'),
						'alamat_perusahaan'    => $this->input->post('alamat_perusahaan'),
						'id_kec_perusahaan'    => $this->input->post('id_kec_perusahaan'),
						'id_kel_perusahaan'    => $this->input->post('id_kel_perusahaan'),
						'jenis_bahan'          => $this->input->post('jenis_bahan'),
						'alamat_lokasi'        => $this->input->post('alamat_lokasi'),
						'id_kec_lokasi'        => $this->input->post('id_kec_lokasi'),
						'id_kel_lokasi'        => $this->input->post('id_kel_lokasi'),
						'luas_wilayah'         => $this->input->post('luas_wilayah'),
						'batas_utara'          => $this->input->post('batas_utara'),
						'batas_selatan'        => $this->input->post('batas_selatan'),
						'batas_timur'          => $this->input->post('batas_timur'),
						'batas_barat'          => $this->input->post('batas_barat'),
						
						'koordinat_n'             => implode('|', $this->input->post('koordinat_n')),
                		'koordinat_e'             => implode('|', $this->input->post('koordinat_e')),
						
						'status_berlaku'       => 1,
						

					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipb_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipb', array(

						
						'ket'                      => 'B',
						'guna'                     => 'BARU',
						
						'nama_pemilik'             => $this->input->post('nama_pemilik'),
						'alamat_pemilik'           => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'           => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'           => $this->input->post('id_kel_pemilik'),
						'nama_tempat_praktek'      => $this->input->post('nama_tempat_praktek'),
						'no_surat_tanda_reg_bidan' => $this->input->post('no_surat_tanda_reg_bidan'),
						'alamat_tempat_praktek'    => $this->input->post('alamat_tempat_praktek'),
						'id_kec_tempat_praktek'    => $this->input->post('id_kec_tempat_praktek'),
						'id_kel_tempat_praktek'    => $this->input->post('id_kel_tempat_praktek'),
						'status_berlaku'           => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				

				case 'sikp_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sikp', array(

						
						'ket'                        => 'B',
						'guna'                       => 'BARU',
						
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'tempat_lahir'               => $this->input->post('tempat_lahir'),
						'tanggal_lahir'              => $this->input->post('tanggal_lahir'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'nama_tempat_kerja'          => $this->input->post('nama_tempat_kerja'),
						'no_sib_str' 				 => $this->input->post('no_sib_str'),
						'alamat_tempat_kerja'        => $this->input->post('alamat_tempat_kerja'),
						'id_kec_tempat_kerja'        => $this->input->post('id_kec_tempat_kerja'),
						'id_kel_tempat_kerja'        => $this->input->post('id_kel_tempat_kerja'),
						'status_berlaku'             => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sikb_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sikb', array(

						
						'ket'                        => 'B',
						'guna'                       => 'BARU',
						
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'tempat_lahir'               => $this->input->post('tempat_lahir'),
						'tanggal_lahir'              => $this->input->post('tanggal_lahir'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'nama_tempat_kerja'          => $this->input->post('nama_tempat_kerja'),
						'no_sib_str' 				 => $this->input->post('no_sib_str'),
						'alamat_tempat_kerja'        => $this->input->post('alamat_tempat_kerja'),
						'id_kec_tempat_kerja'        => $this->input->post('id_kec_tempat_kerja'),
						'id_kel_tempat_kerja'        => $this->input->post('id_kel_tempat_kerja'),
						'status_berlaku'             => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipp_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipp', array(

						
						'ket'                        => 'B',
						'guna'                       => 'BARU',
						
						'nama_pemilik'               => $this->input->post('nama_pemilik'),
						'alamat_pemilik'             => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'             => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'             => $this->input->post('id_kel_pemilik'),
						'nama_tempat_praktek'        => $this->input->post('nama_tempat_praktek'),
						'no_surat_tanda_reg_perawat' => $this->input->post('no_surat_tanda_reg_perawat'),
						'alamat_tempat_praktek'      => $this->input->post('alamat_tempat_praktek'),
						'id_kec_tempat_praktek'      => $this->input->post('id_kec_tempat_praktek'),
						'id_kel_tempat_praktek'      => $this->input->post('id_kel_tempat_praktek'),
						'status_berlaku'             => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipo_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipo', array(

						
						'ket'                   => 'B',
						'guna'                  => 'BARU',
						
						'nama_pemilik'          => $this->input->post('nama_pemilik'),
						'alamat_pemilik'        => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'        => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'        => $this->input->post('id_kel_pemilik'),
						'no_surat_izin_kerja'   => $this->input->post('no_surat_izin_kerja'),
						
						'nama_optik'            => $this->input->post('nama_optik'),
						'alamat_optik'          => $this->input->post('alamat_optik'),
						'id_kec_optik'          => $this->input->post('id_kec_optik'),
						'id_kel_optik'          => $this->input->post('id_kel_optik'),
						
						'nama_pemilik_sarana'   => $this->input->post('nama_pemilik_sarana'),
						'alamat_pemilik_sarana' => $this->input->post('alamat_pemilik_sarana'),
						'id_kec_pemilik_sarana' => $this->input->post('id_kec_pemilik_sarana'),
						'id_kel_pemilik_sarana' => $this->input->post('id_kel_pemilik_sarana'),

						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipo_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipo', array(
						'ket'            => 'P',
						'guna'           => 'PERPANJANGAN',
						
						'nama_pemilik'   => $this->input->post('nama_pemilik'),
						'alamat_pemilik' => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik' => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik' => $this->input->post('id_kel_pemilik'),
						'nama_optik'     => $this->input->post('nama_optik'),
						
						'alamat_optik'   => $this->input->post('alamat_optik'),
						'id_kec_optik'   => $this->input->post('id_kec_optik'),
						'id_kel_optik'   => $this->input->post('id_kel_optik'),
						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				case 'sia_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sia', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',
						
						'nama_pemilik'                 => $this->input->post('nama_pemilik'),
						'alamat_pemilik'               => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'               => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'               => $this->input->post('id_kel_pemilik'),
						'no_sipa'                      => $this->input->post('no_sipa'),
						'nama_apotek'                  => $this->input->post('nama_apotek'),
						'alamat_apotek'                => $this->input->post('alamat_apotek'),
						'id_kec_apotek'                => $this->input->post('id_kec_apotek'),
						'id_kel_apotek'                => $this->input->post('id_kel_apotek'),
						'nama_pemilik_sarana'          => $this->input->post('nama_pemilik_sarana'),
						'alamat_pemilik_sarana'        => $this->input->post('alamat_pemilik_sarana'),
						'id_kec_pemilik_sarana'        => $this->input->post('id_kec_pemilik_sarana'),
						'id_kel_pemilik_sarana'        => $this->input->post('id_kel_pemilik_sarana'),
						'no_akte_perjanjian'           => $this->input->post('no_akte_perjanjian'),
						'tanggal_akte_perjanjian'      => $this->input->post('tanggal_akte_perjanjian'),
						'nama_notaris_akte_perjanjian' => $this->input->post('nama_notaris_akte_perjanjian'),
						'tempat_akte_perjanjian'       => $this->input->post('tempat_akte_perjanjian'),

						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sia_perpanjangan':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sia', array(

						
						'ket'            => 'P',
						'guna'           => 'PERPANJANGAN',
						
						'nama_pemilik'                 => $this->input->post('nama_pemilik'),
						'alamat_pemilik'               => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'               => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'               => $this->input->post('id_kel_pemilik'),
						'no_sipa'                      => $this->input->post('no_sipa'),
						'nama_apotek'                  => $this->input->post('nama_apotek'),
						'alamat_apotek'                => $this->input->post('alamat_apotek'),
						'id_kec_apotek'                => $this->input->post('id_kec_apotek'),
						'id_kel_apotek'                => $this->input->post('id_kel_apotek'),
						'nama_pemilik_sarana'          => $this->input->post('nama_pemilik_sarana'),
						'alamat_pemilik_sarana'        => $this->input->post('alamat_pemilik_sarana'),
						'id_kec_pemilik_sarana'        => $this->input->post('id_kec_pemilik_sarana'),
						'id_kel_pemilik_sarana'        => $this->input->post('id_kel_pemilik_sarana'),
						'no_akte_perjanjian'           => $this->input->post('no_akte_perjanjian'),
						'tanggal_akte_perjanjian'      => $this->input->post('tanggal_akte_perjanjian'),
						'nama_notaris_akte_perjanjian' => $this->input->post('nama_notaris_akte_perjanjian'),
						'tempat_akte_perjanjian'       => $this->input->post('tempat_akte_perjanjian'),
						'no_sk_lalu'       => $this->input->post('no_sk_lalu'),
						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						$this->m_sia->set_status_berlaku($data['data_lalu']->no_daftar, 0);
						redirect('c_operator');
					}
					break;

				case 'sik_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sik', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',

						'nama_pemilik' => $this->input->post('nama_pemilik'),
						'alamat_pemilik' => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik' => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik' => $this->input->post('id_kel_pemilik'),
						'nama_klinik' => $this->input->post('nama_klinik'),
						'alamat_klinik' => $this->input->post('alamat_klinik'),
						'id_kec_klinik' => $this->input->post('id_kec_klinik'),
						'id_kel_klinik' => $this->input->post('id_kel_klinik'),
						'jasa_pelayanan' => $this->input->post('jasa_pelayanan'),
						'nama_pimpinan' => $this->input->post('nama_pimpinan'),
						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'siot_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_siot', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',

						'no_surat_dirjen_buk'      => $this->input->post('no_surat_dirjen_buk'),
						'tanggal_surat_dirjen_buk' => $this->input->post('tanggal_surat_dirjen_buk'),
						'nama_rumah_sakit'         => $this->input->post('nama_rumah_sakit'),
						'klasifikasi_kelas_menkes' => $this->input->post('klasifikasi_kelas_menkes'),
						'alamat_rumah_sakit'       => $this->input->post('alamat_rumah_sakit'),
						'id_kec_rumah_sakit'       => $this->input->post('id_kec_rumah_sakit'),
						'id_kel_rumah_sakit'       => $this->input->post('id_kel_rumah_sakit'),
						'nama_pemilik'             => $this->input->post('nama_pemilik'),
						'alamat_pemilik'           => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'           => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'           => $this->input->post('id_kel_pemilik'),
						'dokter_penanggung_jawab'  => $this->input->post('dokter_penanggung_jawab'),
						'no_sip_dokter'            => $this->input->post('no_sip_dokter'),
						'tanggal_berlaku_sip'      => $this->input->post('tanggal_berlaku_sip'),


						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sios_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sios', array(

						
						'ket'            => 'B',
						'guna'           => 'BARU',

						
						'nama_rumah_sakit'         => $this->input->post('nama_rumah_sakit'),
						'alamat_rumah_sakit'       => $this->input->post('alamat_rumah_sakit'),
						'id_kec_rumah_sakit'       => $this->input->post('id_kec_rumah_sakit'),
						'id_kel_rumah_sakit'       => $this->input->post('id_kel_rumah_sakit'),
						'nama_pemilik'             => $this->input->post('nama_pemilik'),
						'alamat_pemilik'           => $this->input->post('alamat_pemilik'),
						'id_kec_pemilik'           => $this->input->post('id_kec_pemilik'),
						'id_kel_pemilik'           => $this->input->post('id_kel_pemilik'),
						'dokter_penanggung_jawab'  => $this->input->post('dokter_penanggung_jawab'),
						'no_sip_dokter'            => $this->input->post('no_sip_dokter'),
						'tanggal_berlaku_sip'      => $this->input->post('tanggal_berlaku_sip'),


						'status_berlaku' => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;

				case 'sipi_baru':

					$this->db->where('no_daftar', $no_daftar);
					$simpan = $this->db->update('t_sipi', array(

						
						'ket'                    => 'B',
						'guna'                   => 'BARU',
						
						'nama'                   => $this->input->post('nama'),
						'alamat'                 => $this->input->post('alamat'),
						'id_kec'                 => $this->input->post('id_kec'),
						'id_kel'                 => $this->input->post('id_kel'),
						'no_ktp'                 => $this->input->post('no_ktp'),
						'nama_kapal'             => $this->input->post('nama_kapal'),
						'tempat_reg_kapal'       => $this->input->post('tempat_reg_kapal'),
						'no_reg_kapal'           => $this->input->post('no_reg_kapal'),
						'tempat_gelar_kapal'     => $this->input->post('tempat_gelar_kapal'),
						'nama_panggilan_kapal'   => $this->input->post('nama_panggilan_kapal'),
						'tanda_gelar_kapal'      => $this->input->post('tanda_gelar_kapal'),
						'asal_kapal'             => $this->input->post('asal_kapal'),
						'negara_asal_kapal'      => $this->input->post('negara_asal_kapal'),
						'tempat_pembuatan_kapal' => $this->input->post('tempat_pembuatan_kapal'),
						'jenis_kapal'            => $this->input->post('jenis_kapal'),
						'id_jenis_alat_tangkap'  => $this->input->post('id_jenis_alat_tangkap'),
						'nilai_retribusi'        => $this->input->post('nilai_retribusi'),
						'tonase_kotor'           => $this->input->post('tonase_kotor'),
						'tonase_bersih'          => $this->input->post('tonase_bersih'),
						'kekuatan_mesin'         => $this->input->post('kekuatan_mesin'),
						'merek_mesin'            => $this->input->post('merek_mesin'),
						'no_seri_mesin'          => $this->input->post('no_seri_mesin'),
						'bahan_kasco'            => $this->input->post('bahan_kasco'),
						'no_iup'                 => $this->input->post('no_iup'),
						'tanggal_iup'            => $this->input->post('tanggal_iup'),
						'no_permohonan_iup'      => $this->input->post('no_permohonan_iup'),
						'tanggal_permohonan_iup' => $this->input->post('tanggal_permohonan_iup'),
						'daerah_penangkapan'     => $this->input->post('daerah_penangkapan'),
						'daerah_terlarang'       => $this->input->post('daerah_terlarang'),
						'pelabuhan_penangkalan'  => $this->input->post('pelabuhan_penangkalan'),
						'anak_buah_kapal'        => $this->input->post('anak_buah_kapal'),
						
						'status_berlaku'         => 1
					));

					if($simpan){
						$this->m_fo->set_status_proses($no_daftar, 8);
						redirect('c_operator');
					}
					break;


				
				default:
					# code...
					break;
			}
		}

		$data['kec'] = $this->m_kec->get_all();
		$data['kel'] = $this->m_kel->get_all();

		// untuk tdp
		$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
		$data['bidang_siujk'] = $this->m_bidang_siujk->get_all();

		
		

		$data['form_operator'] = $this->load->view('operator/'. $data['nama_sub_modul'], $data, true);

		


		$this->load->view('templates/top');
        $this->load->view('v_operator_entry', $data);
        $this->load->view('templates/bottom');
	}

	public function batalkan_pengagendaan($no_daftar){

		$redirect_url = 'c_operator/belum';

		if($this->input->get('redirect_url')){
			$redirect_url = $this->input->get('redirect_url');
		}

		$data['id_sub_modul'] = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model'] = 'm_'.explode('_', $data['nama_sub_modul'])[0];
		$data['fo'] = $this->m_fo->get_where_no_daftar($no_daftar);
		
		
		if($this->$data['nama_model']->hapus_where_no_daftar($no_daftar)){
			if($this->m_fo->set_status_proses($no_daftar, 6)){ // 6 : belum penggagendaan	
				
				redirect($redirect_url);
			} 
		}
	}
}