<?php 

class M_index_harga_dasar extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_index_harga_dasar');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_nama_harga_dasar_bangunan($id_harga_dasar){
		$this->db->where('id_harga_dasar', $id_harga_dasar);
		$this->db->select('jenis_bangunan');
		$query = $this->db->get('t_harga_dasar_bangunan');
		if($query->num_rows == 1){
			return $query->result()[0]->jenis_bangunan;
		}else{
			return false;
		}
	}

	public function get_nilai($kode){
		$query = $this->db->query("SELECT nilai_index_harga_dasar FROM t_index_harga_dasar WHERE kode_index_harga_dasar = $kode");
		if($query->num_rows == 1){
			return $query->result()[0]->nilai_index_harga_dasar;
		}else{
			return false;
		}
	}

}
