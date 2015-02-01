<?php

class M_siup extends CI_Model{



	function __construct(){
		parent::__construct();
		$this->load->model('m_kel');
		$this->load->model('m_kec');
		$this->load->model('m_kbli');
		$this->load->model('m_fo');
	}

	public function hapus_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$delete = $this->db->delete('t_siup');
		if($delete){
			return true;
		}else{
			return false;
		}

	}

	public function get_no_sk_where_no_daftar($no_daftar){
		
		$this->db->where('no_daftar', $no_daftar);
		$this->db->select('no_sk');
		$query = $this->db->get('t_siup');
		if($query->num_rows() > 0){
            return $query->result()[0]->no_sk;
        }else{
            return FALSE;
        }
	}

	public function apakah_no_sk_sudah_digunakan($no_sk){

		$this->db->select('no_sk');
		$this->db->where('no_sk', $no_sk);
		$query = $this->db->get('t_siup');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function get_where_no_urut($no_urut){
		$this->db->where('no_urut', $no_urut);
		$query = $this->db->get('t_siup');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_daftar($no_daftar){
		$this->db->where('no_daftar', $no_daftar);
		$query = $this->db->get('t_siup');
		if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_like_no_sk($no_sk){
		
		$sql = "select * from t_siup where no_sk like '%$no_sk%'";
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
		$update = $this->db->update('t_siup', array(
			'status_berlaku' => $status_berlaku
		));
		return ($update) ? true :false ;
	}

	public function get_where_no_sk($no_sk){
		
		$sql = "select * from t_siup where no_sk = '$no_sk' and status_berlaku = 1";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
            
            return $query->result()[0];
        }else{
            return FALSE;
        }
	}

	public function get_where_no_sk_2($no_sk){
		
		$sql = "select * from t_siup where no_sk = '$no_sk'";
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
		$sql = "SELECT * FROM t_siup ORDER BY no_urut DESC LIMIT 1"; 
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

		$insert = $this->db->insert('t_siup', array(
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

		$insert = $this->db->insert('t_siup', array(
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
		$update = $this->db->update('t_siup', $array_update);
		return ($update) ? true : false;
	}

	public function cetak_siup_baru($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/siup_baru.docx");

        
        $data  = $this->m_siup->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', strtoupper($data->nama_perusahaan));
        $template->setValue('value3', strtoupper($data->nama_pemilik));
        $template->setValue('value4', strtoupper($data->alamat_perusahaan .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan)));
        $template->setValue('value5', strtoupper($data->no_telp));
        $template->setValue('value6', strtoupper($data->no_fax));
        $template->setValue('value7', strtoupper(number_format($data->modal_perusahaan, 0 , '' , '.' )));
        $template->setValue('value8', strtoupper($this->m_kelembagaan_siup->get_nama_kelembagaan($data->id_kelembagaan)));


        $array_judul_kbli_all = array();
        foreach (explode('|', $data->id_kbli) as $id_kbli) {
            $array_judul_kbli_all[] = $this->m_kbli->get_judul_kbli($id_kbli);
        }
        $judul_kbli_all = implode(', ', $array_judul_kbli_all);


        $template->setValue('value9', strtoupper($judul_kbli_all));
        $id_kbli_all = implode(', ', explode('|', $data->id_kbli));
        $template->setValue('value10', '('.strtoupper($id_kbli_all).')');
        $template->setValue('value11', strtoupper($data->barang_jasa_dagangan_utama));
        $template->setValue('value12', strtoupper(convert_tanggal_jadi_string($data->tanggal_perpanjangan)));
        $template->setValue('value13', strtoupper(convert_tanggal_jadi_string($data->tanggal_terbit)));
        

        $template->save(APPPATH. '../saved/siup_baru.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);
        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/siup_baru.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_siup_perpanjangan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/siup_perpanjangan.docx");

        
        $data  = $this->m_siup->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', strtoupper($data->nama_perusahaan));
        $template->setValue('value3', strtoupper($data->nama_pemilik));
        $template->setValue('value4', strtoupper($data->alamat_perusahaan .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan)));
        $template->setValue('value5', strtoupper($data->no_telp));
        $template->setValue('value6', strtoupper($data->no_fax));
        $template->setValue('value7', strtoupper(number_format($data->modal_perusahaan, 0 , '' , '.' )));
        $template->setValue('value8', strtoupper($this->m_kelembagaan_siup->get_nama_kelembagaan($data->id_kelembagaan)));


        $array_judul_kbli_all = array();
        foreach (explode('|', $data->id_kbli) as $id_kbli) {
            $array_judul_kbli_all[] = $this->m_kbli->get_judul_kbli($id_kbli);
        }
        $judul_kbli_all = implode(', ', $array_judul_kbli_all);


        $template->setValue('value9', strtoupper($judul_kbli_all));
        $id_kbli_all = implode(', ', explode('|', $data->id_kbli));
        $template->setValue('value10', '('.strtoupper($id_kbli_all).')');
        $template->setValue('value11', strtoupper($data->barang_jasa_dagangan_utama));
        $template->setValue('value12', strtoupper(convert_tanggal_jadi_string($data->tanggal_perpanjangan)));
        $template->setValue('value13', strtoupper(convert_tanggal_jadi_string($data->tanggal_terbit)));
        

        $template->save(APPPATH. '../saved/siup_perpanjangan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);
        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/siup_perpanjangan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	public function cetak_siup_perubahan($no_daftar){

		$this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/siup_perubahan.docx");

        
        $data  = $this->m_siup->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', strtoupper($data->nama_perusahaan));
        $template->setValue('value3', strtoupper($data->nama_pemilik));
        $template->setValue('value4', strtoupper($data->alamat_perusahaan .' Gampong '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan)));
        $template->setValue('value5', strtoupper($data->no_telp));
        $template->setValue('value6', strtoupper($data->no_fax));
        $template->setValue('value7', strtoupper(number_format($data->modal_perusahaan, 0 , '' , '.' )));
        $template->setValue('value8', strtoupper($this->m_kelembagaan_siup->get_nama_kelembagaan($data->id_kelembagaan)));


        $array_judul_kbli_all = array();
        foreach (explode('|', $data->id_kbli) as $id_kbli) {
            $array_judul_kbli_all[] = $this->m_kbli->get_judul_kbli($id_kbli);
        }
        $judul_kbli_all = implode(', ', $array_judul_kbli_all);


        $template->setValue('value9', strtoupper($judul_kbli_all));
        $id_kbli_all = implode(', ', explode('|', $data->id_kbli));
        $template->setValue('value10', '('.strtoupper($id_kbli_all).')');
        $template->setValue('value11', strtoupper($data->barang_jasa_dagangan_utama));
        $template->setValue('value12', strtoupper(convert_tanggal_jadi_string($data->tanggal_perpanjangan)));
        $template->setValue('value13', strtoupper(convert_tanggal_jadi_string($data->tanggal_terbit)));
        

        $template->save(APPPATH. '../saved/siup_perubahan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);
        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/siup_perubahan.docx';
            setTimeout(function(){
            	window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
	}

	
}