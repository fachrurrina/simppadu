<?php 

class M_index_luas extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_index_luas');
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
		$query = $this->db->query("SELECT nilai_index_luas FROM t_index_luas WHERE kode_index_luas = $kode");
		if($query->num_rows == 1){
			return $query->result()[0]->nilai_index_luas;
		}else{
			return false;
		}
	}

	
	public function get_kode_where_luas($luas){

		$index_luas = $this->db->get('t_index_luas')->result();

		foreach ($index_luas as $r_index_luas) {
			if($luas >= $r_index_luas->minimal and $luas <= $r_index_luas->maximal){
				$kode_index_luas = $r_index_luas->kode_index_luas;
			}
		}

		return $kode_index_luas;

	}


	public function get_nama_where_luas($luas){

		$index_luas = $this->db->get('t_index_luas')->result();

		foreach ($index_luas as $r_index_luas) {
			if($luas >= $r_index_luas->minimal and $luas <= $r_index_luas->maximal){
				$nama_index_luas = $r_index_luas->nama_index_luas;
			}
		}

		return $nama_index_luas;

	}

	public function get_nilai_where_luas($luas){

		$index_luas = $this->db->get('t_index_luas')->result();

		foreach ($index_luas as $r_index_luas) {
			if($luas >= $r_index_luas->minimal and $luas <= $r_index_luas->maximal){
				$nilai_index_luas = $r_index_luas->nilai_index_luas;
			}
		}

		return $nilai_index_luas;

	}

}
