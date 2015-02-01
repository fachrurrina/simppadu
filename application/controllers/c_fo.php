<?php

class C_fo extends CI_Controller {

    function __construct(){

        parent::__construct();
    }

    public function index(){
        $this->tertunda();
    }

    public function daftar_1(){

        $data['modul'] = $this->m_modul->get_all();

        $this->load->view('templates/top');
        $this->load->view('v_fo_daftar_1', $data);
        $this->load->view('templates/bottom');
    }

    public function daftar_2(){

        if($this->input->post('simpan')){

            $data_pendaftaran = array(
                'no_daftar'       => $this->m_fo->get_no_daftar_baru(),
                'tanggal_daftar'  => $this->input->post('tanggal_daftar'),
                'id_modul'        => $this->input->post('id_modul'),
                'id_sub_modul'    => $this->input->post('id_sub_modul'),
                'status_proses'   => 1,
                'nama_pemohon'    => $this->input->post('nama_pemohon'),
                'no_telp_pemohon' => $this->input->post('no_telp_pemohon'),
                'id_syarat'       => implode('|', $this->input->post('id_syarat'))
            );

            switch ($this->m_sub_modul->get_nama_sub_modul($this->input->post('id_sub_modul'))) {

                case 'imb_baru':
                    $data_pendaftaran['imb_baru_nama_pemilik'] = $this->input->post('imb_baru_nama_pemilik');
                    $data_pendaftaran['imb_baru_alamat_bangunan'] = $this->input->post('imb_baru_alamat_bangunan');
                    $data_pendaftaran['imb_baru_id_kec_bangunan'] = $this->input->post('imb_baru_id_kec_bangunan');
                    $data_pendaftaran['imb_baru_id_kel_bangunan'] = $this->input->post('imb_baru_id_kel_bangunan');
                    break;

                case 'tdp_baru':
                    $data_pendaftaran['tdp_baru_nama_perusahaan']      = $this->input->post('tdp_baru_nama_perusahaan');
                    $data_pendaftaran['tdp_baru_id_bentuk_perusahaan'] = $this->input->post('tdp_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['tdp_baru_status_perusahaan']    = $this->input->post('tdp_baru_status_perusahaan');
                    $data_pendaftaran['tdp_baru_nama_pemilik']         = $this->input->post('tdp_baru_nama_pemilik');
                    $data_pendaftaran['tdp_baru_jenis_usaha']         = $this->input->post('tdp_baru_jenis_usaha');
                    break;

                case 'tdp_perpanjangan':
                    $data_pendaftaran['tdp_perpanjangan_no_sk']             = $this->input->post('tdp_perpanjangan_no_sk');
                    $data_pendaftaran['tdp_perpanjangan_status_perubahan']  = $this->input->post('tdp_perpanjangan_status_perubahan');
                    $data_pendaftaran['tdp_perpanjangan_alasan_penerbitan'] = $this->input->post('tdp_perpanjangan_alasan_penerbitan');
                    break;

                case 'tdp_perubahan':
                    $data_pendaftaran['tdp_perubahan_no_sk']             = $this->input->post('tdp_perubahan_no_sk');
                    $data_pendaftaran['tdp_perubahan_alasan_penerbitan'] = $this->input->post('tdp_perubahan_alasan_penerbitan');
                    break;

                case 'siup_baru':
                    $data_pendaftaran['siup_baru_nama_perusahaan']      = $this->input->post('siup_baru_nama_perusahaan');
                    $data_pendaftaran['siup_baru_id_bentuk_perusahaan'] = $this->input->post('siup_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['siup_baru_nama_pemilik']         = $this->input->post('siup_baru_nama_pemilik');
                    $data_pendaftaran['siup_baru_jenis_usaha']         = $this->input->post('siup_baru_jenis_usaha');
                    break;

                case 'siup_perpanjangan':
                    $data_pendaftaran['siup_perpanjangan_no_sk']            = $this->input->post('siup_perpanjangan_no_sk');
                    $data_pendaftaran['siup_perpanjangan_status_perubahan'] = $this->input->post('siup_perpanjangan_status_perubahan');
                    $data_pendaftaran['siup_perpanjangan_alasan_penerbitan'] = $this->input->post('siup_perpanjangan_alasan_penerbitan');
                    break;

                case 'siup_perubahan':
                    $data_pendaftaran['siup_perubahan_no_sk']             = $this->input->post('siup_perubahan_no_sk');
                    $data_pendaftaran['siup_perubahan_alasan_penerbitan'] = $this->input->post('siup_perubahan_alasan_penerbitan');
                    break;

                case 'situ_baru':
                    $data_pendaftaran['situ_baru_nama_perusahaan']      = $this->input->post('situ_baru_nama_perusahaan');
                    $data_pendaftaran['situ_baru_id_bentuk_perusahaan'] = $this->input->post('situ_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['situ_baru_nama_pemilik']         = $this->input->post('situ_baru_nama_pemilik');
                    $data_pendaftaran['situ_baru_jenis_usaha']         = $this->input->post('situ_baru_jenis_usaha');
                    break;

                case 'situ_perpanjangan':
                    $data_pendaftaran['situ_perpanjangan_no_sk']            = $this->input->post('situ_perpanjangan_no_sk');
                    $data_pendaftaran['situ_perpanjangan_status_perubahan'] = $this->input->post('situ_perpanjangan_status_perubahan');
                    break;

                case 'situ_perubahan':
                    $data_pendaftaran['situ_perubahan_no_sk']       = $this->input->post('situ_perubahan_no_sk');
                    break;

                /*-----------------------------------------------------SIUJK-----------------------------------------------------*/
                case 'siujk_baru':
                    $data_pendaftaran['siujk_baru_nama_perusahaan']      = $this->input->post('siujk_baru_nama_perusahaan');
                    $data_pendaftaran['siujk_baru_id_bentuk_perusahaan'] = $this->input->post('siujk_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['siujk_baru_nama_pemilik']         = $this->input->post('siujk_baru_nama_pemilik');
                    $data_pendaftaran['siujk_baru_npwp']                 = $this->input->post('siujk_baru_npwp');
                    $data_pendaftaran['siujk_baru_jenis_usaha']          = $this->input->post('siujk_baru_jenis_usaha');
                    break;  

                case 'siujk_perpanjangan':
                    $data_pendaftaran['siujk_perpanjangan_no_sk']            = $this->input->post('siujk_perpanjangan_no_sk');
                    $data_pendaftaran['siujk_perpanjangan_status_perubahan'] = $this->input->post('siujk_perpanjangan_status_perubahan');
                    break;

                case 'siujk_perubahan':
                    $data_pendaftaran['siujk_perubahan_no_sk']            = $this->input->post('siujk_perubahan_no_sk');
                    break;
                /*------------------------------------------------------END SIUJK------------------------------------------------------*/


                case 'ho_baru':
                    $data_pendaftaran['ho_baru_nama_perusahaan']      = $this->input->post('ho_baru_nama_perusahaan');
                    $data_pendaftaran['ho_baru_id_bentuk_perusahaan'] = $this->input->post('ho_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['ho_baru_nama_bidang_usaha']    = $this->input->post('ho_baru_nama_bidang_usaha');
                    $data_pendaftaran['ho_baru_nama_pemilik']         = $this->input->post('ho_baru_nama_pemilik');
                    
                    break;

                case 'ho_perpanjangan':
                    $data_pendaftaran['ho_perpanjangan_no_sk']            = $this->input->post('ho_perpanjangan_no_sk');
                    $data_pendaftaran['ho_perpanjangan_status_perubahan'] = $this->input->post('ho_perpanjangan_status_perubahan');
                    break;

                case 'ho_perubahan':
                    $data_pendaftaran['ho_perubahan_no_sk']            = $this->input->post('ho_perubahan_no_sk');
                    break;

                

               case 'siuk_baru':
                    $data_pendaftaran['siuk_baru_nama_perusahaan']      = $this->input->post('siuk_baru_nama_perusahaan');
                    $data_pendaftaran['siuk_baru_id_bentuk_perusahaan'] = $this->input->post('siuk_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['siuk_baru_nama_pemilik']         = $this->input->post('siuk_baru_nama_pemilik');
                    $data_pendaftaran['siuk_baru_jenis_usaha']         = $this->input->post('siuk_baru_jenis_usaha');
                    break;

                case 'siuk_perpanjangan':
                    $data_pendaftaran['siuk_perpanjangan_no_sk']            = $this->input->post('siuk_perpanjangan_no_sk');
                    $data_pendaftaran['siuk_perpanjangan_status_perubahan'] = $this->input->post('siuk_perpanjangan_status_perubahan');
                    break;

                case 'siuk_perubahan':
                    $data_pendaftaran['siuk_perubahan_no_sk']       = $this->input->post('siuk_perubahan_no_sk');
                    break;

                case 'tdi_baru':
                    $data_pendaftaran['tdi_baru_nama_perusahaan']      = $this->input->post('tdi_baru_nama_perusahaan');
                    $data_pendaftaran['tdi_baru_id_bentuk_perusahaan'] = $this->input->post('tdi_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['tdi_baru_nama_pemilik']         = $this->input->post('tdi_baru_nama_pemilik');
                    break;

                case 'tdi_perubahan':
                    $data_pendaftaran['tdi_perubahan_no_sk']            = $this->input->post('tdi_perubahan_no_sk');
                    break;

                case 'sipl_baru':
                    $data_pendaftaran['sipl_baru_nama_perusahaan']      = $this->input->post('sipl_baru_nama_perusahaan');
                    $data_pendaftaran['sipl_baru_id_bentuk_perusahaan'] = $this->input->post('sipl_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['sipl_baru_nama_pemilik']         = $this->input->post('sipl_baru_nama_pemilik');
                    break;

                case 'sipk_baru':
                    $data_pendaftaran['sipk_baru_nama_kapal']   = $this->input->post('sipk_baru_nama_kapal');
                    $data_pendaftaran['sipk_baru_nama_pemilik'] = $this->input->post('sipk_baru_nama_pemilik');
                    break;

                case 'sisbw_baru':
                    $data_pendaftaran['sisbw_baru_nama_pemilik'] = $this->input->post('sisbw_baru_nama_pemilik');
                    break;

                case 'siuakb_baru':
                    $data_pendaftaran['siuakb_baru_nama_perusahaan']   = $this->input->post('siuakb_baru_nama_perusahaan');
                    $data_pendaftaran['siuakb_baru_nama_pemilik'] = $this->input->post('siuakb_baru_nama_pemilik');
                    $data_pendaftaran['siuakb_baru_jenis_usaha'] = $this->input->post('siuakb_baru_jenis_usaha');
                    break;

                case 'sib_baru':
                    $data_pendaftaran['sib_baru_nama_perusahaan']   = $this->input->post('sib_baru_nama_perusahaan');
                    $data_pendaftaran['sib_baru_nama_pemilik'] = $this->input->post('sib_baru_nama_pemilik');
                    break;

                case 'sipd_baru':
                    $data_pendaftaran['sipd_baru_nama_perusahaan']      = $this->input->post('sipd_baru_nama_perusahaan');
                    $data_pendaftaran['sipd_baru_id_bentuk_perusahaan'] = $this->input->post('sipd_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['sipd_baru_nama_pemilik']         = $this->input->post('sipd_baru_nama_pemilik');
                    break;

                case 'sipb_baru':
                    $data_pendaftaran['sipb_baru_nama_pemilik']        = $this->input->post('sipb_baru_nama_pemilik');
                    $data_pendaftaran['sipb_baru_nama_tempat_praktek'] = $this->input->post('sipb_baru_nama_tempat_praktek');
                    break;


                case 'sikp_baru':
                    $data_pendaftaran['sikp_baru_nama_pemilik']        = $this->input->post('sikp_baru_nama_pemilik');
                    $data_pendaftaran['sikp_baru_nama_tempat_kerja'] = $this->input->post('sikp_baru_nama_tempat_kerja');
                    break;

                case 'sikb_baru':
                    $data_pendaftaran['sikb_baru_nama_pemilik']        = $this->input->post('sikb_baru_nama_pemilik');
                    $data_pendaftaran['sikb_baru_nama_tempat_kerja'] = $this->input->post('sikb_baru_nama_tempat_kerja');
                    break;

                case 'sipp_baru':
                    $data_pendaftaran['sipp_baru_nama_pemilik']        = $this->input->post('sipp_baru_nama_pemilik');
                    $data_pendaftaran['sipp_baru_nama_tempat_praktek'] = $this->input->post('sipp_baru_nama_tempat_praktek');
                    break;

                case 'sipo_baru':
                    $data_pendaftaran['sipo_baru_nama_pemilik'] = $this->input->post('sipo_baru_nama_pemilik');
                    $data_pendaftaran['sipo_baru_nama_optik']   = $this->input->post('sipo_baru_nama_optik');
                    break;

                case 'sipo_perpanjangan':
                    $data_pendaftaran['sipo_perpanjangan_no_sk']            = $this->input->post('sipo_perpanjangan_no_sk');
                    $data_pendaftaran['sipo_perpanjangan_status_perubahan'] = $this->input->post('sipo_perpanjangan_status_perubahan');
                    break;

                case 'sia_baru':
                    $data_pendaftaran['sia_baru_nama_pemilik'] = $this->input->post('sia_baru_nama_pemilik');
                    $data_pendaftaran['sia_baru_nama_apotik']   = $this->input->post('sia_baru_nama_apotik');
                    break;

                case 'sia_perpanjangan':
                    $data_pendaftaran['sia_perpanjangan_no_sk']            = $this->input->post('sia_perpanjangan_no_sk');
                    $data_pendaftaran['sia_perpanjangan_status_perubahan'] = $this->input->post('sia_perpanjangan_status_perubahan');
                    break;

                case 'sik_baru':
                    $data_pendaftaran['sik_baru_nama_pemilik'] = $this->input->post('sik_baru_nama_pemilik');
                    $data_pendaftaran['sik_baru_nama_klinik']   = $this->input->post('sik_baru_nama_klinik');
                    break;

                case 'siot_baru':
                    $data_pendaftaran['siot_baru_nama_pemilik'] = $this->input->post('siot_baru_nama_pemilik');
                    $data_pendaftaran['siot_baru_nama_rumah_sakit']   = $this->input->post('siot_baru_nama_rumah_sakit');
                    break;

                case 'sios_baru':
                    $data_pendaftaran['sios_baru_nama_pemilik'] = $this->input->post('sios_baru_nama_pemilik');
                    $data_pendaftaran['sios_baru_nama_rumah_sakit']   = $this->input->post('sios_baru_nama_rumah_sakit');
                    break;

                case 'sippbbm_baru':
                    
                    $data_pendaftaran['sippbbm_baru_nama_pemohon'] = $this->input->post('sippbbm_baru_nama_pemohon');
                    $data_pendaftaran['sippbbm_baru_pekerjaan_pemohon'] = $this->input->post('sippbbm_baru_pekerjaan_pemohon');
                    $data_pendaftaran['sippbbm_baru_alamat_pemohon'] = $this->input->post('sippbbm_baru_alamat_pemohon');
                    $data_pendaftaran['sippbbm_baru_id_kec_pemohon'] = $this->input->post('sippbbm_baru_id_kec_pemohon');
                    $data_pendaftaran['sippbbm_baru_id_kel_pemohon'] = $this->input->post('sippbbm_baru_id_kel_pemohon');
                    $data_pendaftaran['sippbbm_baru_nama_pemilik'] = $this->input->post('sippbbm_baru_nama_pemilik');
                    $data_pendaftaran['sippbbm_baru_nama_perusahaan'] = $this->input->post('sippbbm_baru_nama_perusahaan');
                    break;

                case 'imb_baru':
                    $data_pendaftaran['imb_baru_nama_pemilik'] = $this->input->post('imb_baru_nama_pemilik');
                    $data_pendaftaran['imb_baru_id_jenis_bangunan']   = $this->input->post('imb_baru_id_jenis_bangunan');
                    
                    break;

                case 'sipi_baru':
                    $data_pendaftaran['sipi_baru_nama'] = $this->input->post('sipi_baru_nama');
                    $data_pendaftaran['sipi_baru_nama_kapal']   = $this->input->post('sipi_baru_nama_kapal');
                    
                    break;

                case 'iup_baru':
                    $data_pendaftaran['iup_baru_nama_perusahaan'] = $this->input->post('iup_baru_nama_perusahaan');
                    $data_pendaftaran['iup_baru_nama_penanggung_jawab']   = $this->input->post('iup_baru_nama_penanggung_jawab');
                    break;
                
                default:
                    # code...
                    break;
            }

            $insert_pendaftaran = $this->m_fo->insert_pendaftaran($data_pendaftaran);

            if($insert_pendaftaran){
                redirect('c_fo');
            }else{
                echo "gagal simpan";
            }
        }

        $data['modul']          = $this->m_modul->get_all();
        $data['sub_modul']      = $this->m_sub_modul->get_all();
        
        $data['tanggal_daftar'] = $this->input->get('tanggal_daftar');
        $data['id_modul']       = $this->input->get('id_modul');
        $data['id_sub_modul']   = $this->input->get('id_sub_modul');
        
        $data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['id_sub_modul']);
        $data['syarat']         = $this->m_syarat->get_where_id_sub_modul($data['id_sub_modul']);

        $data['kec']         = $this->m_kec->get_all();
        $data['kel']         = $this->m_kel->get_all();

        // tdp_baru
        $data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();
        $data['bidang_situ'] = $this->m_bidang_situ->get_all();

        
        $data['form_fo'] = $this->load->view('fo/'. $data['nama_sub_modul'], $data, true);
        
        
        $this->load->view('templates/top');
        $this->load->view('v_fo_daftar_2', $data);
        $this->load->view('templates/bottom');
    }

    public function tertunda(){

        $data['tertunda'] = $this->m_fo->get_where_status_proses(array(1));

        $this->load->view('templates/top');
        $this->load->view('v_fo_tertunda', $data);
        $this->load->view('templates/bottom');
    }

    public function tolak(){

        $data['tolak'] = $this->m_fo->get_where_status_proses(array(3));

        $this->load->view('templates/top');
        $this->load->view('v_fo_tolak', $data);
        $this->load->view('templates/bottom');
    }

    public function edit_tolak($no_daftar){

        if($this->input->post('simpan')){

            $data_pendaftaran = array(
                'tanggal_daftar'  => $this->input->post('tanggal_daftar'),
                'id_modul'        => $this->input->post('id_modul'),
                'id_sub_modul'    => $this->input->post('id_sub_modul'),
                'status_proses'   => 1,
                'nama_pemohon'    => $this->input->post('nama_pemohon'),
                'no_telp_pemohon' => $this->input->post('no_telp_pemohon'),
                'id_syarat'       => implode('|', $this->input->post('id_syarat'))
            );

            switch ($this->m_sub_modul->get_nama_sub_modul($this->input->post('id_sub_modul'))) {
                case 'imb_baru':
                    $data_pendaftaran['imb_baru_nama_pemilik'] = $this->input->post('imb_baru_nama_pemilik');
                    $data_pendaftaran['imb_baru_alamat_bangunan'] = $this->input->post('imb_baru_alamat_bangunan');
                    $data_pendaftaran['imb_baru_id_kec_bangunan'] = $this->input->post('imb_baru_id_kec_bangunan');
                    $data_pendaftaran['imb_baru_id_kel_bangunan'] = $this->input->post('imb_baru_id_kel_bangunan');
                    break;
                    
                case 'tdp_baru':
                    $data_pendaftaran['tdp_baru_nama_perusahaan']      = $this->input->post('tdp_baru_nama_perusahaan');
                    $data_pendaftaran['tdp_baru_id_bentuk_perusahaan'] = $this->input->post('tdp_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['tdp_baru_status_perusahaan']    = $this->input->post('tdp_baru_status_perusahaan');
                    $data_pendaftaran['tdp_baru_nama_pemilik']         = $this->input->post('tdp_baru_nama_pemilik');
                    $data_pendaftaran['tdp_baru_jenis_usaha']         = $this->input->post('tdp_baru_jenis_usaha');
                    break;

                case 'tdp_perpanjangan':
                    $data_pendaftaran['tdp_perpanjangan_no_sk']             = $this->input->post('tdp_perpanjangan_no_sk');
                    $data_pendaftaran['tdp_perpanjangan_status_perubahan']  = $this->input->post('tdp_perpanjangan_status_perubahan');
                    $data_pendaftaran['tdp_perpanjangan_alasan_penerbitan'] = $this->input->post('tdp_perpanjangan_alasan_penerbitan');
                    break;

                case 'tdp_perubahan':
                    $data_pendaftaran['tdp_perubahan_no_sk']             = $this->input->post('tdp_perubahan_no_sk');
                    $data_pendaftaran['tdp_perubahan_alasan_penerbitan'] = $this->input->post('tdp_perubahan_alasan_penerbitan');
                    break;

                case 'siup_baru':
                    $data_pendaftaran['siup_baru_nama_perusahaan']      = $this->input->post('siup_baru_nama_perusahaan');
                    $data_pendaftaran['siup_baru_id_bentuk_perusahaan'] = $this->input->post('siup_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['siup_baru_nama_pemilik']         = $this->input->post('siup_baru_nama_pemilik');
                    $data_pendaftaran['siup_baru_jenis_usaha']         = $this->input->post('siup_baru_jenis_usaha');
                    break;

                case 'siup_perpanjangan':
                    $data_pendaftaran['siup_perpanjangan_no_sk']            = $this->input->post('siup_perpanjangan_no_sk');
                    $data_pendaftaran['siup_perpanjangan_status_perubahan'] = $this->input->post('siup_perpanjangan_status_perubahan');
                    $data_pendaftaran['siup_perpanjangan_alasan_penerbitan'] = $this->input->post('siup_perpanjangan_alasan_penerbitan');
                    break;

                case 'siup_perubahan':
                    $data_pendaftaran['siup_perubahan_no_sk']             = $this->input->post('siup_perubahan_no_sk');
                    $data_pendaftaran['siup_perubahan_alasan_penerbitan'] = $this->input->post('siup_perubahan_alasan_penerbitan');
                    break;

                case 'situ_baru':
                    $data_pendaftaran['situ_baru_nama_perusahaan']      = $this->input->post('situ_baru_nama_perusahaan');
                    $data_pendaftaran['situ_baru_id_bentuk_perusahaan'] = $this->input->post('situ_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['situ_baru_nama_pemilik']         = $this->input->post('situ_baru_nama_pemilik');
                    $data_pendaftaran['situ_baru_jenis_usaha']         = $this->input->post('situ_baru_jenis_usaha');
                    break;

                case 'situ_perpanjangan':
                    $data_pendaftaran['situ_perpanjangan_no_sk']            = $this->input->post('situ_perpanjangan_no_sk');
                    $data_pendaftaran['situ_perpanjangan_status_perubahan'] = $this->input->post('situ_perpanjangan_status_perubahan');
                    break;

                case 'situ_perubahan':
                    $data_pendaftaran['situ_perubahan_no_sk']            = $this->input->post('situ_perubahan_no_sk');  
                    break;

                /*-----------------------------------------------------SIUJK-----------------------------------------------------*/
                case 'siujk_baru':
                    $data_pendaftaran['siujk_baru_nama_perusahaan']      = $this->input->post('siujk_baru_nama_perusahaan');
                    $data_pendaftaran['siujk_baru_id_bentuk_perusahaan'] = $this->input->post('siujk_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['siujk_baru_nama_pemilik']         = $this->input->post('siujk_baru_nama_pemilik');
                    $data_pendaftaran['siujk_baru_npwp']                 = $this->input->post('siujk_baru_npwp');
                    $data_pendaftaran['siujk_baru_jenis_usaha']          = $this->input->post('siujk_baru_jenis_usaha');
                    break;  

                case 'siujk_perpanjangan':
                    $data_pendaftaran['siujk_perpanjangan_no_sk']            = $this->input->post('siujk_perpanjangan_no_sk');
                    $data_pendaftaran['siujk_perpanjangan_status_perubahan'] = $this->input->post('siujk_perpanjangan_status_perubahan');
                    break;

                case 'siujk_perubahan':
                    $data_pendaftaran['siujk_perubahan_no_sk']            = $this->input->post('siujk_perubahan_no_sk');
                    break;
                /*------------------------------------------------------END SIUJK------------------------------------------------------*/

                case 'ho_baru':
                    $data_pendaftaran['ho_baru_nama_perusahaan']      = $this->input->post('ho_baru_nama_perusahaan');
                    $data_pendaftaran['ho_baru_id_bentuk_perusahaan'] = $this->input->post('ho_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['ho_baru_nama_bidang_usaha']    = $this->input->post('ho_baru_nama_bidang_usaha');
                    $data_pendaftaran['ho_baru_nama_pemilik']         = $this->input->post('ho_baru_nama_pemilik');
                    break;

                case 'ho_perpanjangan':
                    $data_pendaftaran['ho_perpanjangan_no_sk']            = $this->input->post('ho_perpanjangan_no_sk');
                    $data_pendaftaran['ho_perpanjangan_status_perubahan'] = $this->input->post('ho_perpanjangan_status_perubahan');
                    break;

                case 'ho_perubahan':
                    $data_pendaftaran['ho_perubahan_no_sk']            = $this->input->post('ho_perubahan_no_sk');
                    break;

               case 'siuk_baru':
                    $data_pendarftaran['siuk_baru_nama_perusahaan']      = $this->input->post('siuk_baru_nama_perusahaan');
                    $data_pendaftaran['siuk_baru_id_bentuk_perusahaan'] = $this->input->post('siuk_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['siuk_baru_nama_pemilik']         = $this->input->post('siuk_baru_nama_pemilik');
                    $data_pendaftaran['siuk_baru_jenis_usaha']         = $this->input->post('siuk_baru_jenis_usaha');
                    break;

                case 'siuk_perpanjangan':
                    $data_pendaftaran['siuk_perpanjangan_no_sk']            = $this->input->post('siuk_perpanjangan_no_sk');
                    $data_pendaftaran['siuk_perpanjangan_status_perubahan'] = $this->input->post('siuk_perpanjangan_status_perubahan');
                    break;

                 


                case 'sipl_baru':
                    $data_pendaftaran['sipl_baru_nama_perusahaan']      = $this->input->post('sipl_baru_nama_perusahaan');
                    $data_pendaftaran['sipl_baru_id_bentuk_perusahaan'] = $this->input->post('sipl_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['sipl_baru_nama_pemilik']         = $this->input->post('sipl_baru_nama_pemilik');
                    break;

                case 'sipk_baru':
                    $data_pendaftaran['sipk_baru_nama_kapal']   = $this->input->post('sipk_baru_nama_kapal');
                    $data_pendaftaran['sipk_baru_nama_pemilik'] = $this->input->post('sipk_baru_nama_pemilik');
                    break;

                case 'sisbw_baru':
                    $data_pendaftaran['sisbw_baru_nama_pemilik'] = $this->input->post('sisbw_baru_nama_pemilik');
                    break;

                case 'siuakb_baru':
                    $data_pendaftaran['siuakb_baru_nama_perusahaan']   = $this->input->post('siuakb_baru_nama_perusahaan');
                    $data_pendaftaran['siuakb_baru_nama_pemilik'] = $this->input->post('siuakb_baru_nama_pemilik');
                    $data_pendaftaran['siuakb_baru_jenis_usaha'] = $this->input->post('siuakb_baru_jenis_usaha');
                    break;

                case 'sib_baru':
                    $data_pendaftaran['sib_baru_nama_perusahaan']   = $this->input->post('sib_baru_nama_perusahaan');
                    $data_pendaftaran['sib_baru_nama_pemilik'] = $this->input->post('sib_baru_nama_pemilik');
                    break;

                case 'sipd_baru':
                    $data_pendaftaran['sipd_baru_nama_perusahaan']      = $this->input->post('sipd_baru_nama_perusahaan');
                    $data_pendaftaran['sipd_baru_id_bentuk_perusahaan'] = $this->input->post('sipd_baru_id_bentuk_perusahaan');
                    $data_pendaftaran['sipd_baru_nama_pemilik']         = $this->input->post('sipd_baru_nama_pemilik');
                    break;

                case 'sipb_baru':
                    $data_pendaftaran['sipb_baru_nama_pemilik']        = $this->input->post('sipb_baru_nama_pemilik');
                    $data_pendaftaran['sipb_baru_nama_tempat_praktek'] = $this->input->post('sipb_baru_nama_tempat_praktek');
                    break;

                case 'sikb_baru':
                    $data_pendaftaran['sikb_baru_nama_pemilik']        = $this->input->post('sikb_baru_nama_pemilik');
                    $data_pendaftaran['sikb_baru_nama_tempat_kerja'] = $this->input->post('sikb_baru_nama_tempat_kerja');
                    break;

                case 'sikp_baru':
                    $data_pendaftaran['sikp_baru_nama_pemilik']        = $this->input->post('sikp_baru_nama_pemilik');
                    $data_pendaftaran['sikp_baru_nama_tempat_kerja'] = $this->input->post('sikp_baru_nama_tempat_kerja');
                    break;

                case 'sipp_baru':
                    $data_pendaftaran['sipp_baru_nama_pemilik']        = $this->input->post('sipp_baru_nama_pemilik');
                    $data_pendaftaran['sipp_baru_nama_tempat_praktek'] = $this->input->post('sipp_baru_nama_tempat_praktek');
                    break;

                case 'sipo_baru':
                    $data_pendaftaran['sipo_baru_nama_pemilik'] = $this->input->post('sipo_baru_nama_pemilik');
                    $data_pendaftaran['sipo_baru_nama_optik']   = $this->input->post('sipo_baru_nama_optik');
                    break;

                case 'sipo_perpanjangan':
                    $data_pendaftaran['sipo_perpanjangan_no_sk']            = $this->input->post('sipo_perpanjangan_no_sk');
                    $data_pendaftaran['sipo_perpanjangan_status_perubahan'] = $this->input->post('sipo_perpanjangan_status_perubahan');
                    break;

                case 'sia_baru':
                    $data_pendaftaran['sia_baru_nama_pemilik'] = $this->input->post('sia_baru_nama_pemilik');
                    $data_pendaftaran['sia_baru_nama_apotik']   = $this->input->post('sia_baru_nama_apotik');
                    break;

                case 'sia_perpanjangan':
                    $data_pendaftaran['sia_perpanjangan_no_sk']            = $this->input->post('sia_perpanjangan_no_sk');
                    $data_pendaftaran['sia_perpanjangan_status_perubahan'] = $this->input->post('sia_perpanjangan_status_perubahan');
                    break;

                case 'sik_baru':
                    $data_pendaftaran['sik_baru_nama_pemilik'] = $this->input->post('sik_baru_nama_pemilik');
                    $data_pendaftaran['sik_baru_nama_klinik']   = $this->input->post('sik_baru_nama_klinik');
                    break;
                
                case 'siot_baru':
                    $data_pendaftaran['siot_baru_nama_pemilik'] = $this->input->post('siot_baru_nama_pemilik');
                    $data_pendaftaran['siot_baru_nama_rumah_sakit']   = $this->input->post('siot_baru_nama_rumah_sakit');
                    break;

                case 'sios_baru':
                    $data_pendaftaran['sios_baru_nama_pemilik'] = $this->input->post('sios_baru_nama_pemilik');
                    $data_pendaftaran['sios_baru_nama_rumah_sakit']   = $this->input->post('sios_baru_nama_rumah_sakit');
                    break;

                case 'sippbbm_baru':
                    
                    $data_pendaftaran['sippbbm_baru_nama_pemohon'] = $this->input->post('sippbbm_baru_nama_pemohon');
                    $data_pendaftaran['sippbbm_baru_pekerjaan_pemohon'] = $this->input->post('sippbbm_baru_pekerjaan_pemohon');
                    $data_pendaftaran['sippbbm_baru_alamat_pemohon'] = $this->input->post('sippbbm_baru_alamat_pemohon');
                    $data_pendaftaran['sippbbm_baru_id_kec_pemohon'] = $this->input->post('sippbbm_baru_id_kec_pemohon');
                    $data_pendaftaran['sippbbm_baru_id_kel_pemohon'] = $this->input->post('sippbbm_baru_id_kel_pemohon');
                    $data_pendaftaran['sippbbm_baru_nama_pemilik'] = $this->input->post('sippbbm_baru_nama_pemilik');
                    $data_pendaftaran['sippbbm_baru_nama_perusahaan'] = $this->input->post('sippbbm_baru_nama_perusahaan');
                    break;

                case 'tdi_perubahan':
                    $data_pendaftaran['tdi_perubahan_no_sk']            = $this->input->post('tdi_perubahan_no_sk');
                    break;

                case 'imb_baru':
                    $data_pendaftaran['imb_baru_nama_pemilik']      = $this->input->post('imb_baru_nama_pemilik');
                    $data_pendaftaran['imb_baru_id_jenis_bangunan'] = $this->input->post('imb_baru_id_jenis_bangunan');
                    break;

                case 'sipi_baru':
                    $data_pendaftaran['sipi_baru_nama'] = $this->input->post('sipi_baru_nama');
                    $data_pendaftaran['sipi_baru_nama_kapal']   = $this->input->post('sipi_baru_nama_kapal');
                    
                    break;

                case 'iup_baru':
                    $data_pendaftaran['iup_baru_nama_perusahaan'] = $this->input->post('iup_baru_nama_perusahaan');
                    $data_pendaftaran['iup_baru_nama_penanggung_jawab']   = $this->input->post('iup_baru_nama_penanggung_jawab');
                    break;


                    
                default:
                    # code...
                    break;
            }

            $update_pendaftaran = $this->m_fo->update_pendaftaran($no_daftar, $data_pendaftaran);

            if($update_pendaftaran){
                redirect('c_fo/tertunda');
            }else{
                echo "gagal simpan";
            }
        }

        $data['edit']           = $this->m_fo->get_where_no_daftar($no_daftar);

        $data['modul']          = $this->m_modul->get_all();
        $data['sub_modul']      = $this->m_sub_modul->get_all();
        
        
        $data['nama_sub_modul'] = $this->m_sub_modul->get_nama_sub_modul($data['edit']->id_sub_modul);
        $data['syarat']         = $this->m_syarat->get_where_id_sub_modul($data['edit']->id_sub_modul);

        // tdp_baru
        $data['bentuk_perusahaan'] = $this->m_bentuk_perusahaan->get_all();

        $data['kec']         = $this->m_kec->get_all();
        $data['kel']         = $this->m_kel->get_all();

        
        $data['form_fo'] = $this->load->view('edit_tolak_verifikasi_i/'. $data['nama_sub_modul'], $data, true);

        // load data yang akan di edit
        
        $this->load->view('templates/top');
        $this->load->view('v_fo_edit_tolak', $data);
        $this->load->view('templates/bottom');
    }

    public function dalam_proses(){

        $data['dalam_proses'] = $this->m_fo->get_where_status_proses(array(2,4,5,6,7,9,8,10));

        $this->load->view('templates/top');
        $this->load->view('v_fo_dalam_proses', $data);
        $this->load->view('templates/bottom');
    }

    public function selesai(){

        $data['selesai'] = $this->m_fo->get_where_status_proses(11);

        $this->load->view('inc/header');
        $this->load->view('inc/top_nav');
        $this->load->view('v_fo_selesai', $data);
        $this->load->view('inc/footer');
    }

    public function cetak_ttb($no_daftar){

        error_reporting(1);
        $this->load->library('phpword');

        $template = $this->phpword->loadTemplate(APPPATH ."../templates/ttb.docx");
        $data     = $this->m_fo->get_where_no_daftar($no_daftar);

        $jenis_izin      = $this->m_modul->get_nama_modul($data->id_modul);
        $guna            = $this->m_sub_modul->get_nama_sub_modul($data->id_sub_modul);
        
        $array_ttb = [
            ['field' => 'No Daftar', 'value' => $data->no_daftar], 
            ['field' => 'Nama Pemohon', 'value' => $data->nama_pemohon], 
            ['field' => 'No Telp Pemohon', 'value' => $data->no_telp_pemohon], 
            ['field' => 'Tanggal Daftar', 'value' => convert_tanggal_jadi_string($data->tanggal_daftar)], 
            ['field' => 'Jenis Izin', 'value' => $this->m_modul->get_nama_modul($data->id_modul)], 
            ['field' => 'Guna', 'value' => $this->m_sub_modul->get_nama_sub_modul($data->id_sub_modul)], 
        ];

        switch ($guna) {

            case 'sipo_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->sipo_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Optik', 'value' => $data->sipo_baru_nama_optik]);
                break;


            case 'sipo_perpanjangan':
                $data_lalu = $this->m_sipo->get_where_no_sk($data->sipo_perpanjangan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_optik]);
                break;

            case 'sia_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->sia_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Apotik', 'value' => $data->sia_baru_nama_apotik]);
                break;

            case 'imb_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->imb_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Alamat Bangunan', 'value' => ucwords(strtolower($data->imb_baru_alamat_bangunan.' Gampong '. $this->m_kel->get_nm_kel($data->imb_baru_id_kel_bangunan).' Kecamatan '. $this->m_kec->get_nm_kec($data->imb_baru_id_kec_bangunan)))]);
                
                break;

            case 'ho_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->ho_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data->ho_baru_nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data->ho_baru_nama_bidang_usaha]);
                break;

            case 'ho_perpanjangan':
                $data_lalu = $this->m_ho->get_where_no_sk($data->ho_perpanjangan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data_lalu->nama_bidang_usaha]);
                break;

            case 'ho_perubahan':
                $data_lalu = $this->m_ho->get_where_no_sk($data->ho_perubahan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data_lalu->nama_bidang_usaha]);
                break;

            case 'situ_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->situ_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data->situ_baru_nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data->situ_baru_nama_bidang_situ]);
                break;

            case 'situ_perpanjangan':
                $data_lalu = $this->m_situ->get_where_no_sk($data->situ_perpanjangan_no_sk);

                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data_lalu->nama_bidang_situ]);
                break;

            case 'situ_perubahan':
                $data_lalu = $this->m_situ->get_where_no_sk($data->situ_perubahan_no_sk);

                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data_lalu->nama_bidang_situ]);
                break;


            case 'tdp_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->tdp_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data->tdp_baru_nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data->tdp_baru_jenis_usaha]);
                break;

            case 'tdp_perpanjangan':
                $data_lalu = $this->m_tdp->get_where_no_sk($data->tdp_perpanjangan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                break;

            case 'tdp_perubahan':
                $data_lalu = $this->m_tdp->get_where_no_sk($data->tdp_perubahan_no_sk);

                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                break;

            case 'siup_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->siup_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data->siup_baru_nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data->siup_baru_jenis_usaha]);
                break;

            case 'siup_perpanjangan':
                $data_lalu = $this->m_siup->get_where_no_sk($data->siup_perpanjangan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                break;

            case 'siup_perubahan':
                $data_lalu = $this->m_siup->get_where_no_sk($data->siup_perubahan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                break;

            case 'siujk_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->siujk_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data->siujk_baru_nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data->siujk_baru_jenis_usaha]);
                break;

            case 'siujk_perpanjangan':
                $data_lalu = $this->m_siujk->get_where_no_sk($data->siujk_perpanjangan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);

                $array_id_bidang_siujk = explode('|', $data_lalu->id_bidang_siujk);
                $array_nama_bidang_siujk = array();
                foreach ($array_id_bidang_siujk as $id_bidang_siujk) {
                    $array_nama_bidang_siujk[] = $this->m_bidang_siujk->get_nama_bidang_siujk($id_bidang_siujk);
                }
                $string_nama_bidang_siujk = implode(', ', $array_nama_bidang_siujk);
                array_push($array_ttb, ['field' => 'Bidang Usaha', 'value' => $string_nama_bidang_siujk]);
                break;

            case 'siujk_perubahan':
                $data_lalu = $this->m_siujk->get_where_no_sk($data->siujk_perubahan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);

                $array_id_bidang_siujk = explode('|', $data_lalu->id_bidang_siujk);
                $array_nama_bidang_siujk = array();
                foreach ($array_id_bidang_siujk as $id_bidang_siujk) {
                    $array_nama_bidang_siujk[] = $this->m_bidang_siujk->get_nama_bidang_siujk($id_bidang_siujk);
                }
                $string_nama_bidang_siujk = implode(', ', $array_nama_bidang_siujk);
                array_push($array_ttb, ['field' => 'Bidang Usaha', 'value' => $string_nama_bidang_siujk]);
                break;


            case 'sikp_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->sikp_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Tempat Kerja', 'value' => $data->sikp_baru_nama_tempat_kerja]);
                break;

            case 'sikb_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->sikb_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Tempat Kerja', 'value' => $data->sikb_baru_nama_tempat_kerja]);
                break;

            case 'sipl_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->sipl_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data->sipl_baru_nama_perusahaan]);
                break;

            case 'siuk_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->siuk_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data->siuk_baru_nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data->siuk_baru_jenis_usaha]);
                break;

            case 'siuk_perpanjangan':
                $data_lalu = $this->m_siuk->get_where_no_sk($data->siuk_perpanjangan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data_lalu->nama_bidang_usaha]);
                break;

            case 'siuk_perubahan':
                $data_lalu = $this->m_siuk->get_where_no_sk($data->siuk_perubahan_no_sk);
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data_lalu->nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data_lalu->nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data_lalu->nama_bidang_usaha]);
                break;

