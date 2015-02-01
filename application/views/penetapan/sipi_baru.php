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
    <label for="" class="col-sm-2 control-label">Alamat </label>
    <div class="col-sm-6"><textarea name="sipi_baru_alamat" id="sipi_baru_alamat" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan </label>
    <div class="col-sm-4">
        <select name="sipi_baru_id_kec" id="sipi_baru_id_kec" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option  value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#sipi_baru_id_kec').change(function(){

            var sipi_baru_id_kec = $('#sipi_baru_id_kec').val();

            console.log(sipi_baru_id_kec);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + sipi_baru_id_kec,
                success: function(data) {

                    $('#sipi_baru_id_kel').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan</label>
    <div class="col-sm-4">
        <select name="sipi_baru_id_kel" id="sipi_baru_id_kel" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option  value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Alat Tangkap</label>
    <div class="col-sm-5">
        <select class="form-control input-sm" name="sipi_baru_id_jenis_alat_tangkap" id="sipi_baru_id_jenis_alat_tangkap" >
            <option></option>
            <?php if($jenis_alat_tangkap): foreach($jenis_alat_tangkap as $r_jenis_alat_tangkap): ?>
                <option biaya="<?php echo $r_jenis_alat_tangkap->biaya ?>" value="<?php echo $r_jenis_alat_tangkap->id_jenis_alat_tangkap ?>"><?php echo $r_jenis_alat_tangkap->nama_jenis_alat_tangkap ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#sipi_baru_id_jenis_alat_tangkap').change(function(){
                var sipi_baru_id_jenis_alat_tangkap = $('#sipi_baru_id_jenis_alat_tangkap > option:selected').attr('value');
                var sipi_baru_nilai_retribusi       = $('#sipi_baru_id_jenis_alat_tangkap > option:selected').attr('biaya');
                
                $('#sipi_baru_nilai_retribusi').val(sipi_baru_nilai_retribusi);
            });
        })
    </script>

    <div class="col-sm-2">
        <input value="" type="number" class="form-control input-sm" name="sipi_baru_nilai_retribusi" id="sipi_baru_nilai_retribusi" />
    </div>
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Peninjauan Lapangan</label>
    <div class="col-sm-3">
        <input value="" type="date" class="form-control input-sm" name="sipi_baru_tanggal_peninjauan_lapangan" id="sipi_baru_tanggal_peninjauan_lapangan" />
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
                    


