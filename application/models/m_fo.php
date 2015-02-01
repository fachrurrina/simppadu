<?php

class M_fo extends CI_Model{

	public function insert_pendaftaran($data_pendaftaran){
		$insert = $this->db->insert('t_fo', $data_pendaftaran);
		return ($insert) ? true : false ;
	}

	public function update_pendaftaran($no_daftar, $data_pendaftaran){
		$this->db->where('no_daftar', $no_daftar);
		$update = $this->db->update('t_fo', $data_pendaftaran);
		return ($update) ? true : false ;
	}

	public function get_no_daftar_baru(){
		/**
		 * query untuk mendapatkan no_urut terakhir
		 */
		$sql = "SELECT * FROM t_fo ORDER BY no_daftar DESC LIMIT 1"; 
		$query = $this->db->query($sql);

		if($query->num_rows() == 0){ 
			$no_daftar_baru = 1; 
		}else{ 
			$no_daftar_baru = $query->result()[0]->no_daftar + 1;
		}

		return $no_daftar_baru;

	}

	public function get_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$query = $this->db->get('t_fo');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}


	public function get_where_status_proses($status_proses, $order = '0'){
		if(is_array($status_proses)){
            foreach ($status_proses as $status_proses){
                $this->db->or_where('status_proses', $status_proses);
            }
        }else{
            $this->db->where('status_proses', $status_proses);
        }
        
        $this->db->order_by('no_daftar');
        $query = $this->db->get('t_fo');
        
        if($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $rows[] = $row;
            }
            return $rows;
        }else{
            return FALSE;
        }

	}

	public function set_status_proses($no_daftar, $status_proses){
		$this->db->where('no_daftar', $no_daftar);
		$query = $this->db->update('t_fo', array(
			'status_proses' => $status_proses
		));
		return ($query) ? true : false;
	}

	public function tolak_verifikasi_i($no_daftar, $pesan_tolak_v_i){
		$this->set_status_proses($no_daftar, 3);
		$data = array(
               'pesan_tolak_v_i' => $pesan_tolak_v_i,
        );
		$this->db->where('no_daftar', $no_daftar);
		$update = $this->db->update('t_fo', $data); 

		if($update){
			return true;
		}else{
			return false;
		}		
	}

	public function tolak_verifikasi_ii($no_daftar, $pesan_tolak_v_ii){
		$this->set_status_proses($no_daftar, 9);
		$data = array(
               'pesan_tolak_v_ii' => $pesan_tolak_v_ii,
        );
		$this->db->where('no_daftar', $no_daftar);
		$update = $this->db->update('t_fo', $data); 

		if($update){
			return true;
		}else{
			return false;
		}		
	}

	public function get_id_sub_modul($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$this->db->select('id_sub_modul');
		$query = $this->db->get('t_fo');
		if($query->num_rows() > 0){
            return $query->result()[0]->id_sub_modul;
        }else{
            return FALSE;
        }
	}
}