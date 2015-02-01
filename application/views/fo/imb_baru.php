

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-3">
        <input type="text" class="form-control input-sm" name="imb_baru_nama_pemilik" id="imb_baru_nama_pemilik" />
        <label style="padding-top: 10px;">

            <input type="checkbox" id="samakan_nama"> Samakan dengan Nama Pemohon.
            <script type="text/javascript">
            $('#samakan_nama').click(function(){
                if($(this).is(':checked')){
                    var nama_pemohon = $('#nama_pemohon').val();
                    console.log(nama_pemohon);
                    $('#imb_baru_nama_pemilik').val(nama_pemohon);
                }else{
                    $('#imb_baru_nama_pemilik').val('');
                }
            });
            </script>
        </label>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Bangunan</label>
    <div class="col-sm-6"><textarea name="imb_baru_alamat_bangunan" id="imb_baru_alamat_bangunan" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Bangunan</label>
    <div class="col-sm-4">
        <select name="imb_baru_id_kec_bangunan" id="imb_baru_id_kec_bangunan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
            
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelengkapan Syarat</label>
    <div class="col-sm-10">
        <?php if($syarat): foreach ($syarat as $r_syarat): ?>
            <label>
                <input type="checkbox" name="id_syarat[]" value="<?php echo $r_syarat->id_syarat; ?>" id="id_syarat[]" /> <?php echo $r_syarat->nama_syarat; ?>
            </label>
            <br />
            
        <?php endforeach; endif; ?>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <a href="<?php echo site_url('c_fo') ?>" class="btn btn-default btn-sm">Kembali</a>
        <input type="submit" class="btn btn-primary btn-sm" value="Simpan" name="simpan">
    </div>
</div>