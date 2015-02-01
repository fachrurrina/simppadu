<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $penetapan->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $penetapan->tanggal_daftar ; ?>" readonly="" type="date" class="form-control input-sm" name="tanggal_daftar" id="tanggal_daftar" />
    </div>
</div>



<hr>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Penanggung Jawab</label>
    <div class="col-sm-6"><textarea name="iup_baru_alamat" id="iup_baru_alamat" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Penanggung Jawab</label>
    <div class="col-sm-4">
        <select name="iup_baru_id_kec_penanggung_jawab" id="iup_baru_id_kec_penanggung_jawab" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option  value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#iup_baru_id_kec_penanggung_jawab').change(function(){

            var iup_baru_id_kec_penanggung_jawab = $('#iup_baru_id_kec_penanggung_jawab').val();

            console.log(iup_baru_id_kec_penanggung_jawab);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + iup_baru_id_kec_penanggung_jawab,
                success: function(data) {

                    $('#iup_baru_id_kel_penanggung_jawab').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan</label>
    <div class="col-sm-4">
        <select name="iup_baru_id_kel_penanggung_jawab" id="iup_baru_id_kel_penanggung_jawab" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option  value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha Perikanan</label>
    <div class="col-sm-5">
        <select class="form-control input-sm" name="iup_baru_id_bidang_iup" id="iup_baru_id_bidang_iup" >
            <option></option>
            <?php if($bidang_iup): foreach($bidang_iup as $r_bidang_iup): ?>
                <option  value="<?php echo $r_bidang_iup->id_bidang_iup ?>"><?php echo $r_bidang_iup->nama_bidang_iup ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#iup_baru_id_bidang_iup').change(function(){

                var iup_baru_id_bidang_iup = $('#iup_baru_id_bidang_iup').val();
                $.ajax({
                    url: '<?php echo site_url("c_ajax/load_combo_sub_bidang_iup") ?>/?id_bidang_iup=' + iup_baru_id_bidang_iup,
                    success: function(data) {

                        // $('#iup_baru_id_sub_bidang_iup').html(data);
                        console.log(data);
                        $('#iup_baru_id_sub_bidang_iup').html(data);

                        console.log($('#iup_baru_id_sub_bidang_iup'));
                    }
                });
            });
        })
    </script>

    <div class="col-sm-5">
        <select class="form-control input-sm" name="iup_baru_id_sub_bidang_iup" id="iup_baru_sub_id_bidang_iup" >
            <option></option>
            
        </select>
    </div>
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Peninjauan Lapangan</label>
    <div class="col-sm-3">
        <input value="" type="date" class="form-control input-sm" name="iup_baru_tanggal_peninjauan_lapangan" id="iup_baru_tanggal_peninjauan_lapangan" />
    </div>
</div>


                    

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
        
            <label>
                <input checked="" type="checkbox" name="sekaligus_cetak" value="1" id="sekaligus_cetak" /> Sekaligus Cetak SSRD ?
            </label>
            <br />
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        
        <input type="submit" class="btn btn-primary btn-xs" value="tetapkan" name="tetapkan">
    </div>
</div>
                    


