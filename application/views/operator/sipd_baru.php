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
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $agenda->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input value="<?php echo $fo->sipd_baru_nama_perusahaan; ?>" type="text" class="form-control input-sm" name="nama_perusahaan" id="nama_perusahaan" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
            <option></option>
            <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                <option <?php echo ($fo->sipd_baru_id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : ''; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-3">
        <input value="<?php echo $fo->sipd_baru_nama_pemilik; ?>" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
    </div>
</div>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-4">
        <select name="id_kec_perusahaan" id="id_kec_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
            
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Bahan Pengambilan/Penambangan</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="jenis_bahan" id="jenis_bahan" />
    </div>
</div>






<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Lokasi Pengambilan</label>
    <div class="col-sm-6"><textarea name="alamat_lokasi" id="alamat_lokasi" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Lokasi Pengambilan</label>
    <div class="col-sm-4">
        <select name="id_kec_lokasi" id="id_kec_lokasi" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_lokasi').change(function(){

            var id_kec_lokasi = $('#id_kec_lokasi').val();

            console.log(id_kec_lokasi);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_lokasi,
                success: function(data) {

                    $('#id_kel_lokasi').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Lokasi Pengambilan</label>
    <div class="col-sm-4">
        <select name="id_kel_lokasi" id="id_kel_lokasi" class="form-control input-sm">
            
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Luas Wilayah (M<sup>2</sup>)</label>
    <div class="col-sm-2">
        <input value="" type="number" class="form-control input-sm" name="luas_wilayah" id="luas_wilayah" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Utara</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="batas_utara" id="batas_utara" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Selatan</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="batas_selatan" id="batas_selatan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Barat</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="batas_barat" id="batas_barat" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Timur</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="batas_timur" id="batas_timur" />
    </div>
</div>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Koordinat N</label>
    <div class="col-sm-3" id="container_koordinat_n">
        <input type="text" name="koordinat_n[]" id="koordinat_n[]" value="" class="form-control input-sm" style="margin-bottom: 5px;">
    </div>
    <label for="" class="col-sm-2 control-label">Koordinat E</label>
    <div class="col-sm-3" id="container_koordinat_e">
        <input type="text" name="koordinat_e[]" id="koordinat_e[]" value="" class="form-control input-sm" style="margin-bottom: 5px;">
    </div>
    <div class="col-sm-1" id="" style="padding-left: 0;">
        <a class="btn btn-primary btn-xs" id="tambah_koordinat" name="tambah_koordinat"><span class="glyphicon glyphicon-plus"></span></a>
    </div>
</div>



<script type="text/javascript">
    $(function(){
        /*$('#tambah_keterangan_barang').click(function(){
            $('#keterangan_barang').clone().appendTo('#container_keterangan_barang');
        });*/
        $("#tambah_koordinat").click(function(e) {
            var input_koordinat_n = document.createElement('input');
            $(input_koordinat_n).attr('type', 'text');
            $(input_koordinat_n).attr('name', 'koordinat_n[]');
            $(input_koordinat_n).attr('id', 'koordinat_n[]');
            $(input_koordinat_n).attr('style', 'margin-bottom: 5px;');
            $(input_koordinat_n).attr('class', 'form-control input-sm');
            $("#container_koordinat_n").append(input_koordinat_n);

            var input_koordinat_e = document.createElement('input');
            $(input_koordinat_e).attr('type', 'text');
            $(input_koordinat_e).attr('name', 'koordinat_e[]');
            $(input_koordinat_e).attr('id', 'koordinat_e[]');
            $(input_koordinat_e).attr('style', 'margin-bottom: 5px;');
            $(input_koordinat_e).attr('class', 'form-control input-sm');
            $("#container_koordinat_e").append(input_koordinat_e);

            e.preventDefault();
        });
    });
</script>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $agenda->tanggal_terbit ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $agenda->tanggal_perpanjangan ?>" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
</div>
