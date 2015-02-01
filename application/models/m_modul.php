<?php

class M_modul extends CI_Model{


	public function get_all(){
		$query = $this->db->get('t_modul');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_modul($id_modul){
		$this->db->where('id_modul', $id_modul);
		$query = $this->db->get('t_modul');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_modul;
		}else{
			return false;
		}
	}

	public function get_where_id_modul($id_modul){
		$this->db->where('id_modul', $id_modul);
		$query = $this->db->get('t_modul');
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