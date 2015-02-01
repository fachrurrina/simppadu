<?php

class M_siujk extends CI_Model{



	function __construct(){
		parent::__construct();
		$this->load->model('m_kel');
		$this->load->model('m_kec');
		$this->load->model('m_kbli');
		$this->load->model('m_fo');
	}

	public function hapus_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$delete = $this->db->delete('t_siujk');
		if($delete){
			return true;
		}else{
			return false;
		}

	}

	public function get_no_sk_where_no_daftar($no_daftar){
		
		$this->db->where('no_daftar', $no_daftar);
		$this->db->select('no_sk');
		$query = $this->db->get('t_siujk');
		if($query->num_rows() > 0){
            return $query->result()[0]->no_sk;
        }else{
            return FALSE;
        }
	}

	public function apakah_no_sk_sudah_digunakan($no_sk){

		$this->db->select('no_sk');
		$this->db->where('no_sk', $no_sk);
		$query = $this->db->get('t_siujk');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function get_where_no_urut($no_urut){
		$this->db->where('no_urut', $no_urut);
		$query = $this->db->get('t_siujk');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$query = $this->db->get('t_siujk');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_like_no_sk($no_sk){
		
		$sql = "select * from t_siujk where no_sk like '%$no_sk%'";
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
		$update = $this->db->update('t_siujk', array(
			'status_berlaku' => $status_berlaku
		));
		return ($update) ? true :false ;
	}

	public function get_where_no_sk($no_sk){
		
		$sql = "select * from t_siujk where no_sk = '$no_sk' and status_berlaku = 1";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
            
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_sk_2($no_sk){
		
		$sql = "select * from t_siujk where no_sk = '$no_sk'";
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
		$sql = "SELECT * FROM t_siujk ORDER BY no_urut DESC LIMIT 1"; 
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

		$insert = $this->db->insert('t_siujk', array(
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

		$insert = $this->db->insert('t_siujk', array(
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
		$update = $this->db->update('t_siujk', $array_update);
		return ($update) ? true : false;
	}

	public function cetak_siujk_baru($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/siujk_baru.docx");

        $data  = $this->m_siujk->get_where_no_daftar($no_daftar);

        $template->setValue('no_sk', $data->no_sk);
        $template->setValue('nama_perusahaan', $data->nama_perusahaan);
        $template->setValue('kualifikasi', $data->kualifikasi);
        $template->setValue('alamat_lengkap_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('rt_perusahaan', $data->rt_perusahaan);
        $template->setValue('rw_perusahaan', $data->rw_perusahaan);
        $template->setValue('kode_pos', $data->kode_pos);
        $template->setValue('no_telp', $data->no_telp);
        $template->setValue('no_fax', $data->no_fax);
        $template->setValue('nama_pemilik', $data->nama_pemilik);
        $template->setValue('npwp', $data->npwp);

        $array_id_bidang_siujk = explode('|', $data->id_bidang_siujk);
        $num_rows_2 = count($array_id_bidang_siujk);
        $template->cloneRow('nama_bidang_siujk', $num_rows_2);
        
        $no = 1;

        for($i = 0; $i < $num_rows_2; $i++){
        	if($array_id_bidang_siujk[$i] != '' or !empty($array_id_bidang_siujk[$i])){
        		$template->setValue("nama_bidang_siujk#$no", $this->m_bidang_siujk->get_nama_bidang_siujk($array_id_bidang_siujk[$i]));	
        	}
            $no++;
        }



        
        $template->setValue('tanggal_perpanjangan', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/siujk_baru.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/siujk_baru.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_siujk_perpanjangan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/siujk_perpanjangan.docx");

        $data  = $this->m_siujk->get_where_no_daftar($no_daftar);

        $template->setValue('no_sk', $data->no_sk);
        $template->setValue('nama_perusahaan', $data->nama_perusahaan);
        $template->setValue('kualifikasi', $data->kualifikasi);
        $template->setValue('alamat_lengkap_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('rt_perusahaan', $data->rt_perusahaan);
        $template->setValue('rw_perusahaan', $data->rw_perusahaan);
        $template->setValue('kode_pos', $data->kode_pos);
        $template->setValue('no_telp', $data->no_telp);
        $template->setValue('no_fax', $data->no_fax);
        $template->setValue('nama_pemilik', $data->nama_pemilik);
        $template->setValue('npwp', $data->npwp);

        $array_id_bidang_siujk = explode('|', $data->id_bidang_siujk);
        $num_rows_2 = count($array_id_bidang_siujk);
        $template->cloneRow('nama_bidang_siujk', $num_rows_2);
        
        $no = 1;

        for($i = 0; $i < $num_rows_2; $i++){
        	if($array_id_bidang_siujk[$i] != '' or !empty($array_id_bidang_siujk[$i])){
        		$template->setValue("nama_bidang_siujk#$no", $this->m_bidang_siujk->get_nama_bidang_siujk($array_id_bidang_siujk[$i]));	
        	}
            $no++;
        }



        
        $template->setValue('tanggal_perpanjangan', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/siujk_perpanjangan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/siujk_perpanjangan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_siujk_perubahan($no_daftar){

		$this->load->library('phpword');
		
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/siujk_perubahan.docx");

        $data  = $this->m_siujk->get_where_no_daftar($no_daftar);

        $template->setValue('no_sk', $data->no_sk);
        $template->setValue('nama_perusahaan', $data->nama_perusahaan);
        $template->setValue('kualifikasi', $data->kualifikasi);
        $template->setValue('alamat_lengkap_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('rt_perusahaan', $data->rt_perusahaan);
        $template->setValue('rw_perusahaan', $data->rw_perusahaan);
        $template->setValue('kode_pos', $data->kode_pos);
        $template->setValue('no_telp', $data->no_telp);
        $template->setValue('no_fax', $data->no_fax);
        $template->setValue('nama_pemilik', $data->nama_pemilik);
        $template->setValue('npwp', $data->npwp);

        $array_id_bidang_siujk = explode('|', $data->id_bidang_siujk);
        $num_rows_2 = count($array_id_bidang_siujk);
        $template->cloneRow('nama_bidang_siujk', $num_rows_2);
        
        $no = 1;

        for($i = 0; $i < $num_rows_2; $i++){
        	if($array_id_bidang_siujk[$i] != '' or !empty($array_id_bidang_siujk[$i])){
        		$template->setValue("nama_bidang_siujk#$no", $this->m_bidang_siujk->get_nama_bidang_siujk($array_id_bidang_siujk[$i]));	
        	}
            $no++;
        }

        $template->setValue('tanggal_perpanjangan', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/siujk_perubahan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/siujk_perubahan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	
}