<?php  

class M_index_gangguan extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_index_gangguan');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nilai($kode){
		$query = $this->db->query("SELECT nilai_index_gangguan FROM t_index_gangguan WHERE kode_index_gangguan = $kode");
		if($query->num_rows == 1){
			return $query->result()[0]->nilai_index_gangguan;
		}else{
			return false;
		}
	}

}
