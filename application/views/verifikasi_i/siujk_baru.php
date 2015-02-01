<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->siujk_baru_nama_perusahaan ?>" readonly="" type="text" class="form-control input-sm" name="siujk_baru_nama_perusahaan" id="siujk_baru_nama_perusahaan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select readonly="" class="form-control input-sm" name="siuk_baru_id_bentuk_perusahaan" id="siuk_baru_id_bentuk_perusahaan">
            <option></option>
            <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                <option <?php echo ($verifikasi->siujk_baru_id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : ''; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->siujk_baru_nama_pemilik ?>" readonly="" type="text" class="form-control input-sm" name="siujk_baru_nama_pemilik" id="siujk_baru_nama_pemilik" />
        <label style="padding-top: 10px;">

            <input readonly="" type="checkbox" id="samakan_nama"> Samakan dengan Nama Pemohon.
            <script type="text/javascript">
            $('#samakan_nama').click(function(){
                if($(this).is(':checked')){
                    var nama_pemohon = $('#nama_pemohon').val();
                    console.log(nama_pemohon);
                    $('#siujk_baru_nama_pemilik').val(nama_pemohon);
                }else{
                    $('#siujk_baru_nama_pemilik').val('');
                }
            });
            </script>
        </label>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">NPWP</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->siujk_baru_npwp ?>" readonly="" type="text" class="form-control input-sm" name="siujk_baru_npwp" id="siujk_baru_npwp" />
    </div>
</div>

<div class="form-group" style="margin-bottom: 0">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Usaha</label>

    <div class="col-sm-5">
        <input value="<?php echo $verifikasi->siujk_baru_jenis_usaha ?>" readonly="" type="text" class="form-control input-sm" id="siujk_baru_jenis_usaha" name="siujk_baru_jenis_usaha" />
    </div>
    
</div>

<br />

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelengkapan Syarat</label>
    <div class="col-sm-10">
        <?php $array_id_syarat = explode('|', $verifikasi->id_syarat);?>
        <?php if($syarat): foreach ($syarat as $r_syarat): ?>
            <label>
                <input disabled="" <?php echo (in_array($r_syarat->id_syarat, $array_id_syarat)) ? 'checked=""' : '' ; ?> type="checkbox" name="id_syarat[]" value="<?php echo $r_syarat->id_syarat; ?>" id="id_syarat[]" /> <?php echo $r_syarat->nama_syarat; ?>
            </label>
            <br />
            
        <?php endforeach; endif; ?>
    </div>
</div>

