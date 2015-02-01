<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->tanggal_daftar ; ?>" readonly="" type="date" class="form-control input-sm" name="tanggal_daftar" id="tanggal_daftar" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<hr>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-5">
        <input readonly="" value="<?php echo $verifikasi->nama_pemilik ?>" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
    </div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea  readonly="" name="alamat_pemilik" id="alamat_pemilik" class="form-control input-sm"><?php echo $verifikasi->alamat_pemilik ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kec_pemilik" id="id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->id_kec_pemilik == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
        <select readonly="" name="id_kel_pemilik" id="id_kel_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($verifikasi->id_kel_pemilik == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<hr />


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Bangunan</label>
    <div class="col-sm-6"><textarea readonly="" name="alamat_bangunan" id="alamat_bangunan" class="form-control input-sm"><?php echo $verifikasi->alamat_bangunan ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Bangunan</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kec_bangunan" id="id_kec_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->id_kec_bangunan == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_bangunan').change(function(){

            var id_kec_bangunan = $('#id_kec_bangunan').val();

            console.log(id_kec_bangunan);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_bangunan,
                success: function(data) {

                    $('#id_kel_bangunan').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong Bangunan</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kel_bangunan" id="id_kel_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($verifikasi->id_kel_bangunan == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Bangunan</label>
    <div class="col-sm-4">
        <select readonly="" name="id_jenis_bangunan" id="id_jenis_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php if($jenis_bangunan): foreach($jenis_bangunan as $r_jenis_bangunan): ?>
                <option <?php echo ($verifikasi->id_jenis_bangunan == $r_jenis_bangunan->id_jenis_bangunan) ? 'selected=""' : '' ?> value="<?php echo $r_jenis_bangunan->id_jenis_bangunan ?>"><?php echo $r_jenis_bangunan->nama_jenis_bangunan ?></option>
            <?php endforeach; endif; ?>
        </select>
        
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kepemilikan Tanah</label>
    <div class="col-sm-4">
        <select readonly="" name="id_hak_kepemilikan" id="id_hak_kepemilikan" class="form-control input-sm">
            <option value=""></option>
            <?php if($kepemilikan_tanah): foreach($kepemilikan_tanah as $r_kepemilikan_tanah): ?>
                <option <?php echo ($verifikasi->id_hak_kepemilikan == $r_kepemilikan_tanah->id_hak_kepemilikan) ? 'selected=""' : '' ?> value="<?php echo $r_kepemilikan_tanah->id_hak_kepemilikan ?>"><?php echo $r_kepemilikan_tanah->nama_hak_kepemilikan ?></option>
            <?php endforeach; endif; ?>
        </select>
        
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Luas Bangunan (M<sup>2</sup>)</label>
    <div class="col-sm-4">
        <input readonly="" type="number" step="any" class="form-control input-sm" name="luas_bangunan" id="luas_bangunan" value="<?php echo $verifikasi->luas_bangunan ?>">
        
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            

            var luas_bangunan = $(this).val();

            <?php if($koif_luas): foreach($koif_luas as $r_koif_luas): ?> 
                if(luas_bangunan >= <?php echo $r_koif_luas->luas_min ?> && luas_bangunan <= <?php echo $r_koif_luas->luas_max ?>){ 
                    var id_koif_luas = <?php echo $r_koif_luas->id_koif_luas ?>; 
                    var nilai_koif_luas = <?php printf('%.2f', $r_koif_luas->nilai_koif_luas) ?>.toFixed(2);
                    console.log(luas_bangunan + ' : ' + id_koif_luas + ' : ' + nilai_koif_luas);
                }
            <?php endforeach; endif; ?>
            
            
            $('#id_koif_luas').val(id_koif_luas);
            $('#nilai_koif_luas').val(nilai_koif_luas);
        });
    </script>
    <div class="col-sm-1">
        <input type="hidden" class="form-control input-sm" name="id_koif_luas" id="id_koif_luas">
        <input type="text" readonly="" class="form-control input-sm" name="nilai_koif_luas" id="nilai_koif_luas">
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Koifisien Tingkat Bangunan</label>
    <div class="col-sm-4">
        
        <select readonly="" class="form-control input-sm" name="id_koif_tingkat" id="id_koif_tingkat">
            <option></option>

            <?php if($koif_tingkat): foreach($koif_tingkat as $r_koif_tingkat): ?>
                <option <?php echo ($verifikasi->id_koif_tingkat == $r_koif_tingkat->id_koif_tingkat) ? 'selected=""' : '' ?> value="<?php echo $r_koif_tingkat->id_koif_tingkat ?>" nilai_koif_tingkat="<?php echo $r_koif_tingkat->nilai_koif_tingkat; ?>"><?php echo $r_koif_tingkat->nama_koif_tingkat ?></option>
            <?php endforeach; endif; ?>
        </select>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
           

            var nilai_koif_tingkat = $('#id_koif_tingkat > option:selected').attr('nilai_koif_tingkat');
            console.log(nilai_koif_tingkat);
            $('#nilai_koif_tingkat').val(nilai_koif_tingkat);
        })
    </script>

    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="nilai_koif_tingkat" id="nilai_koif_tingkat">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Koifisien Guna Bangunan</label>
    <div class="col-sm-4">
        <select readonly="" class="form-control input-sm" name="id_koif_guna" id="id_koif_guna">
            <option></option>
            <?php if($koif_guna): foreach($koif_guna as $r_koif_guna): ?>
                <option <?php echo ($verifikasi->id_koif_guna == $r_koif_guna->id_koif_guna) ? 'selected=""' : '' ?> value="<?php echo $r_koif_guna->id_koif_guna ?>" nilai_koif_guna="<?php echo $r_koif_guna->nilai_koif_guna ?>"><?php echo $r_koif_guna->nama_koif_guna ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
           
            var nilai_koif_guna = $('#id_koif_guna > option:selected').attr('nilai_koif_guna');
            console.log(nilai_koif_guna);
            $('#nilai_koif_guna').val(nilai_koif_guna);
        })
    </script>
    
    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="nilai_koif_guna" id="nilai_koif_guna">
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Harga Dasar Bangunan</label>
    <div class="col-sm-4">
        <select readonly="" class="form-control input-sm" name="id_harga_dasar" id="id_harga_dasar">
            <option></option>
            <?php if($harga_dasar_bangunan): foreach($harga_dasar_bangunan as $r_harga_dasar_bangunan): ?>
                <option <?php echo ($verifikasi->id_harga_dasar == $r_harga_dasar_bangunan->id_harga_dasar) ? 'selected=""' : '' ?> value="<?php echo $r_harga_dasar_bangunan->id_harga_dasar ?>" nilai_harga_dasar="<?php echo $r_harga_dasar_bangunan->nilai_harga_dasar ?>"><?php echo $r_harga_dasar_bangunan->jenis_bangunan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            

            var nilai_harga_dasar = $('#id_harga_dasar > option:selected').attr('nilai_harga_dasar');
            console.log(nilai_harga_dasar);
            $('#nilai_harga_dasar').val(nilai_harga_dasar);
        })
    </script>
    
    <div class="col-sm-3">
        <input type="text" readonly="" class="form-control input-sm" name="nilai_harga_dasar" id="nilai_harga_dasar">
    </div>
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nilai Retribusi</label>
    
    <div class="col-sm-4">
        <input readonly="" value="<?php echo $verifikasi->nilai_retribusi ?>" type="text" class="form-control input-sm" name="nilai_retribusi" class="nilai_retribusi" id="nilai_retribusi">
    </div>
</div>

                    
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Peninjauan Lapangan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->tanggal_peninjauan_lapangan ?>" type="date" class="form-control input-sm" name="tanggal_peninjauan_lapangan" id="tanggal_peninjauan_lapangan" />
    </div>
</div>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Sertifikat Tanah</label>
    <div class="col-sm-6"><input readonly="" placeholder="Isikan No Sertifikat Tanah" value="<?php echo $verifikasi->no_sertifikat_tanah ?>" type="text" name="no_sertifikat_tanah" id="no_sertifikat_tanah" class="form-control input-sm"></div>
</div>


<hr />




<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-3"><input readonly="" value="<?php echo $verifikasi->tanggal_terbit ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>

