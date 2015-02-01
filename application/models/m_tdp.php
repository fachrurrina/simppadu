<?php

class M_tdp extends CI_Model{


	function __construct(){
		parent::__construct();
		$this->load->model('m_kel');
		$this->load->model('m_kec');
		$this->load->model('m_kbli');
		$this->load->model('m_fo');
	}

    public function hapus_where_no_daftar($no_daftar){
        $this->db->where('no_daftar', $no_daftar);
        $delete = $this->db->delete('t_tdp');
        if($delete){
            return true;
        }else{
            return false;
        }
    }

    public function get_no_sk_where_no_daftar($no_daftar){
        
        $this->db->where('no_daftar', $no_daftar);
        $this->db->select('no_sk');
        $query = $this->db->get('t_tdp');
        if($query->num_rows() > 0){
            return $query->result()[0]->no_sk;
        }else{
            return FALSE;
        }
    }

	public function apakah_no_sk_sudah_digunakan($no_sk){

		$this->db->select('no_sk');
		$this->db->where('no_sk', $no_sk);
		$query = $this->db->get('t_tdp');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function check_no_sk_exist($no_sk){
		$this->db->where('no_sk', $no_sk);

		if($this->db->get('t_tdp')->num_rows() > 1){
			return true;
		}else{
			return false;
		}

	}

	public function get_where_no_urut($no_urut){
		$this->db->where('no_urut', $no_urut);
		$query = $this->db->get('t_tdp');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$query = $this->db->get('t_tdp');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_like_no_sk($no_sk){
		
		$sql = "select * from t_tdp where no_sk like '%$no_sk%'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
            foreach($query->result() as $row){
            	$rows[] = $row;
            }
            return $rows;
        }else{
            return FALSE;
        }
	}

	public function set_status_berlaku($no_daftar, $status_berlaku){
		$this->db->where('no_daftar', $no_daftar);
		$update = $this->db->update('t_tdp', array(
			'status_berlaku' => $status_berlaku
		));
		return ($update) ? true :false ;
	}

	public function get_where_no_sk($no_sk){
        
        $sql = "select * from t_tdp where no_sk = '$no_sk' and status_berlaku = 1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            
            return $query->result()[0];
        }else{
            return FALSE;
        }
    }

