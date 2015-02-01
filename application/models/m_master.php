<?php

class M_master extends CI_Model{

	public function get_bentuk_perusahaan(){

		$query = $this->db->get('ms_bentuk_perusahaan');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return false;
		}
	}
}