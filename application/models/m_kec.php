<?php

class M_kec extends CI_Model{

	public function get_all(){
		$this->db->order_by("nm_kec", "desc");
		$query = $this->db->get('t_kec');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nm_kec($id_kec){
		$this->db->where('id_kec', $id_kec);
		$this->db->select('nm_kec');
		$query = $this->db->get('t_kec');
		if($query->num_rows() > 0){
			
			return $query->result()[0]->nm_kec;
		}else{
			return false;
		}
	}
}