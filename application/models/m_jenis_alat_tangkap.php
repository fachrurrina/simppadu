<?php 

class M_jenis_alat_tangkap extends CI_Model{

	public function get_all(){
	
		$query = $this->db->get('t_jenis_alat_tangkap');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_jenis_alat_tangkap($id){

		$this->db->where('id_jenis_alat_tangkap', $id);
		$query = $this->db->get('t_jenis_alat_tangkap');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_jenis_alat_tangkap;
		}else{
			return false;
		}
	}
}