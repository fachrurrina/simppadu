<?php

class M_kelembagaan_siup extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_kelembagaan_siup');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_kelembagaan($id_kelembagaan){
		$this->db->where('id_kelembagaan', $id_kelembagaan);
		$this->db->select('kelembagaan');
		$query = $this->db->get('t_kelembagaan_siup');
		if($query->num_rows() > 0){
			return $query->result()[0]->kelembagaan;
			return $rows;
		}else{
			return false;
		}
	}
}