            case 'siuakb_baru':
                array_push($array_ttb, ['field' => 'Nama Pemilik', 'value' => $data->siuakb_baru_nama_pemilik]);
                array_push($array_ttb, ['field' => 'Nama Perusahaan', 'value' => $data->siuakb_baru_nama_perusahaan]);
                array_push($array_ttb, ['field' => 'Jenis Usaha', 'value' => $data->siuakb_baru_jenis_usaha]);
                break;
        }


        // pengambilan data syarat
        $data_syarat = $this->m_syarat->get_where_id_sub_modul($data->id_sub_modul);
        

        for($x = 0; $x < 2; $x++){ // untuk melakukan script ini 2 x (pada kasus ini ttb ada 2 halaman)

            // looping data ttb
            $num_rows = count($array_ttb);
            $template->cloneRow('field', $num_rows);
            $no = 1;
            for($i = 0; $i < $num_rows; $i++){
                $template->setValue("no#$no", $no);
                $template->setValue("field#$no", $array_ttb[$i]['field']);
                $template->setValue("value#$no", $array_ttb[$i]['value']);
                $no++;
            }

            // looping data syarat
            $num_rows = count($data_syarat);
            $template->cloneRow('nama_syarat', $num_rows);
            $no = 1;
            for($i = 0; $i < $num_rows; $i++){
                $template->setValue("nama_syarat#$no", $data_syarat[$i]->nama_syarat);
                $no++;
            }
        }

        /* -------------------------syarat----------------------------------- */
        
        $template->setValue("tanggal_daftar", convert_tanggal_jadi_string($data->tanggal_daftar));
        

        $template->save(APPPATH. '../saved/ttb_'.$data->no_daftar.'.docx');

        // echo '<pre>'.print_r($array_ttb, true).'</pre>';

        
        ?>

        <script>
            window.location = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>/simppadu/saved/ttb_<?php echo $data->no_daftar ?>.docx';
            setTimeout(function(){
                window.location = '<?php echo site_url("c_fo/tertunda") ?>';
            }, 3000);
        </script>
        <?php 
    }

    

    public function proses($no_daftar){
        $proses = $this->m_fo->set_status_proses($no_daftar, 2); // 0 : kirim ke verifikasi i
        if($proses){
            redirect('c_fo/tertunda');
        }
    }


    public function batal_daftar($no_daftar){
        $batal = $this->m_fo->set_status_proses($no_daftar, 0); // 0 : batal daftar
        if($batal){
            redirect('c_fo/tertunda');
        }
    }

    


    /*----------------------------------Methode untuk kepentingan ajax--------------------------------------*/

    // untuk memunculkan sub_modul berdasarkan pilihan modul
    public function get_where_id_modul($id_modul){
        $data = $this->m_sub_modul->get_where_id_modul($id_modul);
        foreach ($data as $result) {
            echo "<option value='".$result->id_sub_modul."'> ".$result->nama_sub_modul ."</option>";
        }
    }

}
