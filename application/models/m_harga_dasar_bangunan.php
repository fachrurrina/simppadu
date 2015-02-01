<?php 

class M_harga_dasar_bangunan extends CI_Model{

	public function get_all(){
	
		$query = $this->db->get('t_harga_dasar_bangunan');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	
	}

	public function get_jenis_bangunan_harga_dasar($id_harga_dasar){
		$this->db->where('id_harga_dasar', $id_harga_dasar);
		$this->db->select('jenis_bangunan');
		$query = $this->db->get('t_harga_dasar_bangunan');
		if($query->num_rows() > 0){
			return $query->result()[0]->jenis_bangunan;
		}else{
			return false;
		}
	
	}

	public function get_nilai_harga_dasar($id_harga_dasar){
		$this->db->where('id_harga_dasar', $id_harga_dasar);
		$this->db->select('nilai_harga_dasar');
		$query = $this->db->get('t_harga_dasar_bangunan');
		if($query->num_rows() > 0){
			return $query->result()[0]->nilai_harga_dasar;
		}else{
			return false;
		}
	
	}
}