    public function get_where_no_sk_2($no_sk){
        
        $sql = "select * from t_tdp where no_sk = '$no_sk'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            
            return $query->result()[0];
        }else{
            return FALSE;
        }
    }

	public function get_no_urut_baru(){
		/**
		 * query untuk mendapatkan no_urut terakhir
		 */
		$sql = "SELECT * FROM t_tdp ORDER BY no_urut DESC LIMIT 1"; 
		$query = $this->db->query($sql);

		if($query->num_rows() == 0){ 
			$no_urut_baru = 1; 
		}else{ 
			$no_urut_baru = $query->result()[0]->no_urut + 1;
		}

		return $no_urut_baru;

	}

	public function pengagendaan_baru(
		$no_daftar,
		$tanggal_daftar, 
		$no_urut, 
		$no_sk, 
		$tanggal_terbit, 
		$tanggal_perpanjangan, 
		$id_kbli){

		$insert = $this->db->insert('t_tdp', array(
			'no_daftar' => $no_daftar,
			'tanggal_daftar' => $tanggal_daftar,
			'no_urut' => $no_urut,
			'no_sk' => $no_sk,
			'tanggal_terbit' => $tanggal_terbit,
			'tanggal_perpanjangan' => $tanggal_perpanjangan,
			'id_kbli' => $id_kbli,
			'alasan_penerbitan' => 'PB',
			'ket' => 'PB',
			'pembaharuan_ke' => 0,
			'status_berlaku' => 1,
			'guna' => 'BARU'
		));

		return ($insert) ? true : false;
	}

	public function pengagendaan_perpanjangan(
		$no_daftar,
		$tanggal_daftar, 
		$no_urut, 
		$no_sk_lalu, 
		$no_sk, 
		$tanggal_terbit, 
		$tanggal_perpanjangan, 
		$id_kbli,
		$alasan_penerbitan){

		$insert = $this->db->insert('t_tdp', array(
			'no_daftar'            => $no_daftar,
			'tanggal_daftar'       => $tanggal_daftar,
			'no_urut'              => $no_urut,
			'no_sk_lalu'           => $no_sk_lalu,
			'no_sk'                => $no_sk,
			'tanggal_terbit'       => $tanggal_terbit,
			'tanggal_perpanjangan' => $tanggal_perpanjangan,
			'id_kbli'              => $id_kbli,
			'alasan_penerbitan'    => $alasan_penerbitan,
			// 'ket'               => 'PB',  # pada perpanjangan dengan kasus PS ket akan di pada operator
			'pembaharuan_ke'       => 0,
			'status_berlaku'       => 1,
			'guna'                 => 'PERPANJANGAN'
		));

		return ($insert) ? true : false;
	}


	public function cetak_tdp_baru($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/tdp_baru.docx");

        $data  = $this->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', strtoupper(convert_tanggal_jadi_string($data->tanggal_perpanjangan)));
        $template->setValue('value3', strtoupper($data->guna));

        switch ($data->pembaharuan_ke) {
            case ($data->pembaharuan_ke > 0 and $data->pembaharuan_ke < 10):
                $template->setValue('value4', '0'.$data->pembaharuan_ke);
                break;
            case ($data->pembaharuan_ke >= 10):
                $template->setValue('value4', $data->pembaharuan_ke);
                break;
            default:
                $template->setValue('value4', "00");
                break;
        }
        
        $template->setValue('value5', strtoupper($data->nama_perusahaan));
        $template->setValue('value6', strtoupper($data->status_perusahaan));
        $template->setValue('value7', strtoupper($data->nama_pemilik));
        $template->setValue('value8', strtoupper($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kec '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan)));
        $template->setValue('value9', $data->npwp);
        $template->setValue('value10', $data->no_telp);
        $template->setValue('value11', $data->no_fax);

        $array_id_kbli = explode(', ', $data->id_kbli);
        foreach ($array_id_kbli as $id_kbli) {
            $array_kegiatan_usaha_utama[] = $this->m_kbli->get_judul_kbli($id_kbli);
        }
        $kegiatan_usaha_utama = implode(', ', $array_kegiatan_usaha_utama);
        $template->setValue('value12', $kegiatan_usaha_utama);
        $template->setValue('value13', $data->id_kbli);
        $template->setValue('value14', strtoupper(convert_tanggal_jadi_string($data->tanggal_terbit)));


        $template->save(APPPATH. '../saved/tdp_baru.docx');

        $this->m_fo->set_status_proses($no_daftar, 11);
        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/tdp_baru.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_tdp_perpanjangan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/tdp_perpanjangan.docx");

        $data  = $this->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', strtoupper(convert_tanggal_jadi_string($data->tanggal_perpanjangan)));
        // $template->setValue('value3', strtoupper($data->guna));

        switch ($data->pembaharuan_ke) {
            case ($data->pembaharuan_ke > 0 and $data->pembaharuan_ke < 10):
                $template->setValue('value4', '0'.$data->pembaharuan_ke);
                break;
            case ($data->pembaharuan_ke >= 10):
                $template->setValue('value4', $data->pembaharuan_ke);
                break;
            default:
                $template->setValue('value4', "00");
                break;
        }
        
        $template->setValue('value5', strtoupper($data->nama_perusahaan));
        $template->setValue('value6', strtoupper($data->status_perusahaan));
        $template->setValue('value7', strtoupper($data->nama_pemilik));
        $template->setValue('value8', strtoupper($data->alamat_perusahaan .' Gampong. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan)));
        $template->setValue('value9', $data->npwp);
        $template->setValue('value10', $data->no_telp);
        $template->setValue('value11', $data->no_fax);

        $array_id_kbli = explode(', ', $data->id_kbli);
        foreach ($array_id_kbli as $id_kbli) {
            $array_kegiatan_usaha_utama[] = $this->m_kbli->get_judul_kbli($id_kbli);
        }
        $kegiatan_usaha_utama = implode(', ', $array_kegiatan_usaha_utama);
        $template->setValue('value12', $kegiatan_usaha_utama);
        $template->setValue('value13', $data->id_kbli);
        $template->setValue('value14', strtoupper(convert_tanggal_jadi_string($data->tanggal_terbit)));


        $template->save(APPPATH. '../saved/tdp_perpanjangan.docx');

        $this->m_fo->set_status_proses($no_daftar, 11);
        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/tdp_perpanjangan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_tdp_perubahan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/tdp_perubahan.docx");

        $data  = $this->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', strtoupper(convert_tanggal_jadi_string($data->tanggal_perpanjangan)));
        // $template->setValue('value3', strtoupper($data->guna));

        switch ($data->pembaharuan_ke) {
            case ($data->pembaharuan_ke > 0 and $data->pembaharuan_ke < 10):
                $template->setValue('value4', '0'.$data->pembaharuan_ke);
                break;
            case ($data->pembaharuan_ke >= 10):
                $template->setValue('value4', $data->pembaharuan_ke);
                break;
            default:
                $template->setValue('value4', "00");
                break;
        }
        
        $template->setValue('value5', strtoupper($data->nama_perusahaan));
        $template->setValue('value6', strtoupper($data->status_perusahaan));
        $template->setValue('value7', strtoupper($data->nama_pemilik));
        $template->setValue('value8', strtoupper($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kec '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan)));
        $template->setValue('value9', $data->npwp);
        $template->setValue('value10', $data->no_telp);
        $template->setValue('value11', $data->no_fax);

        $array_id_kbli = explode(', ', $data->id_kbli);
        foreach ($array_id_kbli as $id_kbli) {
            $array_kegiatan_usaha_utama[] = $this->m_kbli->get_judul_kbli($id_kbli);
        }
        $kegiatan_usaha_utama = implode(', ', $array_kegiatan_usaha_utama);
        $template->setValue('value12', $kegiatan_usaha_utama);
        $template->setValue('value13', $data->id_kbli);
        $template->setValue('value14', strtoupper(convert_tanggal_jadi_string($data->tanggal_terbit)));


        $template->save(APPPATH. '../saved/tdp_perubahan.docx');

        $this->m_fo->set_status_proses($no_daftar, 11);
        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/tdp_perubahan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}
}