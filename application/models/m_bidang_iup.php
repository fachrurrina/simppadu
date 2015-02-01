<?php

class M_bidang_iup extends CI_Model{

	public function get_all(){
	
		$query = $this->db->get('t_bidang_iup');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	
	}

	public function get_nama_bidang_iup($id_bidang_iup){
		$this->db->where('id_bidang_iup', $id_bidang_iup);
		$query = $this->db->get('t_bidang_iup');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_bidang_iup;
		}else{
			return false;
		}
	}

	public function get_sub_bidang_where_id_bidang($id_bidang){
		
		$this->db->where('id_bidang_iup', $id_bidang);
		$query = $this->db->get('t_sub_bidang_iup');
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