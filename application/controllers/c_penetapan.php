<?php

class C_penetapan extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->belum();
	}

	public function belum(){



		$data['belum'] = $this->m_fo->get_where_status_proses(array(4));

        $this->load->view('templates/top');
        $this->load->view('v_penetapan_belum', $data);
        $this->load->view('templates/bottom');
	}

	public function belum_lunas(){

		$data['belum_lunas'] = $this->m_fo->get_where_status_proses(array(5));

        $this->load->view('templates/top');
        $this->load->view('v_penetapan_belum_lunas', $data);
        $this->load->view('templates/bottom');
	}

	public function sudah_lunas(){

		$data['sudah_lunas'] = $this->m_fo->get_where_status_proses(array(6));

        $this->load->view('templates/top');
        $this->load->view('v_penetapan_sudah_lunas', $data);
        $this->load->view('templates/bottom');
	}

	public function penetapan($no_daftar){

		$data['pesan_kesalahan'] = array();

		$data['id_sub_modul']            = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul']          = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model']              = 'm_'.explode('_', $data['nama_sub_modul'])[0];

		$var_no_sk_lalu = $data['nama_sub_modul'].'_no_sk';
		$data['fo'] = $this->m_fo->get_where_no_daftar($no_daftar);

		/**
		 * switch untuk meng-load data yang dibutuhkan untuk kepentingan Form penetepan
		 */
		switch ($data['nama_sub_modul']) {
			case 'imb_baru':
				$data['koif_luas']            = $this->m_koif_luas->get_all();
				$data['koif_tingkat']         = $this->m_koif_tingkat->get_all();
				$data['koif_guna']            = $this->m_koif_guna->get_all();
				$data['harga_dasar_bangunan'] = $this->m_harga_dasar_bangunan->get_all();
				$data['jenis_bangunan'] = $this->m_jenis_bangunan->get_all();
				$data['kepemilikan_tanah'] = $this->m_kepemilikan_tanah->get_all();
				break;
			case 'ho_baru':
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				break;

			case 'ho_perpanjangan':
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->m_ho->get_where_no_sk($data['fo']->ho_perpanjangan_no_sk);

				break;

			case 'ho_perubahan':
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
				$data['data_lalu'] = $this->m_ho->get_where_no_sk($data['fo']->ho_perubahan_no_sk);

				break;

			case 'sipi_baru':
				$data['jenis_alat_tangkap']    = $this->m_jenis_alat_tangkap->get_all();
				
				break;

			case 'iup_baru':
				$data['bidang_iup']    = $this->m_bidang_iup->get_all();
				
				break;
			
			default:
				# code...
				break;
		}


		/**
		 * switch untuk proses penetapan
		 */
		if($this->input->post('tetapkan')){

			switch ($data['nama_sub_modul']) {

				case 'imb_baru':
					/*echo "<pre>";
					print_r($_POST);
					echo "</pre>";*/

					$data_penetapan['imb_baru_nama_pemilik']                = $this->input->post('imb_baru_nama_pemilik');

					$data_penetapan['imb_baru_alamat_pemilik']             = $this->input->post('imb_baru_alamat_pemilik');
					$data_penetapan['imb_baru_id_kec_pemilik']             = $this->input->post('imb_baru_id_kec_pemilik');
					$data_penetapan['imb_baru_id_kel_pemilik']             = $this->input->post('imb_baru_id_kel_pemilik');
					
					$data_penetapan['imb_baru_alamat_bangunan']             = $this->input->post('imb_baru_alamat_bangunan');
					$data_penetapan['imb_baru_id_kec_bangunan']             = $this->input->post('imb_baru_id_kec_bangunan');
					$data_penetapan['imb_baru_id_kel_bangunan']             = $this->input->post('imb_baru_id_kel_bangunan');
					
					$data_penetapan['imb_baru_id_jenis_bangunan']           = $this->input->post('imb_baru_id_jenis_bangunan');
					$data_penetapan['imb_baru_id_hak_kepemilikan']          = $this->input->post('imb_baru_id_hak_kepemilikan');
					
					$data_penetapan['imb_baru_luas_bangunan']               = $this->input->post('imb_baru_luas_bangunan');
					$data_penetapan['imb_baru_id_koif_luas']                = $this->input->post('imb_baru_id_koif_luas');
					$data_penetapan['imb_baru_id_koif_tingkat']             = $this->input->post('imb_baru_id_koif_tingkat');
					$data_penetapan['imb_baru_id_koif_guna']                = $this->input->post('imb_baru_id_koif_guna');
					$data_penetapan['imb_baru_id_harga_dasar']              = $this->input->post('imb_baru_id_harga_dasar');
					$data_penetapan['imb_baru_nilai_retribusi']             = $this->input->post('imb_baru_nilai_retribusi');
					$data_penetapan['imb_baru_tanggal_peninjauan_lapangan'] = $this->input->post('imb_baru_tanggal_peninjauan_lapangan');

					$this->db->where('no_daftar', $no_daftar);
					$update = $this->db->update('t_fo', $data_penetapan);
					if($update){

						$this->m_fo->set_status_proses($no_daftar, 5);
						redirect('c_penetapan/belum');
						
					}
					break;

				case 'ho_baru':

					$data_penetapan['ho_baru_nama_perusahaan']             = $this->input->post('ho_baru_nama_perusahaan');
					$data_penetapan['ho_baru_nama_pemilik']                = $this->input->post('ho_baru_nama_pemilik');
					$data_penetapan['ho_baru_alamat_perusahaan']           = $this->input->post('ho_baru_alamat_perusahaan');
					$data_penetapan['ho_baru_id_kec_perusahaan']           = $this->input->post('ho_baru_id_kec_perusahaan');
					$data_penetapan['ho_baru_id_kel_perusahaan']           = $this->input->post('ho_baru_id_kel_perusahaan');
					$data_penetapan['ho_baru_id_bentuk_perusahaan']        = $this->input->post('ho_baru_id_bentuk_perusahaan');
					$data_penetapan['ho_baru_tanggal_peninjauan_lapangan'] = $this->input->post('ho_baru_tanggal_peninjauan_lapangan');
					$data_penetapan['ho_baru_nama_bidang_usaha']           = $this->input->post('ho_baru_nama_bidang_usaha');
					$data_penetapan['ho_baru_ket_luas_tempat_usaha']       = implode('|', $this->input->post('ho_baru_ket_luas_tempat_usaha'));
					$data_penetapan['ho_baru_panjang_tempat_usaha']        = implode('|', $this->input->post('ho_baru_panjang_tempat_usaha'));
					$data_penetapan['ho_baru_lebar_tempat_usaha']          = implode('|', $this->input->post('ho_baru_lebar_tempat_usaha'));
					$data_penetapan['ho_baru_kode_index_luas']             = $this->input->post('ho_baru_kode_index_luas');
					$data_penetapan['ho_baru_tinggi_tower']                = $this->input->post('ho_baru_tinggi_tower');
					$data_penetapan['ho_baru_kode_index_lokasi']           = $this->input->post('ho_baru_kode_index_lokasi');
					$data_penetapan['ho_baru_kode_index_gangguan']         = $this->input->post('ho_baru_kode_index_gangguan');
					$data_penetapan['ho_baru_kode_index_harga_dasar']      = $this->input->post('ho_baru_kode_index_harga_dasar');
					$data_penetapan['ho_baru_nilai_retribusi']             = $this->input->post('ho_baru_nilai_retribusi');

					

					$this->db->where('no_daftar', $no_daftar);
					$update = $this->db->update('t_fo', $data_penetapan);
					if($update){

						$this->m_fo->set_status_proses($no_daftar, 5);
						redirect('c_penetapan/belum');
						
					}

					break;


				case 'ho_perpanjangan':

					$data_penetapan['ho_perpanjangan_nama_perusahaan']             = $this->input->post('ho_perpanjangan_nama_perusahaan');
					$data_penetapan['ho_perpanjangan_nama_pemilik']                = $this->input->post('ho_perpanjangan_nama_pemilik');
					$data_penetapan['ho_perpanjangan_alamat_perusahaan']           = $this->input->post('ho_perpanjangan_alamat_perusahaan');
					$data_penetapan['ho_perpanjangan_id_kec_perusahaan']           = $this->input->post('ho_perpanjangan_id_kec_perusahaan');
					$data_penetapan['ho_perpanjangan_id_kel_perusahaan']           = $this->input->post('ho_perpanjangan_id_kel_perusahaan');
					$data_penetapan['ho_perpanjangan_id_bentuk_perusahaan']        = $this->input->post('ho_perpanjangan_id_bentuk_perusahaan');
					$data_penetapan['ho_perpanjangan_tanggal_peninjauan_lapangan'] = $this->input->post('ho_perpanjangan_tanggal_peninjauan_lapangan');
					$data_penetapan['ho_perpanjangan_nama_bidang_usaha']           = $this->input->post('ho_perpanjangan_nama_bidang_usaha');
					$data_penetapan['ho_perpanjangan_ket_luas_tempat_usaha']       = implode('|', $this->input->post('ho_perpanjangan_ket_luas_tempat_usaha'));
					$data_penetapan['ho_perpanjangan_panjang_tempat_usaha']        = implode('|', $this->input->post('ho_perpanjangan_panjang_tempat_usaha'));
					$data_penetapan['ho_perpanjangan_lebar_tempat_usaha']          = implode('|', $this->input->post('ho_perpanjangan_lebar_tempat_usaha'));
					$data_penetapan['ho_perpanjangan_kode_index_luas']             = $this->input->post('ho_perpanjangan_kode_index_luas');
					$data_penetapan['ho_perpanjangan_tinggi_tower']                = $this->input->post('ho_perpanjangan_tinggi_tower');
					$data_penetapan['ho_perpanjangan_kode_index_lokasi']           = $this->input->post('ho_perpanjangan_kode_index_lokasi');
					$data_penetapan['ho_perpanjangan_kode_index_gangguan']         = $this->input->post('ho_perpanjangan_kode_index_gangguan');
					$data_penetapan['ho_perpanjangan_kode_index_harga_dasar']      = $this->input->post('ho_perpanjangan_kode_index_harga_dasar');
					$data_penetapan['ho_perpanjangan_nilai_retribusi']             = $this->input->post('ho_perpanjangan_nilai_retribusi');

					$this->db->where('no_daftar', $no_daftar);
					$update = $this->db->update('t_fo', $data_penetapan);
					if($update){

						$this->m_fo->set_status_proses($no_daftar, 5);
						redirect('c_penetapan/belum');
						
					}
					break;

				case 'ho_perubahan':

					$data_penetapan['ho_perubahan_nama_perusahaan']             = $this->input->post('ho_perubahan_nama_perusahaan');
					$data_penetapan['ho_perubahan_nama_pemilik']                = $this->input->post('ho_perubahan_nama_pemilik');
					$data_penetapan['ho_perubahan_alamat_perusahaan']           = $this->input->post('ho_perubahan_alamat_perusahaan');
					$data_penetapan['ho_perubahan_id_kec_perusahaan']           = $this->input->post('ho_perubahan_id_kec_perusahaan');
					$data_penetapan['ho_perubahan_id_kel_perusahaan']           = $this->input->post('ho_perubahan_id_kel_perusahaan');
					$data_penetapan['ho_perubahan_id_bentuk_perusahaan']        = $this->input->post('ho_perubahan_id_bentuk_perusahaan');
					$data_penetapan['ho_perubahan_tanggal_peninjauan_lapangan'] = $this->input->post('ho_perubahan_tanggal_peninjauan_lapangan');
					$data_penetapan['ho_perubahan_nama_bidang_usaha']           = $this->input->post('ho_perubahan_nama_bidang_usaha');
					$data_penetapan['ho_perubahan_ket_luas_tempat_usaha']       = implode('|', $this->input->post('ho_perubahan_ket_luas_tempat_usaha'));
					$data_penetapan['ho_perubahan_panjang_tempat_usaha']        = implode('|', $this->input->post('ho_perubahan_panjang_tempat_usaha'));
					$data_penetapan['ho_perubahan_lebar_tempat_usaha']          = implode('|', $this->input->post('ho_perubahan_lebar_tempat_usaha'));
					$data_penetapan['ho_perubahan_kode_index_luas']             = $this->input->post('ho_perubahan_kode_index_luas');
					$data_penetapan['ho_perubahan_tinggi_tower']                = $this->input->post('ho_perubahan_tinggi_tower');
					$data_penetapan['ho_perubahan_kode_index_lokasi']           = $this->input->post('ho_perubahan_kode_index_lokasi');
					$data_penetapan['ho_perubahan_kode_index_gangguan']         = $this->input->post('ho_perubahan_kode_index_gangguan');
					$data_penetapan['ho_perubahan_kode_index_harga_dasar']      = $this->input->post('ho_perubahan_kode_index_harga_dasar');
					$data_penetapan['ho_perubahan_nilai_retribusi']             = $this->input->post('ho_perubahan_nilai_retribusi');

					$this->db->where('no_daftar', $no_daftar);
					$update = $this->db->update('t_fo', $data_penetapan);
					if($update){

						$this->m_fo->set_status_proses($no_daftar, 5);
						redirect('c_penetapan/belum');
						
					}
					break;

				case 'sipi_baru':

					$data_penetapan['sipi_baru_alamat']       = $this->input->post('sipi_baru_alamat');
					$data_penetapan['sipi_baru_id_kec']       = $this->input->post('sipi_baru_id_kec');
					$data_penetapan['sipi_baru_id_kel']       = $this->input->post('sipi_baru_id_kel');

					$data_penetapan['sipi_baru_id_jenis_alat_tangkap']       = $this->input->post('sipi_baru_id_jenis_alat_tangkap');
					$data_penetapan['sipi_baru_nilai_retribusi']             = $this->input->post('sipi_baru_nilai_retribusi');
					
					$data_penetapan['sipi_baru_tanggal_peninjauan_lapangan'] = $this->input->post('sipi_baru_tanggal_peninjauan_lapangan');

					

					$this->db->where('no_daftar', $no_daftar);
					$update = $this->db->update('t_fo', $data_penetapan);
					if($update){

						$this->m_fo->set_status_proses($no_daftar, 5);
						
						/**
						 * cetak ssrd
						 */
					 	if ($this->input->post('sekaligus_cetak') == 1) {
					 		$this->m_sipi->cetak_ssrd($no_daftar);	
					 	}
					}
					break;
			}

			
			

			
		}
		
		$data['penetapan'] = $this->m_fo->get_where_no_daftar($no_daftar);
		$data['kec']       = $this->m_kec->get_all();
		$data['kel']       = $this->m_kel->get_all();
		$data['form_penetapan_tambahan'] = $this->load->view('penetapan/'. $this->m_sub_modul->get_nama_sub_modul($data['penetapan']->id_sub_modul), $data, true);

		$this->load->view('templates/top');
        $this->load->view('v_penetapan', $data);
        $this->load->view('templates/bottom');
	}

	public function cetak_ssrd($no_daftar){

		$data['id_sub_modul']            = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul']          = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model']              = 'm_'.explode('_', $data['nama_sub_modul'])[0];

		switch ($data['nama_sub_modul']) {
			case 'ho_baru':
				$this->m_ho->cetak_ssrd_baru($no_daftar);
				break;
			case 'ho_perpanjangan':
				$this->m_ho->cetak_ssrd_perpanjangan($no_daftar);
				break;
			case 'ho_perubahan':
				$this->m_ho->cetak_ssrd_perubahan($no_daftar);
				break;

			case 'imb_baru':
				$this->m_imb->cetak_ssrd_baru($no_daftar);
				break;
			default:
				# code...
				break;
		}

		// redirect('c_penetapan/belum_lunas');
		
	}


	public function lunaskan($no_daftar){
		/**
		 * cetak SSRD
		 */
		$this->m_fo->set_status_proses($no_daftar, 6);
		redirect('c_penetapan/belum_lunas');	
	}


	public function batalkan_penetapan($no_daftar){
		$this->m_fo->set_status_proses($no_daftar, 4);
		redirect('c_penetapan/belum_lunas');
	}


	public function edit_penetapan($no_daftar){

		$data['pesan_kesalahan'] = array();

		$data['id_sub_modul']            = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul']          = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model']              = 'm_'.explode('_', $data['nama_sub_modul'])[0];


		

		switch ($data['nama_sub_modul']) {
			case 'ho_baru':
				$data['index_gangguan']    = $this->m_index_gangguan->get_all();
				$data['index_harga_dasar'] = $this->m_index_harga_dasar->get_all();
				$data['index_lokasi']      = $this->m_index_lokasi->get_all();
				$data['index_luas']        = $this->m_index_luas->get_all();
				$data['bidang_ho']         = $this->m_bidang_ho->get_all();
				break;
			
			default:
				# code...
				break;
		}


		if($this->input->post('tetapkan')){

			switch ($data['nama_sub_modul']) {

				case 'ho_baru':
					$data_penetapan['ho_baru_id_bidang']            = $this->input->post('ho_baru_id_bidang');
					$data_penetapan['ho_baru_panjang_tempat_usaha'] = $this->input->post('ho_baru_panjang_tempat_usaha');
					$data_penetapan['ho_baru_lebar_tempat_usaha']   = $this->input->post('ho_baru_lebar_tempat_usaha');
					$data_penetapan['ho_baru_kode_index_luas']        = $this->m_index_luas->get_kode_where_luas(
							$this->input->post('ho_baru_panjang_tempat_usaha') * $this->input->post('ho_baru_lebar_tempat_usaha')
					);
					$data_penetapan['ho_baru_kode_index_lokasi']      = $this->input->post('ho_baru_kode_index_lokasi');
					$data_penetapan['ho_baru_kode_index_gangguan']    = $this->input->post('ho_baru_kode_index_gangguan');
					$data_penetapan['ho_baru_kode_index_harga_dasar'] = $this->input->post('ho_baru_kode_index_harga_dasar');
					$data_penetapan['ho_baru_nilai_retribusi']        = $this->input->post('ho_baru_nilai_retribusi');
					break;
			}

			$this->db->where('no_daftar', $no_daftar);
			$update = $this->db->update('t_fo', $data_penetapan);
			if($update){

				// $this->m_fo->set_status_proses($no_daftar, 5);
				
				/**
				 * cetak ssrd
				 */
			 	if ($this->input->post('sekaligus_cetak') == 1) {
			 		$this->$data['nama_model']->cetak_ssrd($no_daftar);	
			 	}
				
			}
		}
		
		$data['penetapan']               = $this->m_fo->get_where_no_daftar($no_daftar);
		$data['form_penetapan_tambahan'] = $this->load->view('edit_penetapan/'. $this->m_sub_modul->get_nama_sub_modul($data['penetapan']->id_sub_modul), $data, true);

		$this->load->view('templates/top');
        $this->load->view('v_penetapan', $data);
        $this->load->view('templates/bottom');
	}

}