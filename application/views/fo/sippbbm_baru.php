<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan Pemohon</label>
    <div class="col-sm-3">
        <input type="text" class="form-control input-sm" name="sippbbm_baru_pekerjaan_pemohon" id="sippbbm_baru_pekerjaan_pemohon" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemohon</label>
    <div class="col-sm-6"><textarea name="sippbbm_baru_alamat_pemohon" id="sippbbm_baru_alamat_pemohon" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemohon</label>
    <div class="col-sm-4">
        <select name="sippbbm_baru_id_kec_pemohon" id="sippbbm_baru_id_kec_pemohon" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#sippbbm_baru_id_kec_pemohon').change(function(){

            var sippbbm_baru_id_kec_pemohon = $('#sippbbm_baru_id_kec_pemohon').val();

            console.log(sippbbm_baru_id_kec_pemohon);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + sippbbm_baru_id_kec_pemohon,
                success: function(data) {

                    $('#sippbbm_baru_id_kel_pemohon').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Pemohon</label>
    <div class="col-sm-4">
        <select name="sippbbm_baru_id_kel_pemohon" id="sippbbm_baru_id_kel_pemohon" class="form-control input-sm">
            
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input type="text" class="form-control input-sm" name="sippbbm_baru_nama_perusahaan" id="sippbbm_baru_nama_perusahaan" />
    </div>
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input type="text" class="form-control input-sm" name="sippbbm_baru_nama_pemilik" id="sippbbm_baru_nama_pemilik" />
        <label style="padding-top: 10px;">

            <input type="checkbox" id="samakan_nama"> Samakan dengan Nama Pemohon.
            <script type="text/javascript">
            $('#samakan_nama').click(function(){
                if($(this).is(':checked')){
                    var nama_pemohon = $('#nama_pemohon').val();
                    console.log(nama_pemohon);
                    $('#sippbbm_baru_nama_pemilik').val(nama_pemohon);
                }else{
                    $('#sippbbm_baru_nama_pemilik').val('');
                }
            });
            </script>
        </label>
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