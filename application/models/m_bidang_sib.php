<?php  

class M_bidang_sib extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_bidang_sib');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_bidang_sib($id_bidang_sib){
		$this->db->where('id_bidang_sib', $id_bidang_sib);
		$query = $this->db->get('t_bidang_sib');
		if($query->num_rows() > 0){
			return $query->result()[0]->nama_bidang_sib;
		}else{
			return false;
		}
	}
}