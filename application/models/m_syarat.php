<?php

class M_syarat extends CI_Model{

	public function get_all(){
		$query = $this->db->get('t_syarat');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_where_id_sub_modul($id_sub_modul){
		// $this->db->where('id_sub_modul', $id_sub_modul);
		$sql = "SELECT * FROM t_syarat where id_sub_modul = $id_sub_modul ORDER BY nama_syarat";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}

	public function get_where_id_syarat($id_syarat){
		$this->db->where('id_syarat', $id_syarat);
		$query = $this->db->get('t_syarat');
		if($query->num_rows() > 0){
			
			return $query->result()[0];
		}else{
			return false;
		}
	}

	public function delete($id_syarat){
		$this->db->where('id_syarat', $id_syarat);
		$delete = $this->db->delete('t_syarat');
		return ($delete) ? true : false ;
	}

	public function insert_new($id_modul, $id_sub_modul, $nama_syarat){
		$data_insert = array(
			'id_modul'     => $id_modul,
			'id_sub_modul' => $id_sub_modul,
			'nama_syarat'  => $nama_syarat
		);
		$insert = $this->db->insert('t_syarat', $data_insert);
		return ($insert) ? true : false;
	}

	public function update($id_syarat, $id_modul, $id_sub_modul, $nama_syarat){
		$this->db->where('id_syarat', $id_syarat);
		$update = $this->db->update('t_syarat', array(
			'id_modul' => $id_modul,
			'id_sub_modul' => $id_sub_modul,
			'nama_syarat' => $nama_syarat
		));

		return ($update) ? true : false;

	}
}