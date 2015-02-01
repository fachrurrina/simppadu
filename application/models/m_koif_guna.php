<?php 

class M_koif_guna extends CI_Model{

	public function get_all(){
	
		$query = $this->db->get('t_koif_guna');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	
	}


	public function get_nilai_koif_guna($id_koif_guna){
		$this->db->where('id_koif_guna', $id_koif_guna);
		$this->db->select('nilai_koif_guna');
		$query = $this->db->get('t_koif_guna');
		if($query->num_rows() > 0){
			return $query->result()[0]->nilai_koif_guna;
		}else{
			return false;
		}
	
	}
}