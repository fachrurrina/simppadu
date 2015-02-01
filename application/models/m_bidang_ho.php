<?php

class M_bidang_ho extends CI_Model{

	public function get_all(){
	
		$query = $this->db->get('t_bidang_ho');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	
	}

	public function get_nama_bidang_ho($id_bidang_ho){
		$query = $this->db->get('t_bidang_ho');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_bidang_ho;
		}else{
			return false;
		}
	}
}


