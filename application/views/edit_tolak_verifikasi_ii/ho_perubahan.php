<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $edit->no_daftar; ?>"  type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-2"><input readonly="" value="<?php echo $edit->tanggal_daftar ?>" type="date" name="tanggal_daftar" id="tanggal_daftar" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $edit->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Surat Permohonan</label>
    <div class="col-sm-6"><input  value="<?php echo $edit->tanggal_permohonan ?>" type="date" name="tanggal_permohonan" id="tanggal_permohonan" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Direktur / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->nama_pemilik; ?>" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin Pemilik</label>
    <div class="col-sm-2" style="padding-top: 3px;">
            
        <label>
            <input  <?php echo ($edit->jenis_kelamin_pemilik == 1)? 'checked=""' : '' ?> type="radio" name="jenis_kelamin_pemilik" value="1" id="jenis_kelamin_pemilik"  /> 
            Laki-laki
        </label>

        <label>
            <input  <?php echo ($edit->jenis_kelamin_pemilik == 2)? 'checked=""' : '' ?> type="radio" name="jenis_kelamin_pemilik" value="0" id="jenis_kelamin_pemilik"  /> 
            Perempuan
        </label>
        
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan Pemilik</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->pekerjaan_pemilik ?>" type="text" class="form-control input-sm" name="pekerjaan_pemilik" id="pekerjaan_pemilik" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea  name="alamat_pemilik" id="alamat_pemilik" class="form-control input-sm"><?php echo $edit->alamat_pemilik; ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select  name="id_kec_pemilik" id="id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($edit->id_kec_pemilik == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_pemilik').change(function(){

            var id_kec_pemilik = $('#id_kec_pemilik').val();

            console.log(id_kec_pemilik);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_pemilik,
                success: function(data) {

                    $('#id_kel_pemilik').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong Pemilik</label>
    <div class="col-sm-4">
        <select  name="id_kel_pemilik" id="id_kel_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($edit->id_kel_pemilik == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<hr />



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->nama_perusahaan; ?>" type="text" class="form-control input-sm" name="nama_perusahaan" id="nama_perusahaan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select  class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
            <option></option>
            <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                <option <?php echo ($edit->id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : ''; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
    <div class="col-sm-7">
        <input  value="<?php echo $edit->nama_bidang_usaha ?>" type="text" class="form-control input-sm" name="nama_bidang_usaha" id="nama_bidang_usaha">
    </div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea  name="alamat_perusahaan" id="alamat_perusahaan" class="form-control input-sm"><?php echo $edit->alamat_perusahaan; ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-4">
        <select  name="id_kec_perusahaan" id="id_kec_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($edit->id_kec_perusahaan == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_perusahaan').change(function(){

            var id_kec_perusahaan = $('#id_kec_perusahaan').val();

            console.log(id_kec_perusahaan);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_perusahaan,
                success: function(data) {

                    $('#id_kel_perusahaan').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Perusahaan</label>
    <div class="col-sm-4">
        <select  name="id_kel_perusahaan" id="id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($edit->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal peninjauan lapangan</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $edit->tanggal_peninjauan_lapangan ?>" type="date" name="tanggal_peninjauan_lapangan" id="tanggal_peninjauan_lapangan" class="form-control input-sm"></div>
</div>


<div class="form-group">

    <label for="inputEmail3" class="col-sm-2 control-label">Luas Tempat Usaha (p x l)</label>
    <div class="col-sm-10">

        <table class="table" style="margin-bottom: 2px;" id="table-luas">
            <tbody>
                <?php  
                $array_ket_luas_tempat_usaha = explode('|', $edit->ket_luas_tempat_usaha);
                $array_panjang_tempat_usaha = explode('|', $edit->panjang_tempat_usaha);
                $array_lebar_tempat_usaha   = explode('|', $edit->lebar_tempat_usaha);
                
                for($i = 0; $i < count($array_panjang_tempat_usaha); $i++):
                ?>
                <tr>
                    <td><input readonly="" value="<?php echo $array_ket_luas_tempat_usaha[$i] ?>" type="text" class="ho_perpanjangan_ket_luas_tempat_usaha form-control input-sm" name="ho_perpanjangan_ket_luas_tempat_usaha[]" id="ho_perpanjangan_ket_luas_tempat_usaha[]" /></td>
                    <td><input readonly="" value="<?php echo $array_panjang_tempat_usaha[$i] ?>" type="number" class="ho_perpanjangan_panjang_tempat_usaha form-control input-sm" name="ho_perpanjangan_panjang_tempat_usaha[]" id="ho_perpanjangan_panjang_tempat_usaha[]" /></td>
                    <td><input readonly="" value="<?php echo $array_lebar_tempat_usaha[$i] ?>" type="number" class="ho_perpanjangan_lebar_tempat_usaha form-control input-sm" name="ho_perpanjangan_lebar_tempat_usaha[]" id="ho_perpanjangan_lebar_tempat_usaha[]" /></td>
                    
                </tr>
                <?php  
                endfor;
                ?>
            </tbody>
            <tfoot>
                
                <tr>
                    <td>Sub Total :</td>
                    <td><input readonly="" value="" type="number" class="form-control input-sm" name="ho_perpanjangan_panjang_tempat_usaha_total" id="ho_perpanjangan_panjang_tempat_usaha_total" /></td>
                    <td><input readonly="" value="" type="number" class="form-control input-sm" name="ho_perpanjangan_lebar_tempat_usaha_total" id="ho_perpanjangan_lebar_tempat_usaha_total" /></td>
                    
                </tr>
                <tr>
                    <td>Total Luas Tempat Usaha :</td>
                    <td></td>
                    <td><input readonly="" value="" type="number" class="form-control input-sm" name="ho_perpanjangan_luas_tempat_usaha" id="ho_perpanjangan_luas_tempat_usaha" /></td>
                    
                </tr>

                <tr>
                    <td>Nilai Index Luas Bangunan : </td>
                    <td></td>
                    <td><input readonly="" value="" type="number" class="form-control input-sm" name="ho_perpanjangan_nilai_index_luas" id="ho_perpanjangan_nilai_index_luas" /></td>
                    
                </tr>
                <input type="hidden" name="ho_perpanjangan_kode_index_luas" id="ho_perpanjangan_kode_index_luas">
            </tfoot>
        </table>
        

        
        
        <script>
        

        function isInt(value) {
            var x = parseFloat(value);
            return !isNaN(value) && (x | 0) === x;
        }

        function jumlahkan(){

            var sum_panjang = 0;
            $('.ho_perpanjangan_panjang_tempat_usaha').each(function(){
                if(isInt(this.value)){
                    sum_panjang += parseInt(this.value); 
                }else{
                    sum_panjang += 0;
                }
            });

            $('#ho_perpanjangan_panjang_tempat_usaha_total').val(sum_panjang);

            var sum_lebar = 0;
            $('.ho_perpanjangan_lebar_tempat_usaha').each(function(){
                if(isInt(this.value)){
                    sum_lebar += parseInt(this.value); 
                }else{
                    sum_lebar += 0;
                }
            });

            $('#ho_perpanjangan_lebar_tempat_usaha_total').val(sum_lebar);

            $('#ho_perpanjangan_luas_tempat_usaha').val(sum_panjang * sum_lebar);

            var ho_perpanjangan_luas_tempat_usaha = sum_panjang * sum_lebar;

            <?php $result = $this->db->get('t_index_luas')->result(); ?>

            <?php if($result): foreach($result as $r): ?>
                if(ho_perpanjangan_luas_tempat_usaha > <?php echo $r->minimal ?> && ho_perpanjangan_luas_tempat_usaha <= <?php echo $r->maximal ?>){
                    var ho_perpanjangan_nilai_index_luas = <?php echo $r->nilai_index_luas ?>;
                    var ho_perpanjangan_kode_index_luas = <?php echo $r->kode_index_luas ?>;
                }
            <?php endforeach; endif; ?>

            $('#ho_perpanjangan_nilai_index_luas').val(ho_perpanjangan_nilai_index_luas);
            $('#ho_perpanjangan_kode_index_luas').val(ho_perpanjangan_kode_index_luas);
            

                
        }

        $(document).ready(function(){
            jumlahkan();
        });
        
        </script>
        

        
    </div>
</div>

<?php if($edit->tinggi_tower > 0): ?>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Tinggi Tower</label>
        <div class="col-sm-4">
            <input readonly=""  value="<?php echo $edit->tinggi_tower ?>" type="number" class="form-control input-sm" name="ho_perpanjangan_tinggi_tower" id="ho_perpanjangan_tinggi_tower">
        </div>
    </div>
<?php endif; ?>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Gangguan</label>
    <div class="col-sm-4">
        
        <select readonly="" class="form-control input-sm" name="ho_perpanjangan_kode_index_gangguan" id="ho_perpanjangan_kode_index_gangguan">
            <option></option>
            <?php if($index_gangguan): foreach($index_gangguan as $r_index_gangguan): ?>
                <option <?php echo ($edit->kode_index_gangguan == $r_index_gangguan->kode_index_gangguan) ? 'selected=""' : '' ?> value="<?php echo $r_index_gangguan->kode_index_gangguan ?>" nilai_index_gangguan="<?php echo $r_index_gangguan->nilai_index_gangguan; ?>"><?php echo $r_index_gangguan->nama_index_gangguan ?></option>
            <?php endforeach; endif; ?>
        </select>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            
            var ho_perpanjangan_nilai_index_gangguan = $('#ho_perpanjangan_kode_index_gangguan > option:selected').attr('nilai_index_gangguan');
            console.log(ho_perpanjangan_nilai_index_gangguan);
            $('#ho_perpanjangan_nilai_index_gangguan').val(ho_perpanjangan_nilai_index_gangguan);
        })
    </script>

    <div class="col-sm-1">
        <input readonly="" type="text"  class="form-control input-sm" name="ho_perpanjangan_nilai_index_gangguan" id="ho_perpanjangan_nilai_index_gangguan">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Lokasi</label>
    <div class="col-sm-4">
        <select readonly="" class="form-control input-sm" name="ho_perpanjangan_kode_index_lokasi" id="ho_perpanjangan_kode_index_lokasi">
            <option></option>
            <?php if($index_lokasi): foreach($index_lokasi as $r_index_lokasi): ?>
                <option <?php echo ($edit->kode_index_lokasi == $r_index_lokasi->kode_index_lokasi) ? 'selected=""' : '' ?> value="<?php echo $r_index_lokasi->kode_index_lokasi ?>" nilai_index_lokasi="<?php echo $r_index_lokasi->nilai_index_lokasi ?>"><?php echo $r_index_lokasi->nama_index_lokasi ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            
            var ho_perpanjangan_nilai_index_lokasi = $('#ho_perpanjangan_kode_index_lokasi > option:selected').attr('nilai_index_lokasi');
            console.log(ho_perpanjangan_nilai_index_lokasi);
            $('#ho_perpanjangan_nilai_index_lokasi').val(ho_perpanjangan_nilai_index_lokasi);
        })
    </script>
    
    <div class="col-sm-1">
        <input readonly="" type="text"  class="form-control input-sm" name="ho_perpanjangan_nilai_index_lokasi" id="ho_perpanjangan_nilai_index_lokasi">
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Harga Dasar</label>
    <div class="col-sm-4">
        <select readonly="" class="form-control input-sm" name="ho_perpanjangan_kode_index_harga_dasar" id="ho_perpanjangan_kode_index_harga_dasar">
            <option></option>
            <?php if($index_harga_dasar): foreach($index_harga_dasar as $r_index_harga_dasar): ?>
                <option <?php echo ($edit->kode_index_harga_dasar == $r_index_harga_dasar->kode_index_harga_dasar) ? 'selected=""' : '' ?> value="<?php echo $r_index_harga_dasar->kode_index_harga_dasar ?>" nilai_index_harga_dasar="<?php echo $r_index_harga_dasar->nilai_index_harga_dasar ?>"><?php echo $r_index_harga_dasar->nama_index_harga_dasar ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            
            var ho_perpanjangan_nilai_index_harga_dasar = $('#ho_perpanjangan_kode_index_harga_dasar > option:selected').attr('nilai_index_harga_dasar');
            console.log(ho_perpanjangan_nilai_index_harga_dasar);
            $('#ho_perpanjangan_nilai_index_harga_dasar').val(ho_perpanjangan_nilai_index_harga_dasar);
        })
    </script>
    
    <div class="col-sm-1">
        <input readonly="" type="text"  class="form-control input-sm" name="ho_perpanjangan_nilai_index_harga_dasar" id="ho_perpanjangan_nilai_index_harga_dasar">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nilai Retribusi</label>
    

    <div class="col-sm-4">
        <input readonly="" value="<?php echo $edit->nilai_retribusi ?>" type="text" class="form-control input-sm" name="ho_perpanjangan_nilai_retribusi" class="ho_perpanjangan_nilai_retribusi" id="ho_perpanjangan_nilai_retribusi">
    </div>
