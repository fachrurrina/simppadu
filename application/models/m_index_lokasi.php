<?php  

class M_index_lokasi extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_index_lokasi');
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
		$query = $this->db->query('SELECT nilai_index_lokasi FROM t_index_lokasi WHERE kode_index_lokasi = '. $kode);
		if($query->num_rows == 1){
			return $query->result()[0]->nilai_index_lokasi;
		}else{
			return false;
		}
	}

	public function get_nama_index_lokasi($kode){
		$this->db->select('nama_index_lokasi');
		$this->db->where('kode_index_lokasi', $kode);
		$query = $this->db->get('t_index_lokasi');
		if($query->num_rows == 1){
			return $query->result()[0]->nama_index_lokasi;
		}else{
			return false;
		}
	}

}