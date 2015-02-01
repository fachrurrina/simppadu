


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $fo->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-2"><input readonly="" value="<?php echo $fo->tanggal_daftar ?>" type="date" name="tanggal_daftar" id="tanggal_daftar" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Lalu</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $data_lalu->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk_lalu" id="no_sk_lalu" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $data_baru->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
        <p class="help-block">Jika Menurut Operator No SK baru salah, kembalikan berkas ke Pengagendaan untuk di batalkan dan di perbaiki</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Direktur / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input value="<?php echo $data_lalu->nama_pemilik; ?>" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nomor NPWPD/NPWRD</label>
    <div class="col-sm-3">
        <input value="<?php echo $data_lalu->npwpd_npwrd ?>" type="text" class="form-control input-sm" name="npwpd_npwrd" id="npwpd_npwrd" />
    </div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea name="alamat_pemilik" id="alamat_pemilik" class="form-control input-sm"><?php echo $data_lalu->alamat_pemilik ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select name="id_kec_pemilik" id="id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($data_lalu->id_kec_pemilik == $r_kec->id_kec) ? 'selected=""' : '';  ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
        <select name="id_kel_pemilik" id="id_kel_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($data_lalu->id_kel_pemilik == $r_kel->id_kel) ? 'selected=""' : '';  ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-6">
        <input value="<?php echo $data_lalu->nama_perusahaan; ?>" type="text" class="form-control input-sm" name="nama_perusahaan" id="nama_perusahaan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
            <option></option>
            <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                <option <?php echo ($data_lalu->id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : ''; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>


 
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control input-sm"><?php echo $data_lalu->alamat_perusahaan ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-4">
        <select name="id_kec_perusahaan" id="id_kec_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($data_lalu->id_kec_perusahaan == $r_kec->id_kec) ? 'selected=""' : '' ; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
        <select name="id_kel_perusahaan" id="id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($data_lalu->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : '' ; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
    <div class="col-sm-3">
        <input value="<?php echo $data_lalu->no_telp; ?>" type="text" class="form-control input-sm" name="no_telp" id="no_telp" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Luas Tempat Usaha (Panjang x lebar = Luas M<sup>2</sup>)</label>
    <div class="col-sm-2">
        <input value="<?php echo $data_lalu->panjang_tempat_usaha ?>" type="number" class="form-control input-sm" name="panjang_tempat_usaha" id="panjang_tempat_usaha" />
    </div>
    <label for="inputEmail3" class="col-sm-1 control-label" style="text-align: center;">x</label>
    <div class="col-sm-2">
        <input value="<?php echo $data_lalu->lebar_tempat_usaha ?>" type="number" class="form-control input-sm" name="lebar_tempat_usaha" id="lebar_tempat_usaha" />
    </div>
    <label for="inputEmail3" class="col-sm-2 control-label" style="text-align: center;">=</label>

    

    <script>
        $('#panjang_tempat_usaha').change(function(){
            var panjang_tempat_usaha = $(this).val();
            var lebar_tempat_usaha = $('#lebar_tempat_usaha').val();
            $('#luas_tempat_usaha').val(panjang_tempat_usaha * lebar_tempat_usaha);
        });

        $('#lebar_tempat_usaha').change(function(){
            var lebar_tempat_usaha = $(this).val();
            var panjang_tempat_usaha = $('#panjang_tempat_usaha').val();
            $('#luas_tempat_usaha').val(panjang_tempat_usaha * lebar_tempat_usaha);
        });
    </script>

    <div class="col-sm-2">
        <input value="<?php echo ($data_lalu->panjang_tempat_usaha * $data_lalu->lebar_tempat_usaha) ?>" type="number" class="form-control input-sm" name="luas_tempat_usaha" id="luas_tempat_usaha" />
    </div>

</div>




<div class="form-group" style="margin-bottom: 0">
    <label for="inputEmail3" class="col-sm-2 control-label">Untuk Membuka / Meneruskan Usaha</label>
    <div class="col-sm-1" style="text-align: right">
        <label>
            <input <?php echo ($this->m_bidang_situ->nama_bidang_situ_exist($data_lalu->nama_bidang_situ) == true) ? 'checked=""' : '' ?> type="radio" name="metode_input_bidang_situ" value="pilihan" class="metode_input_bidang_situ" /> Pilihan
        </label>
    </div>

    <div class="col-sm-1" style="text-align: right">
        <label>
            <input <?php echo ($this->m_bidang_situ->nama_bidang_situ_exist($data_lalu->nama_bidang_situ) == false) ? 'checked=""' : '' ?> type="radio" name="metode_input_bidang_situ" value="manual" class="metode_input_bidang_situ" /> Manual
        </label>
    </div>

    <div class="col-sm-4">

        <!-- pilihan combo -->
        <select class="form-control input-sm" id="nama_bidang_situ_pilihan">
            <option value=""></option>
            <?php if($bidang_situ): foreach($bidang_situ as $r_bidang_situ): ?>
                <option 
                    <?php 
                        if($this->m_bidang_situ->nama_bidang_situ_exist($data_lalu->nama_bidang_situ) == true){
                            echo ($data_lalu->nama_bidang_situ == $r_bidang_situ->nama_bidang_situ) ? 'selected=""': '';
                        }
                    ?> 
                value="<?php echo $r_bidang_situ->nama_bidang_situ ?>"><?php echo $r_bidang_situ->nama_bidang_situ ?></option>
            <?php endforeach; endif; ?>
        </select>
        
        <!-- pilihan text manual -->
        <input value="<?php if($this->m_bidang_situ->nama_bidang_situ_exist($data_lalu->nama_bidang_situ) == false){ echo $data_lalu->nama_bidang_situ; } ?>" type="text" class="form-control input-sm" id="nama_bidang_situ_manual" />
    </div>

    <div class="col-sm-4" id="nama_bidang_situ_manual">
        
    </div>
</div>

<script>
    
    // script untuk mengganti metode inputan bidang usaha situ (combobox atau textbox manual)
    $(document).ready(function(){

        <?php if($this->m_bidang_situ->nama_bidang_situ_exist($data_lalu->nama_bidang_situ) == true): ?>
            
            $('#nama_bidang_situ_pilihan').attr('name', 'nama_bidang_situ').show();
            $('#nama_bidang_situ_manual').hide();
        <?php else: ?>
            $('#nama_bidang_situ_pilihan').hide();
            $('#nama_bidang_situ_manual').attr('name', 'nama_bidang_situ').show();
        <?php endif; ?>

        $('.metode_input_bidang_situ').click(function(){
            var val_metode_input_bidang_situ = $(this).val();
            console.log(val_metode_input_bidang_situ);

            if(val_metode_input_bidang_situ === 'manual'){
                $('#nama_bidang_situ_manual').attr('name', 'nama_bidang_situ').show();
                $('#nama_bidang_situ_pilihan').removeAttr('name').hide();
            }

            if(val_metode_input_bidang_situ === 'pilihan'){
                $('#nama_bidang_situ_manual').removeAttr('name').hide();
                $('#nama_bidang_situ_pilihan').attr('name', 'nama_bidang_situ').show();
            }
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Klasifikasi</label>
    <div class="col-sm-3">
        <input value="<?php echo $data_lalu->klasifikasi; ?>" type="text" class="form-control input-sm" name="klasifikasi" id="klasifikasi" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-6"><input value="<?php echo $data_baru->tanggal_terbit ?>" readonly="" type="date" name="tanggal_terbit" id="tanggal_terbit" value="" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-6">
        <input value="<?php echo $data_baru->tanggal_perpanjangan ?>" readonly="" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" value="" class="form-control input-sm">
        <p class="help-block">Jika Menurut Operator Tanggal Terbit dan Tanggal Perpanjangan salah, kembalikan berkas ke Pengagendaan untuk di batalkan dan di perbaiki</p>
    </div>

</div>

