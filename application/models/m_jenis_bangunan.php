<?php

class M_jenis_bangunan extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_jenis_bangunan');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_jenis_bangunan($id_jenis_bangunan){
		$this->db->where('id_jenis_bangunan', $id_jenis_bangunan);
		$this->db->select('nama_jenis_bangunan');
		$query = $this->db->get('t_jenis_bangunan');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_jenis_bangunan;
		}else{
			return false;
		}

	}


	public function get_satuan_jenis_bangunan($id_jenis_bangunan){
		$this->db->where('id_jenis_bangunan', $id_jenis_bangunan);
		$this->db->select('satuan_jenis_bangunan');
		$query = $this->db->get('t_jenis_bangunan');
		if($query->num_rows() > 0){
			return $query->result()[0]->satuan_jenis_bangunan;
		}else{
			return false;
		}
	}

	
}