<?php

class M_kepemilikan_tanah extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_kepemilikan_tanah');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_kepemilikan_tanah($id_kepemilikan_tanah){
		$this->db->where('id_kepemilikan_tanah', $id_kepemilikan_tanah);
		$this->db->select('nama_kepemilikan_tanah');
		$query = $this->db->get('t_kepemilikan_tanah');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_kepemilikan_tanah;
		}else{
			return false;
		}

	}

	
}