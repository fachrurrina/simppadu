
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->imb_baru_nama_pemilik ?>" type="text" class="form-control input-sm" name="imb_baru_nama_pemilik" id="imb_baru_nama_pemilik" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Bangunan</label>
    <div class="col-sm-6"><textarea readonly="" name="imb_baru_alamat_bangunan" id="imb_baru_alamat_bangunan" class="form-control input-sm"><?php echo $verifikasi->imb_baru_alamat_bangunan ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Bangunan</label>
    <div class="col-sm-4">
        <select readonly="" name="imb_baru_id_kec_bangunan" id="imb_baru_id_kec_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->imb_baru_id_kec_bangunan == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
        <select readonly="" name="imb_baru_id_kel_bangunan" id="imb_baru_id_kel_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($verifikasi->imb_baru_id_kel_bangunan == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>



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

