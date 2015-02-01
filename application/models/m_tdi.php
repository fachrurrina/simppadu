<?php

class M_tdi extends CI_Model{



	function __construct(){
		parent::__construct();
		$this->load->model('m_kel');
		$this->load->model('m_kec');
		$this->load->model('m_kbli');
		$this->load->model('m_fo');
	}



    public function hapus_where_no_daftar($no_daftar){
        $this->db->where('no_daftar', $no_daftar);
        $delete = $this->db->delete('t_tdi');
        if($delete){
            return true;
        }else{
            return false;
        }

    }

    public function get_no_sk_where_no_daftar($no_daftar){
        
        $this->db->where('no_daftar', $no_daftar);
        $this->db->select('no_sk');
        $query = $this->db->get('t_tdi');
        if($query->num_rows() > 0){
            return $query->result()[0]->no_sk;
        }else{
            return FALSE;
        }
    }

	public function apakah_no_sk_sudah_digunakan($no_sk){

		$this->db->select('no_sk');
		$this->db->where('no_sk', $no_sk);
		$query = $this->db->get('t_tdi');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function get_where_no_urut($no_urut){
		$this->db->where('no_urut', $no_urut);
		$query = $this->db->get('t_tdi');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$query = $this->db->get('t_tdi');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_like_no_sk($no_sk){
		
		$sql = "select * from t_tdi where no_sk like '%$no_sk%'";
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
		$update = $this->db->update('t_tdi', array(
			'status_berlaku' => $status_berlaku
		));
		return ($update) ? true :false ;
	}

	public function get_where_no_sk($no_sk){
        
        $sql = "select * from t_tdi where no_sk = '$no_sk' and status_berlaku = 1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            
            return $query->result()[0];
        }else{
            return FALSE;
        }
    }


    public function get_where_no_sk_2($no_sk){
        
        $sql = "select * from t_tdi where no_sk = '$no_sk'";
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
		$sql = "SELECT * FROM t_tdi ORDER BY no_urut DESC LIMIT 1"; 
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

		$insert = $this->db->insert('t_tdi', array(
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

		$insert = $this->db->insert('t_tdi', array(
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

	public function simpan_baru_operator($no_daftar, $array_update){
		$this->db->where('no_daftar', $no_daftar);
		$update = $this->db->update('t_tdi', $array_update);
		return ($update) ? true : false;
	}

	public function cetak_tdi_baru($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/tdi_baru.docx");

        $data  = $this->m_tdi->get_where_no_daftar($no_daftar);

        $template->setValue('no_sk', $data->no_sk);
        $template->setValue('nama_perusahaan', $data->nama_perusahaan);

        $template->setValue('alamat_lengkap_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan) . ' Kabupaten Bireuen')));
        $template->setValue('npwp', strtoupper($data->npwp));

        $template->setValue('nipik', strtoupper($data->nipik));
        $template->setValue('nama_pemilik', strtoupper($data->nama_pemilik));

        $template->setValue('alamat_lengkap_pemilik', ucwords(strtolower($data->alamat_pemilik .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_pemilik) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_pemilik) . ' Kabupaten Bireuen')));

        // id kbli belum tau cara nya ....
        $kbli = '';
        foreach(explode('|', $data->id_kbli) as $id_kbli){
        	$kbli .= strtoupper($this->m_kbli->get_judul_kbli($id_kbli) . ' (' . $id_kbli .'), ');
        }

		$template->setValue('kbli', $kbli);

        $template->setValue('komoditi_industri', strtoupper($data->komoditi_industri));
        $template->setValue('alamat_pabrik', ucwords(strtolower($data->alamat_pabrik)));
        $template->setValue('nama_kel_pabrik', ucwords(strtolower($this->m_kel->get_nm_kel($data->id_kel_pabrik))));
        $template->setValue('nama_kec_pabrik', ucwords(strtolower($this->m_kec->get_nm_kec($data->id_kec_pabrik))));

        $template->setValue('mesin_utama', ucwords(strtolower($data->mesin_utama)));
        $template->setValue('mesin_pembantu', ucwords(strtolower($data->mesin_pembantu)));
        $template->setValue('tenaga_penggerak', ucwords(strtolower($data->tenaga_penggerak)));

        $template->setValue('nilai_investasi', number_format($data->nilai_investasi, 0 , '' , '.' ));
        $template->setValue('kapasitas_produksi', $data->kapasitas_produksi);
        
        
        
        
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/tdi_baru.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);


        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/tdi_baru.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_tdi_perpanjangan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/tdi_perpanjangan.docx");

        $data  = $this->m_tdi->get_where_no_daftar($no_daftar);

        $template->setValue('no_sk', $data->no_sk);
        $template->setValue('nama_perusahaan', $data->nama_perusahaan);

        $template->setValue('alamat_lengkap_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan) . ' Kabupaten Bireuen')));
        $template->setValue('npwp', strtoupper($data->npwp));

        $template->setValue('nipik', strtoupper($data->nipik));
        $template->setValue('nama_pemilik', strtoupper($data->nama_pemilik));

        $template->setValue('alamat_lengkap_pemilik', ucwords(strtolower($data->alamat_pemilik .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_pemilik) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_pemilik) . ' Kabupaten Bireuen')));

        // id kbli belum tau cara nya ....
        $kbli = '';
        foreach(explode('|', $data->id_kbli) as $id_kbli){
        	$kbli .= strtoupper($this->m_kbli->get_judul_kbli($id_kbli) . ' (' . $id_kbli .'), ');
        }

		$template->setValue('kbli', $kbli);

        $template->setValue('komoditi_industri', strtoupper($data->komoditi_industri));
        $template->setValue('alamat_pabrik', ucwords(strtolower($data->alamat_pabrik)));
        $template->setValue('nama_kel_pabrik', ucwords(strtolower($this->m_kel->get_nm_kel($data->id_kel_pabrik))));
        $template->setValue('nama_kec_pabrik', ucwords(strtolower($this->m_kec->get_nm_kec($data->id_kec_pabrik))));

        $template->setValue('mesin_utama', ucwords(strtolower($data->mesin_utama)));
        $template->setValue('mesin_pembantu', ucwords(strtolower($data->mesin_pembantu)));
        $template->setValue('tenaga_penggerak', ucwords(strtolower($data->tenaga_penggerak)));

        $template->setValue('nilai_investasi', number_format($data->nilai_investasi, 0 , '' , '.' ));
        $template->setValue('kapasitas_produksi', $data->kapasitas_produksi);
        
        
        
        
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/tdi_perpanjangan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/tdi_perpanjangan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_tdi_perubahan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/tdi_perubahan.docx");

        $data  = $this->m_tdi->get_where_no_daftar($no_daftar);

        $template->setValue('no_sk', $data->no_sk);
        $template->setValue('nama_perusahaan', $data->nama_perusahaan);

        $template->setValue('alamat_lengkap_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan) . ' Kabupaten Bireuen')));
        $template->setValue('npwp', strtoupper($data->npwp));

        $template->setValue('nipik', strtoupper($data->nipik));
        $template->setValue('nama_pemilik', strtoupper($data->nama_pemilik));

        $template->setValue('alamat_lengkap_pemilik', ucwords(strtolower($data->alamat_pemilik .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_pemilik) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_pemilik) . ' Kabupaten Bireuen')));

        // id kbli belum tau cara nya ....
        // $kbli = '';
        // foreach(explode('|', $data->id_kbli) as $id_kbli){
        // 	$kbli .= strtoupper($this->m_kbli->get_judul_kbli($id_kbli) . ' (' . $id_kbli .'), ');
        // }



		// $template->setValue('kbli', $kbli);

		$array_kbli = explode('|', $data->id_kbli);

        $num_rows = count($array_kbli);

        $template->cloneRow('kbli', $num_rows);
        
        $no = 1;
        // foreach ($array_koordinat_n as $koordinat_n) {
        //     $template->setValue("koordinat_n#$no", $koordinat_n);
        //     $template->setValue("koordinat_e#$no", $koordinat_e);
        //     $no++;
        // }

        for($i = 0; $i < $num_rows; $i++){
        	$template->setValue("kbli#$no", '- '. $this->m_kbli->get_judul_kbli($array_kbli[$i]). ' ('.$array_kbli[$i].')');
            $no++;
        }



        $template->setValue('komoditi_industri', strtoupper($data->komoditi_industri));
        $template->setValue('alamat_pabrik', ucwords(strtolower($data->alamat_pabrik)));
        $template->setValue('nama_kel_pabrik', ucwords(strtolower($this->m_kel->get_nm_kel($data->id_kel_pabrik))));
        $template->setValue('nama_kec_pabrik', ucwords(strtolower($this->m_kec->get_nm_kec($data->id_kec_pabrik))));

        $template->setValue('mesin_utama', ucwords(strtolower($data->mesin_utama)));
        $template->setValue('mesin_pembantu', ucwords(strtolower($data->mesin_pembantu)));
        $template->setValue('tenaga_penggerak', ucwords(strtolower($data->tenaga_penggerak)));

        $template->setValue('nilai_investasi', number_format($data->nilai_investasi, 0 , '' , '.' ));
        $template->setValue('kapasitas_produksi', $data->kapasitas_produksi);
        
        
        
        
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/tdi_perubahan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/tdi_perubahan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	
}