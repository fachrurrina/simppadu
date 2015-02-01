<?php 

class C_entry extends CI_Controller{


	function __construct(){
		parent::__construct();
	}

	public function situ_entry(){

		if($this->input->post('simpan')){

			$insert = $this->db->insert('t_situ', array(
				'no_urut'              => $this->m_situ->get_no_urut_baru(),
				'no_daftar'            => 0,
				'no_sk'                => $this->input->post('no_sk'),
				'ket'                  => $this->input->post('ket'),
				'guna'                 => $this->input->post('guna'),
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
				'id_bidang_situ'       => $this->input->post('id_bidang_situ'),
				'klasifikasi'          => $this->input->post('klasifikasi'),
				'tanggal_daftar'       => $this->input->post('tanggal_daftar'),
				'tanggal_terbit'       => $this->input->post('tanggal_terbit'),
				'tanggal_perpanjangan' => $this->input->post('tanggal_perpanjangan'),
				'no_sk_lalu'           => $this->input->post('no_sk_lalu'),
				'status_berlaku'       => $this->input->post('status_berlaku')
			));

			if($insert){
				?>
					<script type="text/javascript">alert('Berhasil disimpan!')</script>
				<?php
				redirect('c_entry/situ_listing');
			}else{
				?>
					<script type="text/javascript">alert('Berhasil disimpan!')</script>
				<?php
			}
		}

		$data['bidang_situ'] = $this->m_bidang_situ->get_all();
		$data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
		$data['kec'] = $this->m_kec->get_all();
		$data['kel'] = $this->m_kel->get_all();

		$this->load->view('inc/header');
        $this->load->view('inc/top_nav');
        $this->load->view('entry/v_situ_entry', $data);
        $this->load->view('inc/footer');
	}

	public function situ_listing(){

		$data['all_situ'] = $this->m_situ->get_all();

		$this->load->view('inc/header');
        $this->load->view('inc/top_nav');
        $this->load->view('entry/v_situ_listing', $data);
        $this->load->view('inc/footer');
	}

	public function situ_edit(){
		$this->load->view('inc/header');
        $this->load->view('inc/top_nav');
        $this->load->view('entry/v_fo_daftar_1', $data);
        $this->load->view('inc/footer');
	}
}