<?php

class M_kbli extends CI_Model{

	public function get_all(){
		
		$query = $this->db->get('t_kbli');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_5_digit(){
		$sql = "SELECT * FROM t_kbli WHERE LENGTH(id_kbli) = 5;";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}
	
	public function get_4_digit(){
		$sql = "SELECT * FROM t_kbli WHERE LENGTH(id_kbli) = 4;";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_judul_kbli($id_kbli){
		
		$this->db->where('id_kbli', $id_kbli);
		$query = $this->db->get('t_kbli');

		if($query->num_rows() > 0){
			return $query->result()[0]->judul_kbli;
		}else{
			return false;
		}
	}

}