</div>


<!-- element input hidden untuk data yang akan di simpan ke t_ho -->
<input value="<?php echo $edit->tinggi_tower ?>" type="hidden" name="tinggi_tower" id="tinggi_tower" >
<input value="<?php echo $edit->ket_luas_tempat_usaha ?>" type="hidden" name="ket_luas_tempat_usaha" id="ket_luas_tempat_usaha" >
<input value="<?php echo $edit->panjang_tempat_usaha ?>" type="hidden" name="panjang_tempat_usaha" id="panjang_tempat_usaha" >
<input value="<?php echo $edit->lebar_tempat_usaha ?>" type="hidden" name="lebar_tempat_usaha" id="lebar_tempat_usaha" >
<input value="<?php echo $edit->kode_index_luas ?>" type="hidden" name="kode_index_luas" id="kode_index_luas">
<input value="<?php echo $edit->kode_index_gangguan ?>" type="hidden" name="kode_index_gangguan" id="kode_index_gangguan">
<input value="<?php echo $edit->kode_index_lokasi ?>" type="hidden" name="kode_index_lokasi" id="kode_index_lokasi">
<input value="<?php echo $edit->kode_index_harga_dasar ?>" type="hidden" name="kode_index_harga_dasar" id="kode_index_harga_dasar">
<input value="<?php echo $edit->nilai_retribusi ?>" type="hidden" name="nilai_retribusi" id="nilai_retribusi">
<!-- ########################################################### -->




