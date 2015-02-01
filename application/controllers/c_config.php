<?php 

class C_config extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){

		$data['pesan'] = array();

		if($this->input->post('simpan')){

			$array_update = array(
				'nama_kepala_dinas'         => $this->input->post('nama_kepala_dinas'),
				'nip_kepala_dinas'          => $this->input->post('nip_kepala_dinas'),
				'nama_bendahara_penerimaan' => $this->input->post('nama_bendahara_penerimaan'),
				'nip_bendahara_penerimaan'  => $this->input->post('nip_bendahara_penerimaan')
			);

			$update = $this->db->update('t_config', $array_update);
			

            if($update){
                ?> <script type="text/javascript">alert('Berhasil disimpan')</script> <?php
            }else{
                ?> <script type="text/javascript">alert('Gagal disimpan')</script> <?php
            }
		}

        $this->load->view('inc/header');
        $this->load->view('inc/top_nav');
        $this->load->view('v_config');
        $this->load->view('inc/footer');
    }
}