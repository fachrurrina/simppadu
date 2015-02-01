<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $fo->no_daftar; ?>" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-2"><input readonly="" value="<?php echo $fo->tanggal_daftar ?>" type="date" name="tanggal_daftar" id="tanggal_daftar" class="form-control input-sm"></div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Lalu</label>
    <div class="col-sm-5">
        <input readonly="" value="<?php echo $data_baru->no_sk_lalu; ?>" type="text" class="form-control input-sm" name="no_sk_lalu" id="no_sk_lalu" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-5">
        <input readonly="" value="<?php echo $data_baru->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> value="<?php echo $data_baru->nama_perusahaan; ?>" type="text" class="form-control input-sm" name="nama_perusahaan" id="nama_perusahaan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
        <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
            <option <?php echo ($data_baru->id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : '' ; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
        <?php endforeach; endif; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Status Perusahaan</label>
    <div class="col-sm-3">
        <select <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> class="form-control input-sm" name="status_perusahaan" id="status_perusahaan" >
            <option <?php echo ($data_baru->status_perusahaan == "Kantor Pusat") ? 'selected=""' : '' ; ?> value="Kantor Pusat">Kantor Pusat</option>
            <option <?php echo ($data_baru->status_perusahaan == "Kantor Cabang") ? 'selected=""' : '' ; ?> value="Kantor Cabang">Kantor Cabang</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-6"><input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> value="<?php echo $data_baru->nama_pemilik ?>" type="text" name="nama_pemilik" id="nama_pemilik" value="<?php echo $data_baru->nama_pemilik ?>" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">No KTP Penanggung Jawab</label>
    <div class="col-sm-6"><input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> value="<?php echo $data_baru->no_ktp_pemilik ?>" type="text" name="no_ktp_pemilik" id="no_ktp_pemilik"  class="form-control input-sm"></div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6">
        <textarea <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> name="alamat_perusahaan" id="alamat_perusahaan" cols="30" rows="2" class="form-control input-sm"><?php echo $data_baru->alamat_perusahaan; ?></textarea>
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-3">
        <select <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> class="form-control input-sm" name="id_kec_perusahaan" id="id_kec_perusahaan">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($data_baru->id_kec_perusahaan == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo trim($r_kec->nm_kec); ?></option>
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
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong / Kelurahan Perusahaan</label>
    <div class="col-sm-4">
        <select <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> name="id_kel_perusahaan" id="id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($data_baru->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo trim($r_kel->nm_kel); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nilai Investasi / Modal Perusahaan (Rp.)</label>
    <div class="col-sm-3"><input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo 'readonly=""'; } ?> value="<?php echo $data_baru->nilai_investasi ?>" type="number" step="50000" name="nilai_investasi" id="nilai_investasi"  class="form-control input-sm"></div>
    <script type="text/javascript">
        $('#nilai_investasi').change(function(){
            $('#ket_status_modal_baru').val(get_status_modal_perusahaan($(this).val()));
        });
    </script>
    <div class="col-sm-1"><input readonly=""  value="<?php echo get_status_modal_perusahaan($data_baru->nilai_investasi); ?>" value="<?php echo get_status_modal_perusahaan($data_baru->nilai_investasi) ?>" type="text" class="form-control input-sm" name="ket_status_modal" id="ket_status_modal"></div>
    
    

    <?php if($fo->tdp_perubahan_alasan_penerbitan == 'PS'): ?>
    <div class="col-sm-1"><label for="">Berubah ke</label></div>
    <div class="col-sm-1"><input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo 'readonly=""'; } ?> value="<?php echo get_status_modal_perusahaan($data_baru->nilai_investasi); ?>" type="text" class="form-control input-sm" name="ket_status_modal_baru" id="ket_status_modal_baru"></div>
    <?php endif; ?>

</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">NPWP</label>
    <div class="col-sm-6"><input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> value="<?php echo $data_baru->npwp ?>" type="text" name="npwp" id="npwp" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Telepon</label>
    <div class="col-sm-6"><input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> value="<?php echo $data_baru->no_telp ?>" type="text" name="no_telp" id="no_telp" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Fax</label>
    <div class="col-sm-6"><input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> value="<?php echo $data_baru->no_fax; ?>" type="text" name="no_fax" id="no_fax" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Akte Notaris</label>
    <div class="col-sm-6"><input <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> value="<?php echo $data_baru->no_akte_notaris; ?>" type="text" name="no_akte_notaris" id="no_akte_notaris" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">KBLI</label>
    <div class="col-sm-9">
        <select <?php // if($fo->tdp_perubahan_alasan_penerbitan == 'PS') { echo ''; } elseif($fo->tdp_perubahan_alasan_penerbitan == 'PL') { echo ''; } ?> class="form-control input-sm" name="id_kbli"  id="id_kbli" multiple="" style="height: 200px;">
            <?php if($kbli_5): foreach($kbli_5 as $r_kbli_5): ?>
                <option <?php echo ($data_baru->id_kbli == $r_kbli_5->id_kbli) ? 'selected=""' : '' ; ?> value="<?php echo $r_kbli_5->id_kbli ?>"><?php echo $r_kbli_5->id_kbli.' : '.$r_kbli_5->judul_kbli; ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-6"><input value="<?php echo $data_baru->tanggal_terbit ?>" readonly="" type="date" name="tanggal_terbit" id="tanggal_terbit" value="" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-6"><input value="<?php echo $data_baru->tanggal_perpanjangan ?>" readonly="" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" value="" class="form-control input-sm"></div>
</div>

<input type="hidden" name="pembaharuan_ke" id="pembaharuan_ke" value="<?php echo $edit->pembaharuan_ke; ?>">