<hr>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">NPWPD / NPWRD</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->npwpd_npwrd ?>" type="text" class="form-control input-sm" name="npwpd_npwrd" id="npwpd_npwrd" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Status Kepemilikan Tanah</label>
    <div class="col-sm-3">
        <select  class="form-control input-sm" name="status_kepemilikan_tanah" id="status_kepemilikan_tanah">
            <option <?php echo ($edit->status_kepemilikan_tanah == "Hak Milik") ? 'selected=""' : '' ?> value="Hak Pakai">Hak Milik</option>
            <option <?php echo ($edit->status_kepemilikan_tanah == "Hak Pakai") ? 'selected=""' : '' ?> value="Hak Pakai">Hak Pakai</option>
            <option <?php echo ($edit->status_kepemilikan_tanah == "Sewa") ? 'selected=""' : '' ?> value="Hak Pakai">Sewa</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Utara</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->batas_utara ?>" type="text" class="form-control input-sm" name="batas_utara" id="batas_utara" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Selatan</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->batas_selatan ?>" type="text" class="form-control input-sm" name="batas_selatan" id="batas_selatan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Barat</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->batas_barat ?>" type="text" class="form-control input-sm" name="batas_barat" id="batas_barat" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Timur</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->batas_timur ?>" type="text" class="form-control input-sm" name="batas_timur" id="batas_timur" />
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Mesin Penggerak</label>
    <div class="col-sm-6">
        <input  value="<?php echo $edit->mesin_penggerak ?>" type="text" class="form-control input-sm" name="mesin_penggerak" id="mesin_penggerak" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bahan Bakar Mesin Penggerak</label>
    <div class="col-sm-3">
        <select  class="form-control input-sm" name="bahan_bakar" id="bahan_bakar">
            <option <?php echo ($edit->bahan_bakar == "Bensin") ? 'selected=""' : ''  ?> value="Bensin">Bensin</option>
            <option <?php echo ($edit->bahan_bakar == "Solar") ? 'selected=""' : ''  ?> value="Solar">Solar</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pembangkit Listrik</label>
    <div class="col-sm-6">
        <input  value="<?php echo $edit->pembangkit_listrik ?>" type="text" class="form-control input-sm" name="pembangkit_listrik" id="pembangkit_listrik" />
    </div>
</div>

<hr />

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Surat Keterangan Usaha</label>
    <div class="col-sm-4">
        <input  value="<?php echo $edit->no_surat_ket_usaha ?>" type="text" class="form-control input-sm" name="no_surat_ket_usaha" id="no_surat_ket_usaha" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Surat Keterangan Usaha</label>
    <div class="col-sm-4"><input  value="<?php echo $edit->tanggal_surat_ket_usaha ?>" type="date" name="tanggal_surat_ket_usaha" id="tanggal_surat_ket_usaha" class="form-control input-sm"></div>
</div>



<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Surat Pernyataan Lingkungan</label>
    <div class="col-sm-4"><input value="<?php echo $edit->tanggal_surat_pernyataan_lingkungan ?>" type="date" name="tanggal_surat_pernyataan_lingkungan" id="tanggal_surat_pernyataan_lingkungan" class="form-control input-sm"></div>
</div>

<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $edit->tanggal_terbit ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal daftar ulang</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $edit->tanggal_daftar_ulang ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $edit->tanggal_perpanjangan ?>" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
</div>
