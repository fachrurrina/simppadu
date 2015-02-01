<?php

class M_kel extends CI_Model{

	public function get_all(){
		$this->db->order_by("nm_kel", "desc"); 
		$query = $this->db->get('t_kel');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nm_kel($id_kel){
		// $this->db->order_by("nm_kel", "desc");
		$this->db->where('id_kel', $id_kel);
		$this->db->select('nm_kel');
		$query = $this->db->get('t_kel');
		if($query->num_rows() > 0){
			
			return $query->result()[0]->nm_kel;
		}else{
			return false;
		}
	}

	public function get_where_id_kec($id_kec){
		$this->db->order_by("nm_kel", "desc");
		$this->db->where('id_kec', $id_kec);
		$query = $this->db->get('t_kel');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}
}