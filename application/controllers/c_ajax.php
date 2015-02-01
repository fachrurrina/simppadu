<?php

class C_ajax extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_kec');
		$this->load->model('m_kel');
		$this->load->model('m_tdp');
		$this->load->model('m_bentuk_perusahaan');
	}

	public function load_combo_kel($id_kec){

		$data['kec'] = $this->m_kec->get_all();
        $data['kel'] = $this->m_kec->get_all();

        $this->db->where('id_kec', $id_kec);
        $query = $this->db->get('t_kel');

        
        foreach ($query->result() as $result) {
            echo "<option value='".$result->id_kel."'> ".$result->nm_kel ."</option>";
        }
	}

	public function load_data_tdp_perpanjangan(){

		if($this->input->get('no_sk')){
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_tdp->get_where_no_sk($no_sk);

			if($data){
				
				?>
				<tr>
					<input type="hidden" name="tdp_perpanjangan_no_sk" id="tdp_perpanjangan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}

	public function load_data_tdp_perubahan(){

		if($this->input->get('no_sk')){
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_tdp->get_where_no_sk($no_sk);

			if($data){
				
				?>
				<tr>
					<input type="hidden" name="tdp_perubahan_no_sk" id="tdp_perubahan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}


	public function load_data_siup_perpanjangan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_siup->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="siup_perpanjangan_no_sk" id="siup_perpanjangan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}


	public function load_data_sipo_perpanjangan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_sipo->get_where_no_sk($no_sk);

			

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="sipo_perpanjangan_no_sk" id="sipo_perpanjangan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_optik; ?></td>					
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}

	public function load_data_siup_perubahan(){

		if($this->input->get('no_sk')){
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_siup->get_where_no_sk($no_sk);

			if($data){
				
				?>
				<tr>
					<input type="hidden" name="siup_perubahan_no_sk" id="siup_perubahan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}


	public function load_data_situ_perpanjangan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_situ->get_where_no_sk($no_sk);

			

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="situ_perpanjangan_no_sk" id="situ_perpanjangan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}

	public function load_data_situ_perubahan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_situ->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="situ_perubahan_no_sk" id="situ_perubahan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}


	public function load_data_tdi_perubahan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_tdi->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="tdi_perubahan_no_sk" id="tdi_perubahan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					
					
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}

	public function load_data_ho_perpanjangan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_ho->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="ho_perpanjangan_no_sk" id="ho_perpanjangan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_daftar_ulang; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}


	public function load_data_ho_perubahan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_ho->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="ho_perubahan_no_sk" id="ho_perubahan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_daftar_ulang; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}





	public function load_data_siujk_perpanjangan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_siujk->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="siujk_perpanjangan_no_sk" id="siujk_perpanjangan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}

	public function load_data_siujk_perubahan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_siujk->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="siujk_perubahan_no_sk" id="siujk_perubahan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}


	public function load_data_siuk_perpanjangan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_siuk->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="siuk_perpanjangan_no_sk" id="siuk_perpanjangan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}

	public function load_data_siuk_perubahan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_siuk->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="siuk_perubahan_no_sk" id="siuk_perubahan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_perusahaan; ?></td>
					<td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}



	public function load_data_sia_perpanjangan(){

		if($this->input->get('no_sk')){
			
			$no_sk = $this->input->get('no_sk');	
			$data  = $this->m_sia->get_where_no_sk($no_sk);

			
			if($data){
				
				?>
				<tr>
					<input type="hidden" name="sia_perpanjangan_no_sk" id="sia_perpanjangan_no_sk" value="<?php echo $data->no_sk; ?>">
					<td><?php echo $data->no_sk; ?></td>
					<td><?php echo $data->nama_apotek; ?></td>
					
					<td><?php echo $data->nama_pemilik; ?></td>
					<td><?php echo $data->tanggal_terbit; ?></td>
					<td><?php echo $data->tanggal_perpanjangan; ?></td>
				</tr>
				<?php
				
			}else{
				?>
					<tr>
						<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
					</tr>
				<?php
			}
		}else{
			?>
				<tr>
					<td colspan="7" style="text-align: center;">Tidak ditemukan.</td>
				</tr>
			<?php
		}
	}

	public function load_combo_sub_bidang_iup(){

		if($this->input->get('id_bidang_iup')){
			
			$id_bidang_iup = $this->input->get('id_bidang_iup');
			//echo $id_bidang_iup;	
			$data  = $this->m_bidang_iup->get_sub_bidang_where_id_bidang($id_bidang_iup);

			/*echo "<pre>";
			print_r($data);
			echo "</pre>";*/

			if($data){
				foreach($data as $r_data){
					?>
						<option biaya="<?php echo $r_data->biaya ?>" value="<?php echo $r_data->id_sub_bidang_iup ?>"><?php echo $r_data->nama_sub_bidang_iup ?></option>
					<?php
				}
			}

			
		}
	}



}




