<?php

class M_sipl extends CI_Model{



	function __construct(){
		parent::__construct();
		$this->load->model('m_kel');
		$this->load->model('m_kec');
		$this->load->model('m_kbli');
		$this->load->model('m_fo');
	}

	public function hapus_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$delete = $this->db->delete('t_sipl');
		if($delete){
			return true;
		}else{
			return false;
		}

	}

	public function get_no_sk_where_no_daftar($no_daftar){
		
		$this->db->where('no_daftar', $no_daftar);
		$this->db->select('no_sk');
		$query = $this->db->get('t_sipl');
		if($query->num_rows() > 0){
            return $query->result()[0]->no_sk;
        }else{
            return FALSE;
        }
	}

	public function apakah_no_sk_sudah_digunakan($no_sk){

		$this->db->select('no_sk');
		$this->db->where('no_sk', $no_sk);
		$query = $this->db->get('t_sipl');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function get_where_no_urut($no_urut){
		$this->db->where('no_urut', $no_urut);
		$query = $this->db->get('t_sipl');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$query = $this->db->get('t_sipl');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_like_no_sk($no_sk){
		
		$sql = "select * from t_sipl where no_sk like '%$no_sk%'";
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
		$update = $this->db->update('t_sipl', array(
			'status_berlaku' => $status_berlaku
		));
		return ($update) ? true :false ;
	}

	public function get_where_no_sk($no_sk){
		
		$sql = "select * from t_sipl where no_sk = '$no_sk' and status_berlaku = 1";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
            
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_sk_2($no_sk){
		
		$sql = "select * from t_sipl where no_sk = '$no_sk'";
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
		$sql = "SELECT * FROM t_sipl ORDER BY no_urut DESC LIMIT 1"; 
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

		$insert = $this->db->insert('t_sipl', array(
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

		$insert = $this->db->insert('t_sipl', array(
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
		$update = $this->db->update('t_sipl', $array_update);
		return ($update) ? true : false;
	}

	public function cetak_sipl_baru($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/sipl_baru.docx");

        $data  = $this->m_sipl->get_where_no_daftar($no_daftar);

        $template->setValue('no_sk', $data->no_sk);

        $template->setValue('nama_pemilik', strtoupper($data->nama_pemilik));
       	$template->setValue('nama_perusahaan', strtoupper($data->nama_perusahaan));
        $template->setValue('alamat_lengkap_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));


        $template->setValue('tanggal_permohonan', strtoupper( convert_tanggal_jadi_string($data->tanggal_daftar)));


    	$template->setValue('jenis_limbah', ucwords(strtolower($data->jenis_limbah)));
    	$template->setValue('jumlah_ton', $data->jumlah_ton);
    	$template->setValue('jumlah_ton_terbilang', terbilang($data->jumlah_ton));

    	$template->setValue('alamat_lengkap_penyimpanan', ucwords(strtolower($data->alamat_penyimpanan .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_penyimpanan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_penyimpanan))));

    	$template->setValue('maksud_penyimpanan', $data->maksud_penyimpanan);
    	$template->setValue('waktu_keberangkatan', convert_tanggal_jadi_string($data->waktu_keberangkatan));

    	$template->setValue('dipindahkan_kepada', $data->dipindahkan_kepada);
    	$template->setValue('alamat_pindah', $data->alamat_pindah);
    	$template->setValue('jumlah_ton_pindah', $data->jumlah_ton_pindah);
    	$template->setValue('jumlah_ton_pindah_terbilang', terbilang($data->jumlah_ton_pindah));
    	
    	$template->setValue('kendaraan_angkutan', $data->kendaraan_angkutan);
    	$template->setValue('nopol_kendaraan', $data->nopol_kendaraan);
    	$template->setValue('lokasi_penyimpanan_pindah', $data->lokasi_penyimpanan_pindah);
    	$template->setValue('maksud_penyimpanan_pindah', $data->maksud_penyimpanan_pindah);

    	
    	$array_keterangan_barang  = explode('|', $data->keterangan_barang);
    	
    	$no = 1;

    	$num_rows = count($array_keterangan_barang);
    	for($i = 0; $i < $num_rows; $i++){
       		if($array_keterangan_barang[$i] == '' or empty($array_keterangan_barang[$i])){
       			unset($array_keterangan_barang[$i]);
       		}
       	}

       	echo "<pre>".print_r($array_keterangan_barang, true)."</pre>";

    	$num_rows_2 = count($array_keterangan_barang);
        $template->cloneRow('keterangan_barang', $num_rows_2);
        
        $no = 1;

        for($i = 0; $i < $num_rows_2; $i++){
        	if($array_keterangan_barang[$i] != '' or !empty($array_keterangan_barang[$i])){
        		$template->setValue("keterangan_barang#$no", $array_keterangan_barang[$i]);	
        	}
            $no++;
        }

        
        
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/sipl_baru.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/sipl_baru.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_sipl_perpanjangan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/sipl_perpanjangan.docx");

        $data  = $this->m_sipl->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', $data->nama_pemilik);
        $template->setValue('value3', $data->npwpd_npwrd);
        $template->setValue('value4', ucwords(strtolower($data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_pemilik) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_pemilik))));
        $template->setValue('value5', strtoupper($data->nama_perusahaan));
        $template->setValue('value6', ucwords(strtolower($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('value7', strtoupper($data->no_telp));
        $template->setValue('value8', $data->panjang_tempat_usaha .' x '. $data->lebar_tempat_usaha);
        $template->setValue('value8b', $data->panjang_tempat_usaha * $data->lebar_tempat_usaha);
        $template->setValue('value9', ucwords(strtolower($this->m_bidang_sipl->get_nama_bidang_sipl($data->id_bidang_sipl))));
        $template->setValue('value11', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template->setValue('value12', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/sipl_perpanjangan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/sipl_perpanjangan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_sipl_perubahan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/sipl_perubahan.docx");

        $data  = $this->m_sipl->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', $data->nama_pemilik);
        $template->setValue('value3', $data->npwpd_npwrd);
        $template->setValue('value4', ucwords(strtolower($data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_pemilik) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_pemilik))));
        $template->setValue('value5', strtoupper($data->nama_perusahaan));
        $template->setValue('value6', ucwords(strtolower($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('value7', strtoupper($data->no_telp));
        $template->setValue('value8', $data->panjang_tempat_usaha .' x '. $data->lebar_tempat_usaha);
        $template->setValue('value8b', $data->panjang_tempat_usaha * $data->lebar_tempat_usaha);
        $template->setValue('value9', ucwords(strtolower($this->m_bidang_sipl->get_nama_bidang_sipl($data->id_bidang_sipl))));
        $template->setValue('value11', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template->setValue('value12', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/sipl_perubahan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/sipl_perubahan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	
}