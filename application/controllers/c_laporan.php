<?php 

class C_laporan extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->form_laporan();
	}

	public function form_laporan(){

		if($this->input->post('id_modul')){
			$data['id_modul'] = $this->input->post('id_modul');
			$data['singkatan'] = $this->m_modul->get_where_id_modul($data['id_modul'])[0]->singkatan;
			redirect('c_laporan/laporan_'. $data['singkatan']);
		}

		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('v_form_laporan', $data);
        $this->load->view('templates/bottom');
	}

	public function laporan_siup(){



		if($this->input->post('cetak')){

			$periode           = $this->input->post('periode');
			$tahun             = explode('-', $periode)[0];
			$bulan             = explode('-', $periode)[1];
			$id_kec_perusahaan = $this->input->post('id_kec_perusahaan');
			

			$sql = "SELECT 
						t_siup.no_sk, 
						t_siup.nama_pemilik,  
						t_siup.nama_perusahaan, 
						t_siup.alamat_perusahaan, 
						t_siup.id_kbli, 
						t_siup.barang_jasa_dagangan_utama, 
						t_siup.modal_perusahaan, 
						t_siup.id_kec_perusahaan,
						t_kec.nm_kec, 
						t_siup.id_kel_perusahaan,
						t_siup.tanggal_terbit, 
						t_siup.tanggal_perpanjangan, 
						t_siup.ket,
						t_siup.alasan_penerbitan
					FROM 
						t_siup
					INNER JOIN 
						t_kec ON t_kec.id_kec = t_siup.id_kec_perusahaan 
					WHERE 
						MONTH(t_siup.tanggal_terbit) = $bulan AND YEAR(t_siup.tanggal_terbit) = $tahun";

			if(!empty($id_kec_perusahaan)){
				$sql .= " and id_kec_perusahaan = $id_kec_perusahaan";
			}

			$data = $this->db->query($sql)->result();

			
			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_siup.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Daftar Surat Izin Tempat Usaha (SIUP) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				/*$objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);*/

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$nama_perusahaan = $r_data->nama_perusahaan;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, " \"$nama_perusahaan\"");

				$alamat_perusahaan = ucwords(strtolower($r_data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_perusahaan) . ' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_perusahaan");

				

				/*$string_kbli = str_replace('|', ', ', $r_data->id_kbli);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$string_kbli");*/

				/*$barang_jasa_dagangan_utama = $r_data->barang_jasa_dagangan_utama;
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$barang_jasa_dagangan_utama");				*/

				$modal_perusahaan = number_format($r_data->modal_perusahaan, 0 , '' , '.' );
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "Rp. $modal_perusahaan");				 	

				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->alasan_penerbitan;
				if($ket == 'PB') $objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "√");
				if($ket == 'PL') $objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "√");
				if($ket == 'PS') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");	
				if($ket == 'PK') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	

				$pembaharuan_ke = $r_data->ket;
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$h, "$pembaharuan_ke");

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_siup.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_siup.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_siup") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_situ from t_situ');
		$data['nama_bidang_situ'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/siup', $data);
        $this->load->view('templates/bottom');
	}


	public function laporan_tdp(){


		if($this->input->post('cetak')){

			$periode           = $this->input->post('periode');
			$tahun             = explode('-', $periode)[0];
			$bulan             = explode('-', $periode)[1];
			$id_kec_perusahaan = $this->input->post('id_kec_perusahaan');
			

			$sql = "SELECT 
						t_tdp.no_sk, 
						t_tdp.nama_pemilik,  
						t_tdp.nama_perusahaan, 
						t_tdp.alamat_perusahaan, 
						t_tdp.id_kbli, 
						t_tdp.id_kec_perusahaan,
						t_kec.nm_kec, 
						t_tdp.id_kel_perusahaan,
						t_tdp.tanggal_terbit, 
						t_tdp.tanggal_perpanjangan, 
						t_tdp.ket,
						t_tdp.alasan_penerbitan
					FROM 
						t_tdp
					INNER JOIN 
						t_kec ON t_kec.id_kec = t_tdp.id_kec_perusahaan 
					WHERE 
						MONTH(t_tdp.tanggal_terbit) = $bulan AND YEAR(t_tdp.tanggal_terbit) = $tahun";

			if(!empty($id_kec_perusahaan)){
				$sql .= " and id_kec_perusahaan = $id_kec_perusahaan";
			}

			$data = $this->db->query($sql)->result();

			
			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_tdp.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Tanda Daftar Perusahaan (TDP) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				/*$objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);*/

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$nama_perusahaan = $r_data->nama_perusahaan;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, " \"$nama_perusahaan\"");

				$alamat_perusahaan = ucwords(strtolower($r_data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_perusahaan) . ' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_perusahaan");


				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->alasan_penerbitan;
				if($ket == 'PB') $objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "√");
				if($ket == 'PL') $objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "√");
				if($ket == 'PS') $objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "√");	
				if($ket == 'PK') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");	

				$pembaharuan_ke = $r_data->ket;
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "$pembaharuan_ke");

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_tdp.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_tdp.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_tdp") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_situ from t_situ');
		$data['nama_bidang_situ'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/tdp', $data);
        $this->load->view('templates/bottom');
	}

	public function laporan_situ(){



		if($this->input->post('cetak')){

			$periode           = $this->input->post('periode');
			$tahun             = explode('-', $periode)[0];
			$bulan             = explode('-', $periode)[1];
			$id_kec_perusahaan = $this->input->post('id_kec_perusahaan');
			

			$sql = "SELECT 
						t_situ.no_sk, 
						t_situ.nama_pemilik,  
						t_situ.nama_perusahaan, 
						t_situ.alamat_perusahaan, 
						t_situ.nama_bidang_situ, 
						t_situ.id_kec_perusahaan,
						t_kec.nm_kec, 
						t_situ.id_kel_perusahaan,
						t_situ.tanggal_terbit, 
						t_situ.tanggal_perpanjangan, 
						t_situ.ket
					FROM 
						t_situ
					INNER JOIN 
						t_kec ON t_kec.id_kec = t_situ.id_kec_perusahaan 
					WHERE 
						MONTH(t_situ.tanggal_terbit) = $bulan and YEAR(t_situ.tanggal_terbit) = $tahun";

			if(!empty($id_kec_perusahaan)){
				$sql .= " and id_kec_perusahaan = $id_kec_perusahaan";
			}

			$data = $this->db->query($sql)->result();

			
			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_situ.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Surat Izin Tempat Usaha (SITU) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				$objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$nama_perusahaan = $r_data->nama_perusahaan;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, " \"$nama_perusahaan\"");

				$alamat_perusahaan = ucwords(strtolower($r_data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_perusahaan)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_perusahaan");

				$nama_bidang_situ = $r_data->nama_bidang_situ;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$nama_bidang_situ");

				$kecamatan_perusahaan = $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$kecamatan_perusahaan");

				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->ket;
				if($ket == 'B') $objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "√");
				if($ket == 'P') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");
				if($ket == 'PR') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_situ.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_situ.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_situ") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_situ from t_situ');
		$data['nama_bidang_situ'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/situ', $data);
        $this->load->view('templates/bottom');
	}




	public function laporan_sipl(){



		if($this->input->post('cetak')){

			$periode           = $this->input->post('periode');
			$tahun             = explode('-', $periode)[0];
			$bulan             = explode('-', $periode)[1];
			$id_kec_perusahaan = $this->input->post('id_kec_perusahaan');
			

			$sql = "SELECT 
						t_sipl.no_sk, 
						t_sipl.nama_pemilik,  
						t_sipl.nama_perusahaan, 
						t_sipl.alamat_perusahaan, 
						t_sipl.id_kec_perusahaan,
						t_sipl.id_kel_perusahaan,

						t_sipl.jenis_limbah, 
						t_sipl.jumlah_ton,
						t_sipl.dipindahkan_kepada,
						t_sipl.alamat_pindah,
						t_sipl.keterangan_barang,
						t_kec.nm_kec, 
						
						t_sipl.tanggal_terbit, 
						
						t_sipl.ket
					FROM 
						t_sipl
					INNER JOIN 
						t_kec ON t_kec.id_kec = t_sipl.id_kec_perusahaan 
					WHERE 
						MONTH(t_sipl.tanggal_terbit) = $bulan and YEAR(t_sipl.tanggal_terbit) = $tahun";

			if(!empty($id_kec_perusahaan)){
				$sql .= " and id_kec_perusahaan = $id_kec_perusahaan";
			}

			$data = $this->db->query($sql)->result();

			
			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_sipl.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Surat Izin Tempat Usaha (sipl) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:K$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle("A$h:K$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:K$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				$objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$nama_perusahaan = $r_data->nama_perusahaan;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, " \"$nama_perusahaan\"");

				$alamat_perusahaan = ucwords(strtolower($r_data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_perusahaan) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_perusahaan");

				$jenis_limbah = $r_data->jenis_limbah;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$jenis_limbah");

				$jumlah_ton = $r_data->jumlah_ton;
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$jumlah_ton");

				$dipindahkan_kepada = $r_data->dipindahkan_kepada;
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$dipindahkan_kepada");


				$alamat_pindah = $r_data->alamat_pindah;
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$alamat_pindah");

				$keterangan_barang = implode(',', explode('|', $r_data->keterangan_barang));
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "$keterangan_barang");


				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "$tanggal_terbit");

				

				
				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_sipl.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_sipl.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_sipl") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_sipl from t_sipl');
		$data['nama_bidang_sipl'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/sipl', $data);
        $this->load->view('templates/bottom');
	}


	public function laporan_siuk(){



		if($this->input->post('cetak')){

			$periode           = $this->input->post('periode');
			$tahun             = explode('-', $periode)[0];
			$bulan             = explode('-', $periode)[1];
			$id_kec_perusahaan = $this->input->post('id_kec_perusahaan');
			

			$sql = "SELECT 
						t_siuk.no_sk, 
						t_siuk.nama_pemilik,  
						t_siuk.nama_perusahaan, 
						t_siuk.alamat_perusahaan, 
						t_siuk.nama_bidang_usaha, 
						t_siuk.id_kec_perusahaan,
						t_kec.nm_kec, 
						t_kel.nm_kel, 
						t_siuk.id_kel_perusahaan,
						t_siuk.tanggal_terbit, 
						t_siuk.tanggal_perpanjangan, 
						t_siuk.ket
					FROM 
						t_siuk
					INNER JOIN 
						t_kec ON t_kec.id_kec = t_siuk.id_kec_perusahaan 
					INNER JOIN 
						t_kel ON t_kel.id_kel = t_siuk.id_kel_perusahaan 
					WHERE 
						MONTH(t_siuk.tanggal_terbit) = $bulan and YEAR(t_siuk.tanggal_terbit) = $tahun";

			if(!empty($id_kec_perusahaan)){
				$sql .= " and id_kec_perusahaan = $id_kec_perusahaan";
			}

			$data = $this->db->query($sql)->result();

			
			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_siuk.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Surat Izin Usaha Kepariwisataan (SIUK) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				$objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$nama_perusahaan = $r_data->nama_perusahaan;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, " \"$nama_perusahaan\"");

				$alamat_perusahaan = ucwords(strtolower($r_data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_perusahaan).' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_perusahaan");

				$nama_bidang_usaha = $r_data->nama_bidang_usaha;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$nama_bidang_usaha");

				$kecamatan_perusahaan = $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$kecamatan_perusahaan");

				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->ket;
				if($ket == 'B') $objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "√");
				if($ket == 'P') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");
				if($ket == 'PR') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_siuk.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_siuk.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_siuk") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_situ from t_situ');
		$data['nama_bidang_situ'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/siuk', $data);
        $this->load->view('templates/bottom');
	}

	public function laporan_siujk(){

		

		if($this->input->post('cetak')){

			$periode           = $this->input->post('periode');
			$tahun             = explode('-', $periode)[0];
			$bulan             = explode('-', $periode)[1];
			$id_kec_perusahaan = $this->input->post('id_kec_perusahaan');
			

			$sql = "SELECT 
						t_siujk.no_sk, 
						t_siujk.nama_pemilik,  
						t_siujk.nama_perusahaan, 
						t_siujk.alamat_perusahaan, 
						t_siujk.id_bidang_siujk, 
						t_siujk.id_kec_perusahaan,
						t_kec.nm_kec, 
						t_siujk.id_kel_perusahaan,
						t_siujk.tanggal_terbit, 
						t_siujk.tanggal_perpanjangan, 
						t_siujk.ket
					FROM 
						t_siujk
					INNER JOIN 
						t_kec ON t_kec.id_kec = t_siujk.id_kec_perusahaan 
					WHERE 
						MONTH(t_siujk.tanggal_terbit) = $bulan and YEAR(t_siujk.tanggal_terbit) = $tahun";

			if(!empty($id_kec_perusahaan)){
				$sql .= " and id_kec_perusahaan = $id_kec_perusahaan";
			}

			$data = $this->db->query($sql)->result();



			
			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_siujk.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Surat Izin Usaha Jasa Konstruksi (SIUJK) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				$objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$nama_perusahaan = $r_data->nama_perusahaan;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, " \"$nama_perusahaan\"");

				$alamat_perusahaan = ucwords(strtolower($r_data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_perusahaan)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_perusahaan");

				$array_id_bidang_siujk = explode('|', $r_data->id_bidang_siujk);
				$array_nama_bidang_siujk = array();
				foreach ($array_id_bidang_siujk as $id_bidang_siujk) {
					$array_nama_bidang_siujk[] = $this->m_bidang_siujk->get_nama_bidang_siujk($id_bidang_siujk);
				}

				$nama_bidang_siujk = implode(', ', $array_nama_bidang_siujk);


				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$nama_bidang_siujk");

				$kecamatan_perusahaan = $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$kecamatan_perusahaan");

				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$tanggal_perpanjangan");

				
				$ket = $r_data->ket;
				if($ket == 'B') $objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "√");
				if($ket == 'P') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");
				if($ket == 'PR') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_siujk.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_siujk.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_siujk") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_siujk from t_siujk');
		$data['nama_bidang_siujk'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/siujk', $data);
        $this->load->view('templates/bottom');
	}


	public function laporan_tdi(){

		

		if($this->input->post('cetak')){

			$periode           = $this->input->post('periode');
			$tahun             = explode('-', $periode)[0];
			$bulan             = explode('-', $periode)[1];
			$id_kec_perusahaan = $this->input->post('id_kec_perusahaan');
			

			$sql = "SELECT 
						t_tdi.no_sk, 
						t_tdi.nama_pemilik,  
						t_tdi.nama_perusahaan, 
						t_tdi.alamat_pemilik, 
						t_tdi.id_kel_pemilik,
						t_tdi.id_kec_pemilik,

						t_tdi.alamat_perusahaan, 
						t_tdi.id_kel_perusahaan,
						t_tdi.id_kec_perusahaan,
						
						t_tdi.alamat_pabrik, 
						t_tdi.id_kel_pabrik,
						t_tdi.id_kec_pabrik,

						t_tdi.id_kbli,
						t_tdi.komoditi_industri,
						t_tdi.nilai_investasi,
						
						t_tdi.tanggal_terbit, 
						
						t_tdi.ket
					FROM 
						t_tdi
					WHERE 
						MONTH(t_tdi.tanggal_terbit) = $bulan and YEAR(t_tdi.tanggal_terbit) = $tahun";

			if(!empty($id_kec_perusahaan)){
				$sql .= " and id_kec_perusahaan = $id_kec_perusahaan";
			}

			$data = $this->db->query($sql)->result();



			
			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_tdi.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Tanda Daftar Industri (TDI) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				// $objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$alamat_pemilik = ucwords(strtolower($r_data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_pemilik) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_pemilik)));
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, "$alamat_pemilik");

				$nama_perusahaan = $r_data->nama_perusahaan;
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, " \"$nama_perusahaan\"");


				$alamat_perusahaan = ucwords(strtolower($r_data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_perusahaan) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan)));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$alamat_perusahaan");

				$array_id_kbli = explode('|', $r_data->id_kbli);
				$nama_kbli = '';
				foreach ($array_id_kbli as $id_kbli) {
					$nama_kbli .= $this->m_kbli->get_judul_kbli($id_kbli). ' (' .$id_kbli. ') ';
				}
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$nama_kbli");

				$komoditi_industri = $r_data->komoditi_industri;
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$komoditi_industri");

				$nilai_investasi = 'Rp. ' . number_format( $r_data->nilai_investasi, 0 , '' , '.' );
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$nilai_investasi");

				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "$tanggal_terbit");

				$ket = $r_data->ket;
				if($ket == 'B') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");
				if($ket == 'PR') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_tdi.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_tdi.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_tdi") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_tdi from t_tdi');
		$data['nama_bidang_tdi'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/tdi', $data);
        $this->load->view('templates/bottom');
	}



	public function laporan_sikp(){

		

		if($this->input->post('cetak')){

			$periode        = $this->input->post('periode');
			$tahun          = explode('-', $periode)[0];
			$bulan          = explode('-', $periode)[1];
			$id_kec_pemilik = $this->input->post('id_kec_pemilik');
			

			$sql = "SELECT 
						t_sikp.no_sk, 
						t_sikp.nama_pemilik, 
						t_sikp.tempat_lahir,
						t_sikp.tanggal_lahir, 
						t_sikp.alamat_pemilik, 
						t_sikp.id_kel_pemilik,
						t_sikp.id_kec_pemilik,
						t_sikp.no_sib_str,
						t_sikp.nama_tempat_kerja, 
						t_sikp.alamat_tempat_kerja, 
						t_sikp.id_kel_tempat_kerja,
						t_sikp.id_kec_tempat_kerja,
						
						t_sikp.tanggal_terbit, 
						t_sikp.tanggal_perpanjangan, 
						
						t_sikp.ket
					FROM 
						t_sikp
					WHERE 
						MONTH(t_sikp.tanggal_terbit) = $bulan and YEAR(t_sikp.tanggal_terbit) = $tahun";

			if(!empty($id_kec_pemilik)){
				$sql .= " and id_kec_pemilik = $id_kec_pemilik";
			}

			$data = $this->db->query($sql)->result();


			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_sikp.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Tanda Daftar Industri (SIKP) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}

				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				// $objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$tempat_tgl_lahir = $r_data->tempat_lahir.', '. convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, "$tempat_tgl_lahir");

				$alamat_pemilik = ucwords(strtolower($r_data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_pemilik) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_pemilik)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_pemilik");

				$no_sib_str = $r_data->no_sib_str;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$no_sib_str");

				$nama_tempat_kerja = $r_data->nama_tempat_kerja;
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$nama_tempat_kerja");

				$alamat_tempat_kerja = ucwords(strtolower($r_data->alamat_tempat_kerja .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_tempat_kerja) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_tempat_kerja)));
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$alamat_tempat_kerja");

				
				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->ket;
				if($ket == 'B') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");
				if($ket == 'P') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	
				if($ket == 'PR') $objPHPExcel->getActiveSheet()->setCellValue('M'.$h, "√");	

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_sikp.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_sikp.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_sikp") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_tdi from t_tdi');
		$data['nama_bidang_tdi'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/sikp', $data);
        $this->load->view('templates/bottom');
	}



	public function laporan_sipb(){

		

		if($this->input->post('cetak')){

			$periode        = $this->input->post('periode');
			$tahun          = explode('-', $periode)[0];
			$bulan          = explode('-', $periode)[1];
			$id_kec_pemilik = $this->input->post('id_kec_pemilik');
			

			$sql = "SELECT 
						t_sipb.no_sk, 
						t_sipb.nama_pemilik, 
						t_sipb.tempat_lahir,
						t_sipb.tanggal_lahir, 
						t_sipb.alamat_pemilik, 
						t_sipb.id_kel_pemilik,
						t_sipb.id_kec_pemilik,
						t_sipb.no_surat_tanda_reg_bidan,
						t_sipb.nama_tempat_praktek, 
						t_sipb.alamat_tempat_praktek, 
						t_sipb.id_kel_tempat_praktek,
						t_sipb.id_kec_tempat_praktek,
						
						t_sipb.tanggal_terbit, 
						t_sipb.tanggal_perpanjangan, 
						
						t_sipb.ket
					FROM 
						t_sipb
					WHERE 
						MONTH(t_sipb.tanggal_terbit) = $bulan and YEAR(t_sipb.tanggal_terbit) = $tahun";

			if(!empty($id_kec_pemilik)){
				$sql .= " and id_kec_pemilik = $id_kec_pemilik";
			}

			$data = $this->db->query($sql)->result();


			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_sipb.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Tanda Daftar Industri (SIPB) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}

				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				// $objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$tempat_tgl_lahir = $r_data->tempat_lahir.', '. convert_tanggal_jadi_string($r_data->tanggal_lahir);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, "$tempat_tgl_lahir");

				$alamat_pemilik = ucwords(strtolower($r_data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_pemilik) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_pemilik)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_pemilik");

				$no_surat_tanda_reg_bidan = $r_data->no_surat_tanda_reg_bidan;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$no_surat_tanda_reg_bidan");

				$nama_tempat_praktek = $r_data->nama_tempat_praktek;
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$nama_tempat_praktek");

				$alamat_tempat_praktek = ucwords(strtolower($r_data->alamat_tempat_praktek .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_tempat_praktek) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_tempat_praktek)));
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$alamat_tempat_praktek");

				
				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->ket;
				if($ket == 'B') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");
				if($ket == 'P') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	
				if($ket == 'PR') $objPHPExcel->getActiveSheet()->setCellValue('M'.$h, "√");	

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_sipb.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_sipb.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_sipb") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_tdi from t_tdi');
		$data['nama_bidang_tdi'] = $q->result();*/
		$data['kec']   = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/sipb', $data);
        $this->load->view('templates/bottom');
	}


	public function laporan_sikb(){

		

		if($this->input->post('cetak')){

			$periode        = $this->input->post('periode');
			$tahun          = explode('-', $periode)[0];
			$bulan          = explode('-', $periode)[1];
			$id_kec_pemilik = $this->input->post('id_kec_pemilik');
			

			$sql = "SELECT 
						t_sikb.no_sk, 
						t_sikb.nama_pemilik, 
						t_sikb.tempat_lahir,
						t_sikb.tanggal_lahir, 
						t_sikb.alamat_pemilik, 
						t_sikb.id_kel_pemilik,
						t_sikb.id_kec_pemilik,
						t_sikb.no_sib_str,
						t_sikb.nama_tempat_kerja, 
						t_sikb.alamat_tempat_kerja, 
						t_sikb.id_kel_tempat_kerja,
						t_sikb.id_kec_tempat_kerja,
						
						t_sikb.tanggal_terbit, 
						t_sikb.tanggal_perpanjangan, 
						
						t_sikb.ket
					FROM 
						t_sikb
					WHERE 
						MONTH(t_sikb.tanggal_terbit) = $bulan and YEAR(t_sikb.tanggal_terbit) = $tahun";

			if(!empty($id_kec_pemilik)){
				$sql .= " and id_kec_pemilik = $id_kec_pemilik";
			}

			$data = $this->db->query($sql)->result();


			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_sikb.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Tanda Daftar Industri (sikb) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}

				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:M$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				// $objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$tempat_tgl_lahir = $r_data->tempat_lahir.', '. convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, "$tempat_tgl_lahir");

				$alamat_pemilik = ucwords(strtolower($r_data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_pemilik) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_pemilik)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_pemilik");

				$no_sib_str = $r_data->no_sib_str;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$no_sib_str");

				$nama_tempat_kerja = $r_data->nama_tempat_kerja;
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$nama_tempat_kerja");

				$alamat_tempat_kerja = ucwords(strtolower($r_data->alamat_tempat_kerja .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_tempat_kerja) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_tempat_kerja)));
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$alamat_tempat_kerja");

				
				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->ket;
				if($ket == 'B') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");
				if($ket == 'P') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	
				if($ket == 'PR') $objPHPExcel->getActiveSheet()->setCellValue('M'.$h, "√");	

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_sikb.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_sikb.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_sikb") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_tdi from t_tdi');
		$data['nama_bidang_tdi'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/sikp', $data);
        $this->load->view('templates/bottom');
	}



	public function laporan_sia(){

		

		if($this->input->post('cetak')){

			$periode        = $this->input->post('periode');
			$tahun          = explode('-', $periode)[0];
			$bulan          = explode('-', $periode)[1];
			$id_kec_pemilik = $this->input->post('id_kec_pemilik');
			

			$sql = "SELECT 
						t_sia.no_sk, 
						t_sia.nama_pemilik, 
						
						t_sia.alamat_pemilik, 
						t_sia.id_kel_pemilik,
						t_sia.id_kec_pemilik,
						t_sia.no_sipa,
						t_sia.nama_apotek, 
						t_sia.alamat_apotek, 
						t_sia.id_kel_apotek,
						t_sia.id_kec_apotek,
						
						t_sia.tanggal_terbit, 
						t_sia.tanggal_perpanjangan, 
						
						t_sia.ket
					FROM 
						t_sia
					WHERE 
						MONTH(t_sia.tanggal_terbit) = $bulan and YEAR(t_sia.tanggal_terbit) = $tahun";

			if(!empty($id_kec_pemilik)){
				$sql .= " and id_kec_pemilik = $id_kec_pemilik";
			}

			$data = $this->db->query($sql)->result();


			$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			$objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_sia.xlsx');
			
			
			$h = 9;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Laporan Tanda Daftar Industri (SIA) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}

				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:L$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				// $objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				
				$alamat_pemilik = ucwords(strtolower($r_data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_pemilik) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_pemilik)));
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, "$alamat_pemilik");

				$no_sipa = $r_data->no_sipa;
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$no_sipa");

				$nama_apotek = $r_data->nama_apotek;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$nama_apotek");

				$alamat_apotek = ucwords(strtolower($r_data->alamat_apotek .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_apotek) .' Kec. '. $this->m_kec->get_nm_kec($r_data->id_kec_apotek)));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$alamat_apotek");

				
				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->ket;
				if($ket == 'B') $objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "√");
				if($ket == 'P') $objPHPExcel->getActiveSheet()->setCellValue('K'.$h, "√");	
				if($ket == 'PR') $objPHPExcel->getActiveSheet()->setCellValue('L'.$h, "√");	

				$h++;
				$no++;
			}

			$h = $h + 2;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "Kabupaten Bireuen");
			$h = $h + 4;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "MUHAMMAD NASIR, SP");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "PEMBINA");
			$h = $h + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "NIP. 19621231 198711 1 002");
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/laporan_sia.xlsx');

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/laporan_sia.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_laporan/laporan_sia") ?>';
	            }, 3000);
	        </script>
	        <?php 
		}

		/*$q = $this->db->query('select distinct nama_bidang_tdi from t_tdi');
		$data['nama_bidang_tdi'] = $q->result();*/
		$data['kec'] = $this->m_kec->get_all();
		$data['modul'] = $this->m_modul->get_all();

		$this->load->view('templates/top');
        $this->load->view('laporan/sia', $data);
        $this->load->view('templates/bottom');
	}


	public function testexcel(){
		$this->load->library('excel_iofactory');
			
			$objReader    = $this->excel_iofactory;
			$objReader    = $objReader::createReader('Excel2007');
			// $objPHPExcel  = $objReader->load(APPPATH. '../templates/laporan_situ.xlsx');
			$html = base_url('c_coretan/testexcel');


			$var = $this->load->view('view_saya', $data, true);
			$handle = fopen('testexcel.html', 'w');
			fwrite($handle, $var);
			$objPHPExcel = $objReader->load($html);
			
			
			/*$h = 8;
			$no = 1;
			foreach ($data as $r_data) {

				$string_judul = "Daftar Surat Izin Tempat Usaha (SITU) Bulan $bulan Tahun $tahun";
				if(!empty($id_kec_perusahaan)){
					$string_judul .= " Per Kecamatan ". ucwords(strtolower($this->m_kec->get_nm_kec($id_kec_perusahaan)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A5', $string_judul);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				// $objPHPExcel->getActiveSheet()->getStyle("A$h:J$h")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

				$objPHPExcel->getActiveSheet()->getRowDimension($h)->setRowHeight(30);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$h, "$no");

				$no_sk = $r_data->no_sk;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$h, "$no_sk");

				$nama_pemilik = $r_data->nama_pemilik;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$h, "$nama_pemilik");

				$nama_perusahaan = $r_data->nama_perusahaan;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$h, " \"$nama_perusahaan\"");

				$alamat_perusahaan = ucwords(strtolower($r_data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($r_data->id_kel_perusahaan)));
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$h, "$alamat_perusahaan");

				$nama_bidang_situ = $r_data->nama_bidang_situ;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$h, "$nama_bidang_situ");

				$kecamatan_perusahaan = $this->m_kec->get_nm_kec($r_data->id_kec_perusahaan);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$h, "$kecamatan_perusahaan");

				$tanggal_terbit = convert_tanggal_jadi_string($r_data->tanggal_terbit);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$h, "$tanggal_terbit");

				$tanggal_perpanjangan = convert_tanggal_jadi_string($r_data->tanggal_perpanjangan);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$h, "$tanggal_perpanjangan");

				$ket = $r_data->ket;
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$h, "$ket");

				$h++;
				$no++;
			}*/

			
		    
		    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	        $objWriter->save(APPPATH. '../saved/testexcel.xlsx');

	        

	        ?>
	        <script>
	            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/testexcel.xlsx';
	            setTimeout(function(){
	                window.location = '<?php echo site_url("c_coretan/testexcel") ?>';
	            }, 3000);
	        </script>
	        <?php 
	}

}