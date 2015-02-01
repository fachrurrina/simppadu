<?php

class M_bentuk_perusahaan extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_bentuk_perusahaan');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_bentuk_perusahaan($id_bentuk_perusahaan){
		$this->db->where('id_bentuk_perusahaan', $id_bentuk_perusahaan);
		$this->db->select('nama_bentuk_perusahaan');
		$query = $this->db->get('t_bentuk_perusahaan');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_bentuk_perusahaan;
		}else{
			return false;
		}

	}

	public function get_singkatan_bentuk_perusahaan($id_bentuk_perusahaan){
		$this->db->where('id_bentuk_perusahaan', $id_bentuk_perusahaan);
		$this->db->select('singkatan');
		$query = $this->db->get('t_bentuk_perusahaan');
		if($query->num_rows() > 0){
			return $query->result()[0]->singkatan;
		}else{
			return false;
		}

	}
}