<?php

class M_sipi extends CI_Model{



    function __construct(){
        parent::__construct();
        $this->load->model('m_kel');
        $this->load->model('m_kec');
        $this->load->model('m_kbli');
        $this->load->model('m_fo');
    }

    public function hapus_where_no_daftar($no_daftar){
        $this->db->where('no_daftar', $no_daftar);
        $delete = $this->db->delete('t_sipi');
        if($delete){
            return true;
        }else{
            return false;
        }

    }

    public function get_no_sk_where_no_daftar($no_daftar){
        
        $this->db->where('no_daftar', $no_daftar);
        $this->db->select('no_sk');
        $query = $this->db->get('t_sipi');
        if($query->num_rows() > 0){
            return $query->result()[0]->no_sk;
        }else{
            return FALSE;
        }
    }

    public function apakah_no_sk_sudah_digunakan($no_sk){

        $this->db->select('no_sk');
        $this->db->where('no_sk', $no_sk);
        $query = $this->db->get('t_sipi');
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }

    }

    public function get_where_no_urut($no_urut){
        $this->db->where('no_urut', $no_urut);
        $query = $this->db->get('t_sipi');
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
    }

    public function get_where_no_daftar($no_daftar){
        $this->db->where('no_daftar', $no_daftar);
        $query = $this->db->get('t_sipi');
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return FALSE;
        }
    }

    public function get_like_no_sk($no_sk){
        
        $sql = "select * from t_sipi where no_sk like '%$no_sk%'";
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
        $update = $this->db->update('t_sipi', array(
            'status_berlaku' => $status_berlaku
        ));
        return ($update) ? true :false ;
    }

    public function get_where_no_sk($no_sk){
        
        $sql = "select * from t_sipi where no_sk = '$no_sk' and status_berlaku = 1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            
            return $query->result()[0];
        }else{
            return FALSE;
        }
    }

    public function get_where_no_sk_2($no_sk){
        
        $sql = "select * from t_sipi where no_sk = '$no_sk'";
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
        $sql = "SELECT * FROM t_sipi ORDER BY no_urut DESC LIMIT 1"; 
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

        $insert = $this->db->insert('t_sipi', array(
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

        $insert = $this->db->insert('t_sipi', array(
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
        $update = $this->db->update('t_sipi', $array_update);
        return ($update) ? true : false;
    }

    public function cetak_sipi_baru($no_daftar){

        //load our new PHPExcel library
        $this->load->library('excel_iofactory');

        $data = $this->m_sipi->get_where_no_daftar($no_daftar);
        
        // echo "<pre>";
        // print_r($this->excel_iofactory);
        // echo "</pre>";
        // 
        // print_r($data);
        
        $objReader = $this->excel_iofactory;
        $objReader = $objReader::createReader('Excel2007');
        $objPHPExcel = $objReader->load(APPPATH. '../templates/sipi_baru.xlsx');

        // $no_sk = $data->no_sk;

        $objPHPExcel->getActiveSheet()->setCellValue('F11', 'NOMOR : '.$data->no_sk);
        $objPHPExcel->getActiveSheet()->setCellValue('F20', strtoupper($data->nama));
        $objPHPExcel->getActiveSheet()->setCellValue('F21', strtoupper($data->alamat. 'GP. '. $this->m_kel->get_nm_kel($data->id_kel)));
        $objPHPExcel->getActiveSheet()->setCellValue('F22', strtoupper($this->m_kec->get_nm_kec($data->id_kec)));
        $objPHPExcel->getActiveSheet()->setCellValue('F23', 'BIREUEN');
        $objPHPExcel->getActiveSheet()->setCellValue('F24', (string) $data->no_ktp);
        $objPHPExcel->getActiveSheet()->setCellValue('F28', strtoupper($data->nama_kapal));

        $f29 = '';
        if($data->tempat_reg_kapal != ''){
            $f29 = $data->tempat_reg_kapal;
            if($data->no_reg_kapal != ''){
                $f29 .= ', '. $data->no_reg_kapal;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue('F29', strtoupper($f29));


        $objPHPExcel->getActiveSheet()->setCellValue('F30', strtoupper($data->tempat_gelar_kapal.', '. $data->tanda_gelar_kapal));
        $objPHPExcel->getActiveSheet()->setCellValue('F31', strtoupper($data->nama_panggilan_kapal));
        $objPHPExcel->getActiveSheet()->setCellValue('F32', strtoupper($data->asal_kapal));
        $objPHPExcel->getActiveSheet()->setCellValue('F33', strtoupper($data->negara_asal_kapal));
        $objPHPExcel->getActiveSheet()->setCellValue('F34', strtoupper($data->tempat_pembuatan_kapal));

        $objPHPExcel->getActiveSheet()->setCellValue('F38', strtoupper($data->jenis_kapal));
        $objPHPExcel->getActiveSheet()->setCellValue('F39', strtoupper($this->m_jenis_alat_tangkap->get_nama_jenis_alat_tangkap($data->id_jenis_alat_tangkap)));

        $objPHPExcel->getActiveSheet()->setCellValue('F43', strtoupper($data->tonase_kotor));
        $objPHPExcel->getActiveSheet()->setCellValue('F44', strtoupper($data->tonase_bersih));

        $objPHPExcel->getActiveSheet()->setCellValue('F45', strtoupper($data->kekuatan_mesin));
        $objPHPExcel->getActiveSheet()->setCellValue('F46', strtoupper($data->merek_mesin));
        $objPHPExcel->getActiveSheet()->setCellValue('F47', strtoupper($data->no_seri_mesin));
        $objPHPExcel->getActiveSheet()->setCellValue('F48', strtoupper($data->bahan_kasco));

        $objPHPExcel->getActiveSheet()->setCellValue('H20', strtoupper('SURAT IZIN USAHA PERIKANAN    : '.$data->no_iup));
        $objPHPExcel->getActiveSheet()->setCellValue('H21', strtoupper('TANGGAL IZIN USAHA PERIKANAN : '. convert_tanggal_jadi_string($data->tanggal_iup)));

        $objPHPExcel->getActiveSheet()->setCellValue('J25', strtoupper(': '.$data->no_permohonan_iup));
        $objPHPExcel->getActiveSheet()->setCellValue('J26', strtoupper(': '. convert_tanggal_jadi_string($data->tanggal_permohonan_iup)));

        $objPHPExcel->getActiveSheet()->setCellValue('H30', strtoupper($data->daerah_penangkapan));
        $objPHPExcel->getActiveSheet()->setCellValue('H34', strtoupper($data->daerah_terlarang));

        $objPHPExcel->getActiveSheet()->setCellValue('H39', strtoupper($data->pelabuhan_penangkalan));
        $objPHPExcel->getActiveSheet()->setCellValue('H44', strtoupper(convert_tanggal_jadi_string($data->tanggal_terbit) .' S/D '. convert_tanggal_jadi_string($data->tanggal_perpanjangan)));

        $jumlah_anak_buah_kapal = ($data->anak_buah_kapal > 0) ? $data->anak_buah_kapal : '';
        $objPHPExcel->getActiveSheet()->setCellValue('J52', strtoupper( $jumlah_anak_buah_kapal ));

        $objPHPExcel->getActiveSheet()->setCellValue('H56', strtoupper( 'BIREUEN, ' .convert_tanggal_jadi_string($data->tanggal_terbit) ));

        

        

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(APPPATH. '../saved/sipi_baru.xlsx');
        $this->m_fo->set_status_proses($no_daftar, 11);

         ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/sipi_baru.xlsx';
            setTimeout(function(){
                window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
    }

    public function cetak_sipi_perpanjangan($no_daftar){

        $this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/sipi_perpanjangan.docx");

        $data  = $this->m_ho->get_where_no_daftar($no_daftar);

        /* awal sipi_perpanjangan.docx */
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/sipi_perpanjangan.docx");

        $template->setValue('no_sk', $data->no_sk);        
        $template->setValue('nama_bidang_ho', strtoupper($this->m_bidang_ho->get_nama_bidang_ho($data->id_bidang_ho)));
        $template->setValue('nama_pemilik', ucwords($data->nama_pemilik));
        $template->setValue('nama_perusahaan', ucwords($data->nama_perusahaan));
        $template->setValue('alamat_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gampong. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('npwpd_npwrd', strtoupper($data->npwpd_npwrd));
        $template->setValue('panjang_tempat_usaha', $data->panjang_tempat_usaha);
        $template->setValue('lebar_tempat_usaha', $data->lebar_tempat_usaha);
        $template->setValue('luas_tempat_usaha', $data->panjang_tempat_usaha * $data->lebar_tempat_usaha);
        $template->setValue('status_kepemilikan_tanah', ucwords($data->status_kepemilikan_tanah));
        $template->setValue('batas_utara', ucwords($data->batas_utara));
        $template->setValue('batas_selatan', ucwords($data->batas_selatan));
        $template->setValue('batas_barat', ucwords($data->batas_barat));
        $template->setValue('batas_timur', ucwords($data->batas_timur));

        if($data->mesin_penggerak == ''){
            $mesin_penggerak = 'Usaha '. strtoupper($this->m_bidang_ho->get_nama_bidang_ho($data->id_bidang_ho)) . ' tersebut tidak menggunakan mesin penggerak/genset';
        }else{
            $mesin_penggerak = 'Usaha '. strtoupper($this->m_bidang_ho->get_nama_bidang_ho($data->id_bidang_ho)) . ' tersebut menggunakan mesin penggerak/genset '. $data->mesin_penggerak .' berbahan bakar '. $data->bahan_bakar;
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

        $template->save(APPPATH. '../saved/sipi_perpanjangan.docx');
        
        /* akhir sipi_perpanjangan.docx */


        /* awal sipi_perpanjangan_sk.docx */

        $template2 = $this->phpword->loadTemplate(APPPATH ."../templates/sipi_perpanjangan_sk.docx");
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
        $template2->setValue('nama_bidang_ho', ucwords(strtolower($this->m_bidang_ho->get_nama_bidang_ho($data->id_bidang_ho))));
        $template2->setValue('alamat_perusahaan', ucwords(strtolower($data->alamat_perusahaan .' Gampong. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template2->setValue('nama_perusahaan', strtoupper($data->nama_perusahaan));
        $template2->setValue('nama_kel_perusahaan', ucwords(strtolower($this->m_kel->get_nm_kel($data->id_kel_perusahaan))));
        $template2->setValue('nama_kec_perusahaan', ucwords(strtolower($this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template2->setValue('no_surat_ket_usaha', $data->no_surat_ket_usaha);
        $template2->setValue('tanggal_surat_ket_usaha', convert_tanggal_jadi_string($data->tanggal_surat_ket_usaha));
        $template2->setValue('tanggal_surat_pernyataan_lingkungan', convert_tanggal_jadi_string($data->tanggal_surat_pernyataan_lingkungan));
        $template2->setValue('tanggal_peninjauan_lapangan', convert_tanggal_jadi_string($data->tanggal_peninjauan_lapangan));
        $template2->setValue('npwpd_npwrd', $data->npwpd_npwrd);
        $template2->setValue('panjang_tempat_usaha', $data->panjang_tempat_usaha);
        $template2->setValue('lebar_tempat_usaha', $data->lebar_tempat_usaha);
        $template2->setValue('luas_tempat_usaha', $data->panjang_tempat_usaha * $data->lebar_tempat_usaha);
        $template2->setValue('status_kepemilikan_tanah', ucwords($data->status_kepemilikan_tanah));
        $template2->setValue('batas_utara', ucwords($data->batas_utara));
        $template2->setValue('batas_selatan', ucwords($data->batas_selatan));
        $template2->setValue('batas_barat', ucwords($data->batas_barat));
        $template2->setValue('batas_timur', ucwords($data->batas_timur));
        if($data->mesin_penggerak == ''){
            $mesin_penggerak = 'Usaha '. ucwords(strtolower($this->m_bidang_ho->get_nama_bidang_ho($data->id_bidang_ho))) . ' tersebut tidak menggunakan mesin penggerak/genset';
        }else{
            $mesin_penggerak = 'Usaha '. ucwords(strtolower($this->m_bidang_ho->get_nama_bidang_ho($data->id_bidang_ho))) . ' tersebut menggunakan mesin penggerak/genset '. $data->mesin_penggerak .' berbahan bakar '. $data->bahan_bakar;
        }
        $template2->setValue('mesin_penggerak', $mesin_penggerak);
        $template2->setValue('pembangkit_listrik', $data->pembangkit_listrik);
        $template2->setValue('tanggal_perpanjangan', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template2->setValue('tanggal_daftar_ulang', convert_tanggal_jadi_string($data->tanggal_daftar_ulang));
        $template2->setValue('nilai_retribusi', $data->nilai_retribusi);
        $template2->setValue('tanggal_terbit', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template2->save(APPPATH. '../saved/sipi_perpanjangan_sk.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/sipi_perpanjangan.docx';
            setTimeout(function(){
                window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/sipi_perpanjangan_sk.docx';
                setTimeout(function(){
                    window.location = '<?php echo site_url("c_cetak/belum") ?>';
                }, 3000);
            }, 3000);
        </script>
        <?php 
    }

    public function cetak_sipi_perubahan($no_daftar){

        $this->load->library('phpword');
        $template = $this->phpword->loadTemplate(APPPATH ."../templates/sipi_perubahan.docx");

        $data  = $this->m_ho->get_where_no_daftar($no_daftar);

        $template->setValue('value1', $data->no_sk);
        $template->setValue('value2', $data->nama_pemilik);
        $template->setValue('value3', $data->npwpd_npwrd);
        $template->setValue('value4', ucwords(strtolower($data->alamat_pemilik .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_pemilik) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_pemilik))));
        $template->setValue('value5', strtoupper($data->nama_perusahaan));
        $template->setValue('value6', ucwords(strtolower($data->alamat_perusahaan .' Gp. '. $this->m_kel->get_nm_kel($data->id_kel_perusahaan) .' Kecamatan '. $this->m_kec->get_nm_kec($data->id_kec_perusahaan))));
        $template->setValue('value7', strtoupper($data->no_telp));
        $template->setValue('value8', $data->panjang_tempat_usaha .' x '. $data->lebar_tempat_usaha);
        $template->setValue('value8b', $data->panjang_tempat_usaha * $data->lebar_tempat_usaha);
        $template->setValue('value9', ucwords(strtolower($this->m_bidang_ho->get_nama_bidang_ho($data->id_bidang_ho))));
        $template->setValue('value11', convert_tanggal_jadi_string($data->tanggal_perpanjangan));
        $template->setValue('value12', convert_tanggal_jadi_string($data->tanggal_terbit));


        $template->save(APPPATH. '../saved/sipi_perubahan.docx');
        $this->m_fo->set_status_proses($no_daftar, 11);

        ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/sipi_perubahan.docx';
            setTimeout(function(){
                window.location = '<?php echo site_url("c_cetak/belum") ?>';
            }, 3000);
        </script>
        <?php 
    }

    public function cetak_ssrd($no_daftar){

        //load our new PHPExcel library
        $this->load->library('excel_iofactory');

        $data = $this->m_fo->get_where_no_daftar($no_daftar);
        
        // echo "<pre>";
        // print_r($this->excel_iofactory);
        // echo "</pre>";
        // 
        // print_r($data);
        
        $objReader = $this->excel_iofactory;
        $objReader = $objReader::createReader('Excel2007');
        $objPHPExcel = $objReader->load(APPPATH. '../templates/ssrd_sipi.xlsx');

        $nama = $data->sipi_baru_nama;
        $objPHPExcel->getActiveSheet()->setCellValue('E9', "$nama");

        $alamat = strtoupper($data->sipi_baru_alamat .' GP. '. $this->m_kel->get_nm_kel($data->sipi_baru_id_kel).' KEL. '. $this->m_kec->get_nm_kec($data->sipi_baru_id_kec). ' KAB. BIREUEN');
        $objPHPExcel->getActiveSheet()->setCellValue('E11', "$alamat");
        
        
        $jenis_alat_tangkap = $this->m_jenis_alat_tangkap->get_nama_jenis_alat_tangkap($data->sipi_baru_id_jenis_alat_tangkap);
        $objPHPExcel->getActiveSheet()->setCellValue('I28', "$jenis_alat_tangkap");

        $nilai_retribusi = $data->sipi_baru_nilai_retribusi;
        $objPHPExcel->getActiveSheet()->setCellValue('P32', "$nilai_retribusi");

        $objPHPExcel->getActiveSheet()->setCellValue('X27', "$nilai_retribusi");
        $objPHPExcel->getActiveSheet()->setCellValue('X38', "$nilai_retribusi"); 

        $objPHPExcel->getActiveSheet()->setCellValue('D40', ucwords(terbilang($nilai_retribusi)));        

        $objPHPExcel->getActiveSheet()->setCellValue('L47', date('d-m-Y'));  
        $objPHPExcel->getActiveSheet()->setCellValue('W44', 'Bireuen, '.date('d-m-Y'));
        $objPHPExcel->getActiveSheet()->setCellValue('W49', $data->nama_pemohon);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(APPPATH. '../saved/ssrd_sipi.xlsx');

         ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/ssrd_sipi.xlsx';
            setTimeout(function(){
                window.location = '<?php echo site_url("c_penetapan/belum") ?>';
            }, 3000);
        </script>
        <?php 
    }

    public function cetak_ssrd_perpanjangan($no_daftar){

        //load our new PHPExcel library
        $this->load->library('excel_iofactory');

        $data = $this->m_fo->get_where_no_daftar($no_daftar);
        $data_lalu = $this->m_fo->get_where_no_daftar($no_daftar);
        
        // echo "<pre>";
        // print_r($this->excel_iofactory);
        // echo "</pre>";
        
        $objReader = $this->excel_iofactory;
        $objReader = $objReader::createReader('Excel2007');
        $objPHPExcel = $objReader->load(APPPATH. '../templates/ssrd_ho.xlsx');

        $nama_pemilik = $data->sipi_perpanjangan_nama_pemilik;
        $objPHPExcel->getActiveSheet()->setCellValue('E9', "$nama_pemilik");

        // $alamat_pemilik = $data->sipi_perpanjangan_nama_pemilik;
        // $objPHPExcel->getActiveSheet()->setCellValue('E11', "$nama_pemilik");
        
        $lokasi = $this->m_index_lokasi->get_nama_index_lokasi($data->sipi_perpanjangan_kode_index_lokasi);
        $objPHPExcel->getActiveSheet()->setCellValue('D28', "$lokasi");
        
        $luas = $data->sipi_perpanjangan_panjang_tempat_usaha * $data->sipi_perpanjangan_lebar_tempat_usaha;
        $objPHPExcel->getActiveSheet()->setCellValue('E29', "$luas");

        $bidang = $this->m_bidang_ho->get_nama_bidang_ho($data->sipi_perpanjangan_id_bidang);
        $objPHPExcel->getActiveSheet()->setCellValue('D30', "$bidang");
        
        $nilai_index_lokasi      = $this->m_index_lokasi->get_nilai($data->sipi_perpanjangan_kode_index_lokasi);
        $nilai_index_luas        = $this->m_index_luas->get_nilai($data->sipi_perpanjangan_kode_index_luas);
        $nilai_index_gangguan    = $this->m_index_gangguan->get_nilai($data->sipi_perpanjangan_kode_index_gangguan);
        $nilai_index_harga_dasar = $this->m_index_harga_dasar->get_nilai($data->sipi_perpanjangan_kode_index_harga_dasar);

        $nilai_retribusi = $data->sipi_perpanjangan_nilai_retribusi;

        $objPHPExcel->getActiveSheet()->setCellValue('D32', "$nilai_index_lokasi");
        $objPHPExcel->getActiveSheet()->setCellValue('F32', "$nilai_index_luas");
        $objPHPExcel->getActiveSheet()->setCellValue('H32', "$nilai_index_gangguan");
        $objPHPExcel->getActiveSheet()->setCellValue('K32', "$nilai_index_harga_dasar");

        $objPHPExcel->getActiveSheet()->setCellValue('P32', "$nilai_retribusi");

        $objPHPExcel->getActiveSheet()->setCellValue('X27', "$nilai_retribusi");        
        $objPHPExcel->getActiveSheet()->setCellValue('X38', "$nilai_retribusi");        

        $objPHPExcel->getActiveSheet()->setCellValue('L47', date('d-m-Y'));     

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(APPPATH. '../saved/ssrd_ho.xlsx');

         ?>
        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/ssrd_ho.xlsx';
            setTimeout(function(){
                window.location = '<?php echo site_url("c_penetapan/belum") ?>';
            }, 3000);
        </script>
        <?php 
    }

    
}