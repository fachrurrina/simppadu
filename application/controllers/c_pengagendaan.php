
<?php

class C_pengagendaan extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->belum();
	}

	public function belum(){

		$data['belum'] = $this->m_fo->get_where_status_proses(array(6));

		$this->load->view('templates/top');
        $this->load->view('v_pengagendaan_belum', $data);
        $this->load->view('templates/bottom');
	}

	public function sudah(){

		$data['sudah'] = $this->m_fo->get_where_status_proses(array(7, 8, 9));

		$this->load->view('templates/top');
        $this->load->view('v_pengagendaan_sudah', $data);
        $this->load->view('templates/bottom');
	}

	public function agendakan($no_daftar){

		$data['pesan_kesalahan'] = array();

		$data['id_sub_modul'] = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model'] = 'm_'.explode('_', $data['nama_sub_modul'])[0];
		$data['fo'] = $this->m_fo->get_where_no_daftar($no_daftar);

		switch ($data['nama_sub_modul']) {

			case 'sipo_perpanjangan':
				
				$data['data_lalu'] = $this->m_sipo->get_where_no_sk_2($data['fo']->sipo_perpanjangan_no_sk);
				break;

			case 'siup_baru':
				$data['kbli_4'] = $this->m_kbli->get_4_digit();
				break;

			case 'siup_perpanjangan':
				$data['kbli_4'] = $this->m_kbli->get_4_digit();
				$data['data_lalu'] = $this->m_siup->get_where_no_sk_2($data['fo']->siup_perpanjangan_no_sk);
				break;

			case 'siup_perubahan':
				$data['kbli_4'] = $this->m_kbli->get_4_digit();
				$data['data_lalu'] = $this->m_siup->get_where_no_sk_2($data['fo']->siup_perubahan_no_sk);
				break;

			case 'tdp_baru':
				$data['kbli_5'] = $this->m_kbli->get_5_digit();
				break;

			case 'tdp_perpanjangan':
				$data['kbli_5'] = $this->m_kbli->get_5_digit();
				$data['data_lalu'] = $this->m_tdp->get_where_no_sk_2($data['fo']->tdp_perpanjangan_no_sk);
				break;

			case 'tdp_perubahan':
				$data['kbli_5'] = $this->m_kbli->get_5_digit();
				$data['data_lalu'] = $this->m_tdp->get_where_no_sk_2($data['fo']->tdp_perubahan_no_sk);

				
				break;

			case 'situ_perpanjangan':
				
				$data['data_lalu'] = $this->m_situ->get_where_no_sk($data['fo']->situ_perpanjangan_no_sk);
				break;

			case 'situ_perubahan':
				
				$data['data_lalu'] = $this->m_situ->get_where_no_sk($data['fo']->situ_perubahan_no_sk);
				break;

			case 'siuk_perpanjangan':
				
				$data['data_lalu'] = $this->m_siuk->get_where_no_sk($data['fo']->siuk_perpanjangan_no_sk);
				break;

			case 'siuk_perubahan':
				
				$data['data_lalu'] = $this->m_siuk->get_where_no_sk($data['fo']->siuk_perubahan_no_sk);
				break;

			case 'ho_baru':
				$data['bidang_ho'] = $this->m_bidang_ho->get_all();
				break;

			case 'ho_perpanjangan':
				$data['bidang_ho'] = $this->m_bidang_ho->get_all();
				break;

			case 'ho_perubahan':
				$data['bidang_ho'] = $this->m_bidang_ho->get_all();
				break;

			case 'siujk_perpanjangan':
				
				$data['data_lalu'] = $this->m_siujk->get_where_no_sk($data['fo']->siujk_perpanjangan_no_sk);
				break;

			case 'siujk_perubahan':
				
				$data['data_lalu'] = $this->m_siujk->get_where_no_sk($data['fo']->siujk_perubahan_no_sk);

				break;

			case 'tdi_baru':
				$data['kbli_5'] = $this->m_kbli->get_5_digit();
				break;

			case 'tdi_perubahan':
				$data['kbli_5'] = $this->m_kbli->get_5_digit();
				$data['data_lalu'] = $this->m_tdi->get_where_no_sk($data['fo']->tdi_perubahan_no_sk);
				break;

			case 'sib_baru':
				$data['kbli_4'] = $this->m_kbli->get_4_digit();
				break;
			
			default:
				# code...
				break;
		}

		if($this->input->post('agendakan')){

			switch ($data['nama_sub_modul']) {

				case 'siup_baru':
					$no_urut              = $this->m_siup->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					$id_kbli              = ($this->input->post('id_kbli')) ? implode('|', $this->input->post('id_kbli')) : '';
					

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == '' or $id_kbli == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_siup->apakah_no_sk_sudah_digunakan($no_sk) == true){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan lebih kecil dari tanggal terbit!');
						}

					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siup', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan, 
							'id_kbli'              => $id_kbli
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}
					break;

				case 'siup_perpanjangan':
					
					$no_urut              = $this->m_siup->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					$id_kbli              = ($this->input->post('id_kbli')) ? implode('|', $this->input->post('id_kbli')) : '';

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == '' or $id_kbli == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siup', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk_lalu'           => $no_sk_lalu, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan, 
							'id_kbli'              => $id_kbli
						));

						if($insert){
							
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siup_perubahan':
					
					$no_urut              = $this->m_siup->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					$id_kbli              = ($this->input->post('id_kbli')) ? implode('|', $this->input->post('id_kbli')) : '';

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == '' or $id_kbli == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siup', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk_lalu'           => $no_sk_lalu, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan, 
							'id_kbli'              => $id_kbli
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'tdp_baru':
					$no_urut              = $this->m_tdp->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					$id_kbli              = $this->input->post('id_kbli');
					


					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == '' or $id_kbli == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_tdp->apakah_no_sk_sudah_digunakan($no_sk) == true){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan lebih kecil dari tanggal terbit!');
						}

					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_tdp', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan, 
							'id_kbli'              => $id_kbli
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}
					break;

				case 'tdp_perpanjangan':
					
					$no_urut              = $this->m_tdp->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					$id_kbli              = $this->input->post('id_kbli');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == '' or $id_kbli == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_tdp', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk_lalu'           => $no_sk_lalu, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan, 
							'id_kbli'              => $id_kbli
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'tdp_perubahan':
					
					$no_urut              = $this->m_tdp->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					$id_kbli              = $this->input->post('id_kbli');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == '' or $id_kbli == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_tdp', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk_lalu'           => $no_sk_lalu, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan, 
							'id_kbli'              => $id_kbli
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'situ_baru':
					
					$no_urut              = $this->m_situ->get_no_urut_baru();
					$tanggal_daftar       = $data['fo']->tanggal_daftar;
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_situ->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_situ', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'situ_perpanjangan':
					
					$no_urut              = $this->m_situ->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{


						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_situ', array(
							'no_urut'             => $no_urut,
							'no_daftar'           => $no_daftar,
							'tanggal_daftar'      => $tanggal_daftar, 
							'no_sk_lalu'          => $no_sk_lalu, 
							'no_sk'               => $no_sk, 
							'tanggal_terbit'      => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'situ_perubahan':
					
					$no_urut              = $this->m_situ->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{


						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_situ', array(
							'no_urut'             => $no_urut,
							'no_daftar'           => $no_daftar,
							'tanggal_daftar'      => $tanggal_daftar, 
							'no_sk_lalu'          => $no_sk_lalu, 
							'no_sk'               => $no_sk, 
							'tanggal_terbit'      => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'ho_perpanjangan':
					
					$no_urut              = $this->m_ho->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu                = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_daftar_ulang       = $this->input->post('tanggal_daftar_ulang');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_daftar_ulang == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_ho->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_ho', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk_lalu'                => $no_sk_lalu, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_daftar_ulang'       => $tanggal_daftar_ulang, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'ho_perubahan':
					
					$no_urut              = $this->m_ho->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu                = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_daftar_ulang       = $this->input->post('tanggal_daftar_ulang');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_daftar_ulang == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_ho->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_ho', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk_lalu'                => $no_sk_lalu, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_daftar_ulang'       => $tanggal_daftar_ulang, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'ho_baru':
					
					$no_urut              = $this->m_ho->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_daftar_ulang       = $this->input->post('tanggal_daftar_ulang');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_daftar_ulang == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_ho->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_ho', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_daftar_ulang'       => $tanggal_daftar_ulang, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;


				case 'imb_baru':
					
					$no_urut              = $this->m_imb->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					
					

					if($no_sk == '' or $tanggal_terbit == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_imb->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_imb', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siuk_baru':
					
					$no_urut              = $this->m_siuk->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_siuk->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siuk', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siujk_baru':
					
					$no_urut              = $this->m_siujk->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_siujk->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siujk', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siuk_perpanjangan':
					
					$no_urut              = $this->m_siuk->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{


						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siuk', array(
							'no_urut'             => $no_urut,
							'no_daftar'           => $no_daftar,
							'tanggal_daftar'      => $tanggal_daftar, 
							'no_sk_lalu'          => $no_sk_lalu, 
							'no_sk'               => $no_sk, 
							'tanggal_terbit'      => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siuk_perubahan':
					
					$no_urut              = $this->m_siuk->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{


						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siuk', array(
							'no_urut'             => $no_urut,
							'no_daftar'           => $no_daftar,
							'tanggal_daftar'      => $tanggal_daftar, 
							'no_sk_lalu'          => $no_sk_lalu, 
							'no_sk'               => $no_sk, 
							'tanggal_terbit'      => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siujk_perpanjangan':
					
					$no_urut              = $this->m_siujk->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{


						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siujk', array(
							'no_urut'             => $no_urut,
							'no_daftar'           => $no_daftar,
							'tanggal_daftar'      => $tanggal_daftar, 
							'no_sk_lalu'          => $no_sk_lalu, 
							'no_sk'               => $no_sk, 
							'tanggal_terbit'      => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siujk_perubahan':
					
					$no_urut              = $this->m_siujk->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{


						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siujk', array(
							'no_urut'             => $no_urut,
							'no_daftar'           => $no_daftar,
							'tanggal_daftar'      => $tanggal_daftar, 
							'no_sk_lalu'          => $no_sk_lalu, 
							'no_sk'               => $no_sk, 
							'tanggal_terbit'      => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'tdi_baru':
					
					$no_urut              = $this->m_tdi->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$id_kbli              = ($this->input->post('id_kbli')) ? implode('|', $this->input->post('id_kbli')) : '';
					

					if($no_sk == '' or $tanggal_terbit == '' or $id_kbli == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_tdi->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_tdi', array(
							'no_urut'        => $no_urut,
							'no_daftar'      => $no_daftar,
							'tanggal_daftar' => $tanggal_daftar, 
							'no_sk'          => $no_sk, 
							'tanggal_terbit'  => $tanggal_terbit, 
							'id_kbli'        => $id_kbli
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'tdi_perubahan':
					
					$no_urut              = $this->m_tdi->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$id_kbli              = ($this->input->post('id_kbli')) ? implode('|', $this->input->post('id_kbli')) : '';
					

					if($no_sk == '' or $tanggal_terbit == '' or $id_kbli == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_tdi->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_tdi', array(
							'no_urut'        => $no_urut,
							'no_daftar'      => $no_daftar,
							'tanggal_daftar' => $tanggal_daftar, 
							'no_sk'          => $no_sk, 
							'tanggal_terbit'  => $tanggal_terbit, 
							'id_kbli'        => $id_kbli
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sipl_baru':
					
					$no_urut              = $this->m_sipl->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					
					

					if($no_sk == '' or $tanggal_terbit == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sipl->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sipl', array(
							'no_urut'        => $no_urut,
							'no_daftar'      => $no_daftar,
							'tanggal_daftar' => $tanggal_daftar, 
							'no_sk'          => $no_sk, 
							'tanggal_terbit'  => $tanggal_terbit, 
							
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sipk_baru':
					
					$no_urut              = $this->m_sipk->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					
					

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sipk->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sipk', array(
							'no_urut'        => $no_urut,
							'no_daftar'      => $no_daftar,
							'tanggal_daftar' => $tanggal_daftar, 
							'no_sk'          => $no_sk, 
							'tanggal_terbit'  => $tanggal_terbit, 
							
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sisbw_baru':
					
					$no_urut              = $this->m_sisbw->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					
					

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sisbw->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sisbw', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan 
							
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siuakb_baru':
					
					$no_urut              = $this->m_siuakb->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					
					

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_siuakb->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siuakb', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan 
							
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sib_baru':
					
					$no_urut              = $this->m_sib->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');
					$id_kbli              = ($this->input->post('id_kbli')) ? implode('|', $this->input->post('id_kbli')) : '';
					
					

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == '' or $id_kbli = ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sib->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sib', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan,
							'id_kbli'              => $id_kbli 
							
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sipd_baru':
					
					$no_urut              = $this->m_sipd->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sipd->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sipd', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sipb_baru':
					
					$no_urut              = $this->m_sipb->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sipb->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sipb', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sikb_baru':
					
					$no_urut              = $this->m_sikb->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sikb->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sikb', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sikp_baru':
					
					$no_urut              = $this->m_sikp->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sikp->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sikp', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sipp_baru':
					
					$no_urut              = $this->m_sipp->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sipp->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sipp', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sipo_baru':
					
					$no_urut              = $this->m_sipo->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sipo->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sipo', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;


				case 'sipo_perpanjangan':
					
					$no_urut              = $this->m_sipo->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk_lalu           = $this->input->post('no_sk_lalu');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{


						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sipo', array(
							'no_urut'             => $no_urut,
							'no_daftar'           => $no_daftar,
							'tanggal_daftar'      => $tanggal_daftar, 
							'no_sk_lalu'          => $no_sk_lalu, 
							'no_sk'               => $no_sk, 
							'tanggal_terbit'      => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;
				case 'sia_baru':
					
					$no_urut              = $this->m_sia->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_daftar_ulang       = $this->input->post('tanggal_daftar_ulang');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_daftar_ulang == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sia->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sia', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_daftar_ulang' => $tanggal_daftar_ulang, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sia_perpanjangan':
					
					$no_urut              = $this->m_sia->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_daftar_ulang       = $this->input->post('tanggal_daftar_ulang');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_daftar_ulang == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sia->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sia', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_daftar_ulang' => $tanggal_daftar_ulang, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sik_baru':
					
					$no_urut              = $this->m_sik->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_daftar_ulang       = $this->input->post('tanggal_daftar_ulang');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_daftar_ulang == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sik->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sik', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_daftar_ulang' => $tanggal_daftar_ulang, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'siot_baru':
					
					$no_urut              = $this->m_siot->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_siot->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_siot', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sios_baru':
					
					$no_urut              = $this->m_sios->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_sios->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sios', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;

				case 'sipi_baru':
					
					$no_urut              = $this->m_ho->get_no_urut_baru();
					$tanggal_daftar       = $this->input->post('tanggal_daftar');
					$no_sk                = $this->input->post('no_sk');
					$tanggal_terbit       = $this->input->post('tanggal_terbit');
					$tanggal_perpanjangan = $this->input->post('tanggal_perpanjangan');

					if($no_sk == '' or $tanggal_terbit == '' or $tanggal_perpanjangan == ''){
						array_push($data['pesan_kesalahan'], 'Inputan belum lengkap!');
					}else{

						if($this->m_ho->apakah_no_sk_sudah_digunakan($no_sk)){
							array_push($data['pesan_kesalahan'], 'No sk sudah digunakan oleh surat izin lain!');
						}

						if(strtotime($tanggal_terbit) >= strtotime($tanggal_perpanjangan)){
							array_push($data['pesan_kesalahan'], 'Tanggal perpanjangan tidak boleh lebih kecil dari tanggal terbit!');
						}
					}

					if(!$data['pesan_kesalahan']){
						$insert = $this->db->insert('t_sipi', array(
							'no_urut'              => $no_urut,
							'no_daftar'            => $no_daftar,
							'tanggal_daftar'       => $tanggal_daftar, 
							'no_sk'                => $no_sk, 
							'tanggal_terbit'       => $tanggal_terbit, 
							'tanggal_perpanjangan' => $tanggal_perpanjangan
						));

						if($insert){
							$this->m_fo->set_status_proses($no_daftar, 7);
							redirect('c_pengagendaan');
						}
					}

					break;
				
				default:
					# code...
					break;
			}

		}

		$data['form_pengagendaan_tambahan'] = $this->load->view('pengagendaan/'. $data['nama_sub_modul'], $data, true);
		

		$this->load->view('templates/top');
        $this->load->view('v_pengagendaan', $data);
        $this->load->view('templates/bottom');
	}

	public function batalkan($no_daftar){

		$data['id_sub_modul'] = $this->m_fo->get_id_sub_modul($no_daftar);
		$data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
		$data['nama_model'] = 'm_'.explode('_', $data['nama_sub_modul'])[0];
		$data['fo'] = $this->m_fo->get_where_no_daftar($no_daftar);
		
		if($this->$data['nama_model']->hapus_where_no_daftar($no_daftar)){
			if($this->m_fo->set_status_proses($no_daftar, 6)){ // 6 : belum penggagendaan	
				
				redirect('c_pengagendaan/sudah');
			} 
		}
		
	}

}
