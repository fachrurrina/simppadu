<?php

class M_koif_luas extends CI_Model{

	public function get_all(){
	
		$query = $this->db->get('t_koif_luas');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	
	}

	public function get_nilai_koif_luas($id_koif_luas){
		$this->db->where('id_koif_luas', $id_koif_luas);
		$this->db->select('nilai_koif_luas');
		$query = $this->db->get('t_koif_luas');
		if($query->num_rows() > 0){
			return $query->result()[0]->nilai_koif_luas;
		}else{
			return false;
		}
	
	}



}

