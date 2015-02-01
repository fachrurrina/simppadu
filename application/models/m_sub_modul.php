<?php

class M_sub_modul extends CI_Model{


	public function get_all(){
		$query = $this->db->get('t_sub_modul');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_where_id_modul($id_modul){
		$this->db->where('id_modul', $id_modul);
		$query = $this->db->get('t_sub_modul');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}


	public function get_nama_sub_modul($id_sub_modul){
		$this->db->where('id_sub_modul', $id_sub_modul);
		$query = $this->db->get('t_sub_modul');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_sub_modul;
		}else{
			return false;
		}
	}

	public function get_status_retribusi($id_sub_modul){
		$this->db->where('id_sub_modul', $id_sub_modul);
		$this->db->select('status_retribusi');
		$query = $this->db->get('t_sub_modul');
		if($query->num_rows() > 0){
			return $query->result()[0]->status_retribusi;
		}else{
			return false;
		}
	}
}