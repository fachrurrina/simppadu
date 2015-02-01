<?php

class M_imb extends CI_Model{



	function __construct(){
		parent::__construct();
		$this->load->model('m_kel');
		$this->load->model('m_kec');
		$this->load->model('m_kbli');
		$this->load->model('m_fo');
	}

    public function get_no_sk_where_no_daftar($no_daftar){
        
        $this->db->where('no_daftar', $no_daftar);
        $this->db->select('no_sk');
        $query = $this->db->get('t_imb');
        if($query->num_rows() > 0){
            return $query->result()[0]->no_sk;
        }else{
            return FALSE;
        }
    }

	public function apakah_no_sk_sudah_digunakan($no_sk){

		$this->db->select('no_sk');
		$this->db->where('no_sk', $no_sk);
		$query = $this->db->get('t_imb');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function get_where_no_urut($no_urut){
		$this->db->where('no_urut', $no_urut);
		$query = $this->db->get('t_imb');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$query = $this->db->get('t_imb');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_like_no_sk($no_sk){
		
		$sql = "select * from t_imb where no_sk like '%$no_sk%'";
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
		$update = $this->db->update('t_imb', array(
			'status_berlaku' => $status_berlaku
		));
		return ($update) ? true :false ;
	}

	public function get_where_no_sk($no_sk){
        
        $sql = "select * from t_imb where no_sk = '$no_sk' and status_berlaku = 1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            
            return $query->result()[0];
        }else{
            return FALSE;
        }
    }

    public function get_where_no_sk_2($no_sk){
        
        $sql = "select * from t_imb where no_sk = '$no_sk'";
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
		$sql = "SELECT * FROM t_imb ORDER BY no_urut DESC LIMIT 1"; 
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

		$insert = $this->db->insert('t_imb', array(
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

		$insert = $this->db->insert('t_imb', array(
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
		$update = $this->db->update('t_imb', $array_update);
		return ($update) ? true : false;
	}

	public function cetak_imb_baru($no_daftar){

		$this->load->library('phpword');

		$data  = $this->m_imb->get_where_no_daftar($no_daftar);


		/* awal imb_baru.docx */
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/imb_baru.docx");

        $template->setValue('no_sk', $data->no_sk);        
        
        $template->setValue('nama_pemilik', ucwords($data->nama_pemilik));
        $template->setValue('alamat_pemilik', ucwords($data->alamat_pemilik));
        $template->setValue('nama_kel_pemilik', ucwords($this->m_kel->get_nm_kel($data->id_kel_pemilik)));
        $template->setValue('nama_kec_pemilik', ucwords($this->m_kec->get_nm_kec($data->id_kec_pemilik)));
        $template->setValue('jumlah_bangunan', '1');
        $template->setValue('jumlah_bangunan_terbilang', 'Satu');
        $template->setValue('satuan_bangunan', ucwords($this->m_jenis_bangunan->get_satuan_jenis_bangunan($data->id_jenis_bangunan)));
        $template->setValue('jenis_bangunan', $this->m_jenis_bangunan->get_nama_jenis_bangunan($data->id_jenis_bangunan));
        $template->setValue('jenis_bangunan_harga_dasar', $this->m_harga_dasar_bangunan->get_jenis_bangunan_harga_dasar($data->id_harga_dasar));
        $template->setValue('tingkat_bangunan', $this->m_koif_tingkat->get_jumlah_tingkat($data->id_koif_tingkat));
        $template->setValue('tingkat_bangunan_terbilang', terbilang($this->m_koif_tingkat->get_jumlah_tingkat($data->id_koif_tingkat)));
        $template->setValue('luas_bangunan', $data->luas_bangunan);

        $template->setValue('alamat_bangunan', ucwords($data->alamat_bangunan));
        $template->setValue('nama_kel_bangunan', ucwords($this->m_kel->get_nm_kel($data->id_kel_bangunan)));
        $template->setValue('nama_kec_bangunan', ucwords($this->m_kec->get_nm_kec($data->id_kec_bangunan)));

        $template->setValue('nilai_retribusi', $data->nilai_retribusi);
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));




        

        $template->save(APPPATH. '../saved/imb_baru.docx');
        
        /* akhir imb_baru.docx */


        /* awal imb_baru_sk.docx */

        


        /*$template2->save(APPPATH. '../saved/imb_baru_sk.docx');*/
        $this->m_fo->set_status_proses($no_daftar, 11);


        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/imb_baru.docx';
            /*setTimeout(function(){
            	window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/imb_baru_sk.docx';
            	setTimeout(function(){
            		window.location = '<?php echo site_url("c_cetak/belum") ?>';
            	}, 3000);*/
            /*}, 3000);*/
        </script>
        <?php 
	}

	public function cetak_imb_perpanjangan($no_daftar){

		$this->load->library('phpword');

        $data  = $this->m_imb->get_where_no_daftar($no_daftar);


        /* awal imb_baru.docx */
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/ho_perpanjangan.docx");

        $template->setValue('no_sk', $data->no_sk);        
        
        $template->setValue('nama_pemilik', ucwords($data->nama_pemilik));
        $template->setValue('nama_perusahaan', ucwords($data->nama_perusahaan));
        $template->setValue('alamat_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gampong. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('npwpd_npwrd', strtoupper($data->npwpd_npwrd));

        $array_ket_luas_tempat_usaha = explode('|', $data->ket_luas_tempat_usaha);
        $array_panjang_tempat_usaha = explode('|', $data->panjang_tempat_usaha);
        $array_lebar_tempat_usaha   = explode('|', $data->lebar_tempat_usaha);

        


        $num_rows = count($array_panjang_tempat_usaha);
        $template->cloneRow('ket_luas_tempat_usaha', $num_rows);

        
        $no = 1;
        $total_luas_tempat_usaha = 0;

        for($i = 0; $i < $num_rows; $i++){
            $template->setValue("ket_luas_tempat_usaha#$no", $array_ket_luas_tempat_usaha[$i]); 
            $template->setValue("panjang_tempat_usaha#$no", $array_panjang_tempat_usaha[$i]); 
            $template->setValue("lebar_tempat_usaha#$no", $array_lebar_tempat_usaha[$i]); 
            $template->setValue("luas_tempat_usaha#$no", $array_panjang_tempat_usaha[$i] * $array_lebar_tempat_usaha[$i]);

            $total_luas_tempat_usaha += ($array_panjang_tempat_usaha[$i] * $array_lebar_tempat_usaha[$i]);
            $no++;
        }

        $template->setValue('total_luas_tempat_usaha', $total_luas_tempat_usaha. ' M2');

        if($data->tinggi_tower > 0){
            $template->setValue('no_custom_1', '6.');
            $template->setValue('label_tinggi_tower', 'Tinggi Tower');
            $template->setValue('titik_dua_tinggi_tower', ':');
            $template->setValue('tinggi_tower', $data->tinggi_tower. 'M');

            $template->setValue('no_custom_2', '7.');
            $template->setValue('status_kepemilikan_tanah', ucwords($data->status_kepemilikan_tanah));

            $template->setValue('no_custom_3', '8.');
        }else{
            $template->setValue('no_custom_1', '');
            $template->setValue('label_tinggi_tower', '');
            $template->setValue('titik_dua_tinggi_tower', '');
            $template->setValue('tinggi_tower', '');

            $template->setValue('no_custom_2', '6.');
            $template->setValue('status_kepemilikan_tanah', ucwords($data->status_kepemilikan_tanah));

            $template->setValue('no_custom_3', '7.');
        }
        
        
        $template->setValue('batas_utara', ucwords($data->batas_utara));
        $template->setValue('batas_selatan', ucwords($data->batas_selatan));
        $template->setValue('batas_barat', ucwords($data->batas_barat));
        $template->setValue('batas_timur', ucwords($data->batas_timur));
        $template->setValue('nama_bidang_usaha', strtoupper($data->nama_bidang_usaha));

        if($data->mesin_penggerak == ''){
            $mesin_penggerak = 'tidak menggunakan mesin penggerak/genset';
        }else{
            $mesin_penggerak = 'menggunakan mesin penggerak/genset '. $data->mesin_penggerak .' berbahan bakar '. $data->bahan_bakar;
        }
        $template->setValue('mesin_penggerak', $mesin_penggerak);
        $template->setValue('pembangkit_listrik', $data->pembangkit_listrik);
        $template->setValue('tanggal_perpanjangan', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template->setValue('tanggal_daftar_ulang', convert_tanggal_jadi_string($data->tanggal_daftar_ulang));
        $template->setValue('nilai_retribusi', $data->nilai_retribusi);
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));

        if($data->jenis_kelamin_pemilik == 1){
            $template->setValue('jenis_kelamin_pemilik', 'sdr'); 
        }else{
            $template->setValue('jenis_kelamin_pemilik', 'sdri');
        }

        $template->save(APPPATH. '../saved/ho_perpanjangan.docx');
        
        /* akhir ho_perpanjangan.docx */


        /* awal imb_baru_sk.docx */

        $template2 = $this->phpword->loadTemplate(APPPATH ."../templates/imb_baru_sk.docx");
        $template2->setValue('no_sk', $data->no_sk);
        
        if($data->jenis_kelamin_pemilik == 1){
            $jenis_kelamin_pemilik = "Saudara";
        }else{
            $jenis_kelamin_pemilik = "Saudari";
        }
        $template2->setValue('jenis_kelamin_pemilik', $jenis_kelamin_pemilik);

        $template2->setValue('nama_pemilik', strtoupper(strtolower($data->nama_pemilik)));
        $template2->setValue('pekerjaan_pemilik', ucwords(strtolower($data->pekerjaan_pemilik)));
        $template2->setValue('alamat_pemilik', ucwords(strtolower($data->alamat_pemilik .' Gampong. '. $this->m_kel->get_nm_kel($data->id_kel_pemilik) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_pemilik))));
        $template2->setValue('tanggal_permohonan', convert_tanggal_jadi_string($data->tanggal_permohonan));
        $template2->setValue('nama_bidang_imb', strtoupper($data->nama_bidang_usaha));
        $template2->setValue('alamat_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gampong. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template2->setValue('nama_perusahaan', strtoupper($data->nama_perusahaan));
        $template2->setValue('nama_kel_perusahaan', ucwords(strtolower($this->m_kel->get_nm_kel($data->id_kel_perusahaan))));
        $template2->setValue('nama_kec_perusahaan', ucwords(strtolower($this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template2->setValue('no_surat_ket_usaha', $data->no_surat_ket_usaha);
        $template2->setValue('tanggal_surat_ket_usaha', convert_tanggal_jadi_string($data->tanggal_surat_ket_usaha));
        $template2->setValue('tanggal_surat_pernyataan_lingkungan', convert_tanggal_jadi_string($data->tanggal_surat_pernyataan_lingkungan));
        $template2->setValue('tanggal_peninjauan_lapangan', convert_tanggal_jadi_string($data->tanggal_peninjauan_lapangan));
        $template2->setValue('npwpd_npwrd', $data->npwpd_npwrd);
        
        $array_ket_luas_tempat_usaha = explode('|', $data->ket_luas_tempat_usaha);
        $array_panjang_tempat_usaha = explode('|', $data->panjang_tempat_usaha);
        $array_lebar_tempat_usaha   = explode('|', $data->lebar_tempat_usaha);

        $num_rows = count($array_panjang_tempat_usaha);
        $template2->cloneRow('ket_luas_tempat_usaha', $num_rows);

        
        $no = 1;
        $total_luas_tempat_usaha = 0;

        for($i = 0; $i < $num_rows; $i++){
            $template2->setValue("ket_luas_tempat_usaha#$no", $array_ket_luas_tempat_usaha[$i]); 
            $template2->setValue("panjang_tempat_usaha#$no", $array_panjang_tempat_usaha[$i]); 
            $template2->setValue("lebar_tempat_usaha#$no", $array_lebar_tempat_usaha[$i]); 
            $template2->setValue("luas_tempat_usaha#$no", $array_panjang_tempat_usaha[$i] * $array_lebar_tempat_usaha[$i]);

            $total_luas_tempat_usaha += ($array_panjang_tempat_usaha[$i] * $array_lebar_tempat_usaha[$i]);
            $no++;
        }

        $template2->setValue('total_luas_tempat_usaha', $total_luas_tempat_usaha. ' M2');

        if($data->tinggi_tower > 0){
            $template2->setValue('no_custom_1', '6.');
            $template2->setValue('label_tinggi_tower', 'Tinggi Tower');
            $template2->setValue('titik_dua_tinggi_tower', ':');
            $template2->setValue('tinggi_tower', $data->tinggi_tower. 'M');

            $template2->setValue('no_custom_2', '7.');
            $template2->setValue('status_kepemilikan_tanah', ucwords($data->status_kepemilikan_tanah));

            $template2->setValue('no_custom_3', '8.');
        }else{
            $template2->setValue('no_custom_1', '');
            $template2->setValue('label_tinggi_tower', '');
            $template2->setValue('titik_dua_tinggi_tower', '');
            $template2->setValue('tinggi_tower', '');

            $template2->setValue('no_custom_2', '6.');
            $template2->setValue('status_kepemilikan_tanah', ucwords($data->status_kepemilikan_tanah));

            $template2->setValue('no_custom_3', '7.');
        }

        
        $template2->setValue('batas_utara', ucwords($data->batas_utara));
        $template2->setValue('batas_selatan', ucwords($data->batas_selatan));
        $template2->setValue('batas_barat', ucwords($data->batas_barat));
        $template2->setValue('batas_timur', ucwords($data->batas_timur));
        if($data->mesin_penggerak == ''){
            $mesin_penggerak = 'Usaha '. ucwords(strtolower($data->nama_bidang_usaha)) . ' tersebut tidak menggunakan mesin penggerak/genset';
        }else{
            $mesin_penggerak = 'Usaha '. ucwords(strtolower($data->nama_bidang_usaha)) . ' tersebut menggunakan mesin penggerak/genset '. $data->mesin_penggerak .' berbahan bakar '. $data->bahan_bakar;
        }
        $template2->setValue('mesin_penggerak', $mesin_penggerak);
        $template2->setValue('pembangkit_listrik', $data->pembangkit_listrik);
        $template2->setValue('tanggal_perpanjangan', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template2->setValue('tanggal_daftar_ulang', convert_tanggal_jadi_string($data->tanggal_daftar_ulang));
        $template2->setValue('nilai_retribusi', $data->nilai_retribusi);
        $template2->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template2->save(APPPATH. '../saved/imb_baru_sk.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/ho_perpanjangan.docx';
            setTimeout(function(){
                window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/imb_baru_sk.docx';
                setTimeout(function(){
                    window.location = '<?php echo site_url("c_cetak/belum") ?>';
                }, 3000);
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_imb_perubahan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/ho_perubahan.docx");

        $data  = $this->m_imb->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', $data->nama_pemilik);
        $template->setValue('value3', $data->npwpd_npwrd);
        $template->setValue('value4', ucwords(strtolower($data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_pemilik) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_pemilik))));
        $template->setValue('value5', strtoupper($data->nama_perusahaan));
        $template->setValue('value6', ucwords(strtolower($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('value7', strtoupper($data->no_telp));
        $template->setValue('value8', $data->panjang_tempat_usaha .' x '. $data->lebar_tempat_usaha);
        $template->setValue('value8b', $data->panjang_tempat_usaha * $data->lebar_tempat_usaha);
        $template->setValue('value9', ucwords(strtolower($this->m_bidang_imb->get_nama_bidang_imb($data->id_bidang_imb))));
        $template->setValue('value11', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template->setValue('value12', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/ho_perubahan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/ho_perubahan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_ssrd_perpanjangan($no_daftar){

        //load our new PHPExcel library
        $this->load->library('excel_iofactory');

        $data = $this->m_fo->get_where_no_daftar($no_daftar);
        
        // echo "<pre>";
        // print_r($this->excel_iofactory);
        // echo "</pre>";
        
        $objReader = $this->excel_iofactory;
        $objReader = $objReader::createReader('Excel2007');
        $objPHPExcel = $objReader->load(APPPATH. '../templates/ssrd_imb_perpanjangan.xlsx');

        $nama_perusahaan = $data->ho_perpanjangan_nama_perusahaan;
        $objPHPExcel->getActiveSheet()->setCellValue('E9', "$nama_perusahaan");

        $alamat_perusahaan = strtoupper($data->ho_perpanjangan_alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->ho_perpanjangan_id_kel_perusahaan). ' Kec. '. $this->m_kec->get_nm_kec($data->ho_perpanjangan_id_kec_perusahaan));
        $objPHPExcel->getActiveSheet()->setCellValue('E11', "$alamat_perusahaan");

        
        $lokasi = $this->m_index_lokasi->get_nama_index_lokasi($data->ho_perpanjangan_kode_index_lokasi);
        $objPHPExcel->getActiveSheet()->setCellValue('D28', "$lokasi");
        
        $array_panjang_tempat_usaha = explode('|', $data->ho_perpanjangan_panjang_tempat_usaha);
        $array_lebar_tempat_usaha   = explode('|', $data->ho_perpanjangan_lebar_tempat_usaha);
        $total_panjang              = 0;
        $total_lebar                = 0;

        for($i = 0; $i < count($array_panjang_tempat_usaha); $i++){
            $total_panjang += $array_panjang_tempat_usaha[$i];
            $total_lebar   += $array_lebar_tempat_usaha[$i];
        }

        $luas = $total_panjang * $total_lebar;
        $objPHPExcel->getActiveSheet()->setCellValue('E29', "$luas");


        $tinggi_tower = $data->ho_perpanjangan_tinggi_tower;
        if($tinggi_tower > 0){
            $objPHPExcel->getActiveSheet()->setCellValue('L29', "Tinggi Tower : $tinggi_tower  M");
        }
        

        // $bidang = $this->m_bidang_imb->get_nama_bidang_imb($data->ho_perpanjangan_id_bidang);
        $bidang_usaha = $data->ho_perpanjangan_nama_bidang_usaha;
        $objPHPExcel->getActiveSheet()->setCellValue('D30', "$bidang_usaha");
        
        $nilai_index_lokasi      = $this->m_index_lokasi->get_nilai($data->ho_perpanjangan_kode_index_lokasi);
        $nilai_index_luas        = $this->m_index_luas->get_nilai($data->ho_perpanjangan_kode_index_luas);
        $nilai_index_gangguan    = $this->m_index_gangguan->get_nilai($data->ho_perpanjangan_kode_index_gangguan);
        $nilai_index_harga_dasar = $this->m_index_harga_dasar->get_nilai($data->ho_perpanjangan_kode_index_harga_dasar);

        $nilai_retribusi = $data->ho_perpanjangan_nilai_retribusi;

        $objPHPExcel->getActiveSheet()->setCellValue('D32', "$nilai_index_lokasi");
        $objPHPExcel->getActiveSheet()->setCellValue('F32', "$nilai_index_luas");
        $objPHPExcel->getActiveSheet()->setCellValue('H32', "$nilai_index_gangguan");
        $objPHPExcel->getActiveSheet()->setCellValue('K32', "$nilai_index_harga_dasar");

        $objPHPExcel->getActiveSheet()->setCellValue('P32', "$nilai_retribusi");

        $objPHPExcel->getActiveSheet()->setCellValue('X27', "$nilai_retribusi");        
        $objPHPExcel->getActiveSheet()->setCellValue('X38', "$nilai_retribusi");      

        $nilai_retribusi_terbilang = strtoupper(terbilang($nilai_retribusi));
        $objPHPExcel->getActiveSheet()->setCellValue('D40', "$nilai_retribusi_terbilang");

        $objPHPExcel->getActiveSheet()->setCellValue('L47', date('d-m-Y')); 
        $objPHPExcel->getActiveSheet()->setCellValue('W44', 'BIREUEN, '.date('d-m-Y'));  

        $nama_pemilik = strtoupper($data->ho_perpanjangan_nama_pemilik);
        $objPHPExcel->getActiveSheet()->setCellValue('W49', $nama_pemilik);     

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(APPPATH. '../saved/ssrd_imb_perpanjangan.xlsx');

         ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/ssrd_imb_perpanjangan.xlsx';
            setTimeout(function(){
                window.location = '<?php echo site_url("c_penetapan/belum_lunas") ?>';
            }, 3000);
        </script>
        <?php 
    }


     public function cetak_ssrd_baru($no_daftar){

        //load our new PHPExcel library
        $this->load->library('excel_iofactory');

        $data = $this->m_fo->get_where_no_daftar($no_daftar);
        

        

        $objReader = $this->excel_iofactory;
        $objReader = $objReader::createReader('Excel2007');
        $objPHPExcel = $objReader->load(APPPATH. '../templates/ssrd_imb_baru.xlsx');

        $nama_pemilik = $data->imb_baru_nama_pemilik;
        $objPHPExcel->getActiveSheet()->setCellValue('D10', ": $nama_pemilik");

        $alamat_pemilik = strtoupper($data->imb_baru_alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($data->imb_baru_id_kel_pemilik). ' Kec. '. $this->m_kec->get_nm_kec($data->imb_baru_id_kec_pemilik));
        $objPHPExcel->getActiveSheet()->setCellValue('D12', ": $alamat_pemilik");

        $nama_jenis_bangunan        = $this->m_jenis_bangunan->get_nama_jenis_bangunan($data->imb_baru_id_jenis_bangunan);
        $satuan_jenis_bangunan      = $this->m_jenis_bangunan->get_satuan_jenis_bangunan($data->imb_baru_id_jenis_bangunan);
        $jenis_harga_dasar_bangunan = $this->m_index_harga_dasar->get_nama_harga_dasar_bangunan($data->imb_baru_id_harga_dasar);
        $objPHPExcel->getActiveSheet()->setCellValue('D28', "Retribusi IMB Pembangunan 1 (satu) $satuan_jenis_bangunan $nama_jenis_bangunan $jenis_harga_dasar_bangunan ");


        $jumlah_tingkat_bangunan  = $this->m_koif_tingkat->get_jumlah_tingkat($data->imb_baru_id_koif_tingkat);
        $jumlah_tingkat_terbilang = trim(terbilang($jumlah_tingkat_bangunan));
        $alamat_bangunan          = ucwords(strtolower($data->imb_baru_alamat_bangunan));
        $nama_kel_bangunan        = ucwords(strtolower($this->m_kel->get_nm_kel($data->imb_baru_id_kel_bangunan)));
        $objPHPExcel->getActiveSheet()->setCellValue('D29', "Berlantai $jumlah_tingkat_bangunan ($jumlah_tingkat_terbilang) $alamat_bangunan Gampong $nama_kel_bangunan");

        $nama_kec_bangunan        = ucwords(strtolower($this->m_kec->get_nm_kec($data->imb_baru_id_kec_bangunan)));
        $objPHPExcel->getActiveSheet()->setCellValue('D30', "Kecamatan $nama_kec_bangunan Kabupaten Bireuen");
        
        $luas_bangunan = (float) number_format($data->imb_baru_luas_bangunan, 2, '.', ''); // number_format($number, 2, '.', '');
        $objPHPExcel->getActiveSheet()->setCellValue('D31', "Luas Bangunan : $luas_bangunan M2.");


        $nilai_koif_luas    = $this->m_koif_luas->get_nilai_koif_luas($data->imb_baru_id_koif_luas);
        $nilai_koif_tingkat = $this->m_koif_tingkat->get_nilai_koif_tingkat($data->imb_baru_id_koif_tingkat);
        $nilai_koif_guna    = $this->m_koif_guna->get_nilai_koif_guna($data->imb_baru_id_koif_guna);
        $nilai_harga_dasar  = number_format($this->m_harga_dasar_bangunan->get_nilai_harga_dasar($data->imb_baru_id_harga_dasar),2,',','.');
        $nilai_retribusi    = number_format($data->imb_baru_nilai_retribusi,2,',','.');


        
        $objPHPExcel->getActiveSheet()->setCellValue('D32', "$nilai_koif_luas x $nilai_koif_tingkat x $nilai_koif_guna  x Rp. $nilai_harga_dasar,- = Rp.  $nilai_retribusi,-  (Qanun No. 19 Tahun 2010)");

        $objPHPExcel->getActiveSheet()->setCellValue('K28', $nilai_retribusi); 
        $objPHPExcel->getActiveSheet()->setCellValue('K40', $nilai_retribusi);

        $nilai_retribusi_terbilang = ucwords(terbilang($data->imb_baru_nilai_retribusi));
        $objPHPExcel->getActiveSheet()->setCellValue('D42', $nilai_retribusi_terbilang);

        $objPHPExcel->getActiveSheet()->setCellValue('F49', ": ".date('d-m-Y')); 

        $objPHPExcel->getActiveSheet()->setCellValue('J46', 'BIREUEN, '.date('d-m-Y'));  

        $objPHPExcel->getActiveSheet()->setCellValue('J51', "(".$nama_pemilik.")");


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(APPPATH. '../saved/ssrd_imb_baru.xlsx');

         ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/ssrd_imb_baru.xlsx';
            setTimeout(function(){
                window.location = '<?php echo site_url("c_penetapan/belum_lunas") ?>';
            }, 3000);
        </script>
        <?php 
    }

   

	
}