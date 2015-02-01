<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $penetapan->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $penetapan->tanggal_daftar ; ?>" readonly="" type="date" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>



<hr>





<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-5">
        <input value="<?php echo $penetapan->imb_baru_nama_pemilik ?>" type="text" class="form-control input-sm" name="imb_baru_nama_pemilik" id="imb_baru_nama_pemilik" />
    </div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea name="imb_baru_alamat_pemilik" id="imb_baru_alamat_pemilik" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select name="imb_baru_id_kec_pemilik" id="imb_baru_id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option  value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#imb_baru_id_kec_pemilik').change(function(){

            var imb_baru_id_kec_pemilik = $('#imb_baru_id_kec_pemilik').val();

            console.log(imb_baru_id_kec_pemilik);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + imb_baru_id_kec_pemilik,
                success: function(data) {

                    $('#imb_baru_id_kel_pemilik').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong Pemilik</label>
    <div class="col-sm-4">
        <select name="imb_baru_id_kel_pemilik" id="imb_baru_id_kel_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option  value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<hr />


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Bangunan</label>
    <div class="col-sm-6"><textarea name="imb_baru_alamat_bangunan" id="imb_baru_alamat_bangunan" class="form-control input-sm"><?php echo $penetapan->imb_baru_alamat_bangunan ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Bangunan</label>
    <div class="col-sm-4">
        <select name="imb_baru_id_kec_bangunan" id="imb_baru_id_kec_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($penetapan->imb_baru_id_kec_bangunan == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#imb_baru_id_kec_bangunan').change(function(){

            var imb_baru_id_kec_bangunan = $('#imb_baru_id_kec_bangunan').val();

            console.log(imb_baru_id_kec_bangunan);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + imb_baru_id_kec_bangunan,
                success: function(data) {

                    $('#imb_baru_id_kel_bangunan').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong Bangunan</label>
    <div class="col-sm-4">
        <select name="imb_baru_id_kel_bangunan" id="imb_baru_id_kel_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($penetapan->imb_baru_id_kel_bangunan == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Bangunan</label>
    <div class="col-sm-4">
        <select name="imb_baru_id_jenis_bangunan" id="imb_baru_id_jenis_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php if($jenis_bangunan): foreach($jenis_bangunan as $r_jenis_bangunan): ?>
                <option value="<?php echo $r_jenis_bangunan->id_jenis_bangunan ?>"><?php echo $r_jenis_bangunan->nama_jenis_bangunan ?></option>
            <?php endforeach; endif; ?>
        </select>
        
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kepemilikan Tanah</label>
    <div class="col-sm-4">
        <select name="imb_baru_id_hak_kepemilikan" id="imb_baru_id_hak_kepemilikan" class="form-control input-sm">
            <option value=""></option>
            <?php if($kepemilikan_tanah): foreach($kepemilikan_tanah as $r_kepemilikan_tanah): ?>
                <option value="<?php echo $r_kepemilikan_tanah->id_hak_kepemilikan ?>"><?php echo $r_kepemilikan_tanah->nama_hak_kepemilikan ?></option>
            <?php endforeach; endif; ?>
        </select>
        
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Luas Bangunan (M<sup>2</sup>)</label>
    <div class="col-sm-4">
        <input type="number" step="any" class="form-control input-sm" name="imb_baru_luas_bangunan" id="imb_baru_luas_bangunan" value="0">
        
    </div>
    <script type="text/javascript">
        $('#imb_baru_luas_bangunan').change(function(){
            var imb_baru_luas_bangunan = $(this).val();

            <?php if($koif_luas): foreach($koif_luas as $r_koif_luas): ?> 
                if(imb_baru_luas_bangunan >= <?php echo $r_koif_luas->luas_min ?> && imb_baru_luas_bangunan <= <?php echo $r_koif_luas->luas_max ?>){ 
                    var imb_baru_id_koif_luas = <?php echo $r_koif_luas->id_koif_luas ?>; 
                    var imb_baru_nilai_koif_luas = <?php printf('%.2f', $r_koif_luas->nilai_koif_luas) ?>.toFixed(2);
                    console.log(imb_baru_luas_bangunan + ' : ' + imb_baru_id_koif_luas + ' : ' + imb_baru_nilai_koif_luas);
                }
            <?php endforeach; endif; ?>
            
            
            $('#imb_baru_id_koif_luas').val(imb_baru_id_koif_luas);
            $('#imb_baru_nilai_koif_luas').val(imb_baru_nilai_koif_luas);
        });
    </script>
    <div class="col-sm-1">
        <input type="hidden" class="form-control input-sm" name="imb_baru_id_koif_luas" id="imb_baru_id_koif_luas">
        <input type="text" readonly="" class="form-control input-sm" name="imb_baru_nilai_koif_luas" id="imb_baru_nilai_koif_luas">
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Koifisien Tingkat Bangunan</label>
    <div class="col-sm-4">
        
        <select class="form-control input-sm" name="imb_baru_id_koif_tingkat" id="imb_baru_id_koif_tingkat">
            <option></option>

            <?php if($koif_tingkat): foreach($koif_tingkat as $r_koif_tingkat): ?>
                <option value="<?php echo $r_koif_tingkat->id_koif_tingkat ?>" nilai_koif_tingkat="<?php echo $r_koif_tingkat->nilai_koif_tingkat; ?>"><?php echo $r_koif_tingkat->nama_koif_tingkat ?></option>
            <?php endforeach; endif; ?>
        </select>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#imb_baru_id_koif_tingkat').change(function(){
                var imb_baru_nilai_koif_tingkat = $('#imb_baru_id_koif_tingkat > option:selected').attr('nilai_koif_tingkat');
                console.log(imb_baru_nilai_koif_tingkat);
                $('#imb_baru_nilai_koif_tingkat').val(imb_baru_nilai_koif_tingkat);
            });
        })
    </script>

    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="imb_baru_nilai_koif_tingkat" id="imb_baru_nilai_koif_tingkat">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Koifisien Guna Bangunan</label>
    <div class="col-sm-4">
        <select class="form-control input-sm" name="imb_baru_id_koif_guna" id="imb_baru_id_koif_guna">
            <option></option>
            <?php if($koif_guna): foreach($koif_guna as $r_koif_guna): ?>
                <option value="<?php echo $r_koif_guna->id_koif_guna ?>" nilai_koif_guna="<?php echo $r_koif_guna->nilai_koif_guna ?>"><?php echo $r_koif_guna->nama_koif_guna ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#imb_baru_id_koif_guna').change(function(){
                var imb_baru_nilai_koif_guna = $('#imb_baru_id_koif_guna > option:selected').attr('nilai_koif_guna');
                console.log(imb_baru_nilai_koif_guna);
                $('#imb_baru_nilai_koif_guna').val(imb_baru_nilai_koif_guna);
            });
        })
    </script>
    
    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="imb_baru_nilai_koif_guna" id="imb_baru_nilai_koif_guna">
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Harga Dasar Bangunan</label>
    <div class="col-sm-4">
        <select class="form-control input-sm" name="imb_baru_id_harga_dasar" id="imb_baru_id_harga_dasar">
            <option></option>
            <?php if($harga_dasar_bangunan): foreach($harga_dasar_bangunan as $r_harga_dasar_bangunan): ?>
                <option value="<?php echo $r_harga_dasar_bangunan->id_harga_dasar ?>" nilai_harga_dasar="<?php echo $r_harga_dasar_bangunan->nilai_harga_dasar ?>"><?php echo $r_harga_dasar_bangunan->jenis_bangunan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#imb_baru_id_harga_dasar').change(function(){
                var imb_baru_nilai_harga_dasar = $('#imb_baru_id_harga_dasar > option:selected').attr('nilai_harga_dasar');
                console.log(imb_baru_nilai_harga_dasar);
                $('#imb_baru_nilai_harga_dasar').val(imb_baru_nilai_harga_dasar);
            });
        })
    </script>
    
    <div class="col-sm-3">
        <input type="text" readonly="" class="form-control input-sm" name="imb_baru_nilai_harga_dasar" id="imb_baru_nilai_harga_dasar">
    </div>
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-1">
        <a class="btn btn-primary btn-xs" id="hitung" value="hitung" name="hitung">Hitung</a>
    </div>

    <script type="text/javascript">
            $(document).ready(function(){
                $('#hitung').click(function(){
                    var imb_baru_nilai_koif_luas    = $('#imb_baru_nilai_koif_luas').val();
                    var imb_baru_nilai_koif_tingkat = $('#imb_baru_nilai_koif_tingkat').val();
                    var imb_baru_nilai_koif_guna    = $('#imb_baru_nilai_koif_guna').val();
                    var imb_baru_nilai_harga_dasar  = $('#imb_baru_nilai_harga_dasar').val();

                    console.log(imb_baru_nilai_koif_luas);
                    console.log(imb_baru_nilai_koif_tingkat);
                    console.log(imb_baru_nilai_koif_guna);
                    console.log(imb_baru_nilai_harga_dasar);

                    if(imb_baru_nilai_koif_luas == '' || imb_baru_nilai_koif_tingkat == '' || imb_baru_nilai_koif_guna == '' || imb_baru_nilai_harga_dasar == ''){
                        alert('Anda belum melengkapi kriteria Perhitungan Penetepan');
                    }else{
                        var nilai_retribusi         = imb_baru_nilai_koif_luas * imb_baru_nilai_koif_tingkat * imb_baru_nilai_koif_guna * imb_baru_nilai_harga_dasar;
                        $('#imb_baru_nilai_retribusi').val(nilai_retribusi);
                        console.log(nilai_retribusi);
                    }
                    /**
                     * input#nilai_retribusi 
                     * berada pada file : v_penetapan_utama.php
                     */
                });
            });
        </script>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nilai Retribusi</label>
    

    <div class="col-sm-4">
        <input type="text" class="form-control input-sm" name="imb_baru_nilai_retribusi" class="imb_baru_nilai_retribusi" id="imb_baru_nilai_retribusi">
    </div>
