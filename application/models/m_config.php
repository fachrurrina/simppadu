<?php 

class M_config extends CI_Model{

	public function get_nama_kepala_dinas(){
		$query = $this->db->get('t_config');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_kepala_dinas;
		}else{
			return false;
		}
	}
	public function get_nip_kepala_dinas(){
		$query = $this->db->get('t_config');
		if($query->num_rows() > 0){
			return $query->result()[0]->nip_kepala_dinas;
		}else{
			return false;
		}
	}
	public function get_nama_bendahara_penerimaan(){
		$query = $this->db->get('t_config');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_bendahara_penerimaan;
		}else{
			return false;
		}
	}
	public function get_nip_bendahara_penerimaan(){
		$query = $this->db->get('t_config');
		if($query->num_rows() > 0){
			return $query->result()[0]->nip_bendahara_penerimaan;
		}else{
			return false;
		}
	}
}