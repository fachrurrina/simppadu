<?php

class M_bidang_situ extends CI_Model{

	public function get_all(){
	
		$query = $this->db->get('t_bidang_situ');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	
	}

	public function get_nama_bidang_situ($id_bidang_situ){
		$this->db->where('id_bidang_situ', $id_bidang_situ);
		$query = $this->db->get('t_bidang_situ');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_bidang_situ;
		}else{
			return false;
		}
	}

	public function nama_bidang_situ_exist($nama_bidang_situ){
		$this->db->where('nama_bidang_situ', $nama_bidang_situ);
		$query = $this->db->get('t_bidang_situ');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}