<?php 

class M_koif_tingkat extends CI_Model{

	public function get_all(){
	
		$query = $this->db->get('t_koif_tingkat');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	
	}


	public function get_jumlah_tingkat($id_koif_tingkat){
		$this->db->where('id_koif_tingkat', $id_koif_tingkat);
		$this->db->select('jumlah_tingkat');
		$query = $this->db->get('t_koif_tingkat');
		if($query->num_rows() > 0){
			return $query->result()[0]->jumlah_tingkat;
		}else{
			return false;
		}
	}

	public function get_nilai_koif_tingkat($id_koif_tingkat){
		$this->db->where('id_koif_tingkat', $id_koif_tingkat);
		$this->db->select('nilai_koif_tingkat');
		$query = $this->db->get('t_koif_tingkat');
		if($query->num_rows() > 0){
			return $query->result()[0]->nilai_koif_tingkat;
		}else{
			return false;
		}
	
	}
}