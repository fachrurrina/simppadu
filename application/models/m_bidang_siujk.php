<?php  

class M_bidang_siujk extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_bidang_siujk');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_bidang_siujk($id_bidang_siujk){
		$this->db->where('id_bidang_siujk', $id_bidang_siujk);
		$query = $this->db->get('t_bidang_siujk');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_bidang_siujk;
		}else{
			return false;
		}
	}
}