</div>
                    
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Peninjauan Lapangan</label>
    <div class="col-sm-3">
        <input value="" type="date" class="form-control input-sm" name="imb_baru_tanggal_peninjauan_lapangan" id="imb_baru_tanggal_peninjauan_lapangan" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        
        <input type="submit" class="btn btn-primary btn-xs" value="tetapkan" name="tetapkan">

        <script type="text/javascript">
            $("#tetapkan").click(function(event){
                var imb_baru_nilai_retribusi      = $('#imb_baru_nilai_retribusi').val();
                
                if(imb_baru_nilai_retribusi){
                    event.preventDefault(); // cancel default behavior
                    alert('Anda belum melengkapi kriteria Perhitungan Penetepan');
                    
                }
                
              });
        </script>
    </div>
</div>
                    

<script type="text/javascript">
   $(document).ready(function(){
        $('#containerForm').bootstrapValidator({
            container: 'tooltip',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'imb_baru_tanggal_peninjauan_lapangan': {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Peninjauan Lapangan harus diisi'
                        }
                    }
                },
                'imb_baru_id_kec_pemilik': {
                    validators: {
                        notEmpty: {
                            message: 'Kecamatan Pemilik harus dipilih'
                        }
                    }
                },
                'imb_baru_id_kel_pemilik': {
                    validators: {
                        notEmpty: {
                            message: 'Gampong Pemilik harus dipilih'
                        }
                    }
                },
                'imb_baru_nama_bidang_usaha': {
                    validators: {
                        notEmpty: {
                            message: 'Nama Bidang Usaha harus diisi'
                        }
                    }
                },
                'imb_baru_ket_luas_tempat_usaha[]': {
                    validators: {
                        notEmpty: {
                            message: 'Keterangan Luas Tempat Usaha Tidak Boleh Kosong'
                        }
                    }
                },
                'imb_baru_panjang_tempat_usaha[]': {
                    validators: {
                        notEmpty: {
                            message: 'Tidak Boleh Kosong'
                        },
                        greaterThan: {
                            inclusive: false,
                            value: 0,
                            message: 'Tidak Boleh 0 (Nol)'
                        }
                    }
                },
                'imb_baru_lebar_tempat_usaha[]': {
                    validators: {
                        notEmpty: {
                            message: 'Tidak Boleh Kosong'
                        },
                        greaterThan: {
                            inclusive: false,
                            value: 0,
                            message: 'Tidak Boleh 0 (Nol)'
                        }
                    }
                },
                'imb_baru_kode_index_gangguan': {
                    validators: {
                        notEmpty: {
                            message: 'harus dipilih'
                        }
                    }
                },
                'imb_baru_kode_index_lokasi': {
                    validators: {
                        notEmpty: {
                            message: 'harus dipilih'
                        }
                    }
                },
                'imb_baru_kode_index_harga_dasar': {
                    validators: {
                        notEmpty: {
                            message: 'harus dipilih'
                        }
                    }
                }


                
                
            }
        });
    });
</script>
