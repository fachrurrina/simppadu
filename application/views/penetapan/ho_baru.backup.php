<script type="text/javascript">
    
    function hitung_retribusi(){

        var ho_baru_nilai_index_lokasi      = $('#ho_baru_nilai_index_lokasi').val();
        var ho_baru_nilai_index_luas        = $('#ho_baru_nilai_index_luas').val();
        var ho_baru_nilai_index_gangguan    = $('#ho_baru_nilai_index_gangguan').val();
        var ho_baru_nilai_index_harga_dasar = $('#ho_baru_nilai_index_harga_dasar').val();

        console.log(ho_baru_nilai_index_lokasi);
        console.log(ho_baru_nilai_index_luas);
        console.log(ho_baru_nilai_index_gangguan);
        console.log(ho_baru_nilai_index_harga_dasar);

        /*if(ho_baru_nilai_index_lokasi == 0 || ho_baru_nilai_index_luas == 0 || ho_baru_nilai_index_gangguan == 0 || ho_baru_nilai_index_harga_dasar == 0){
            alert('Anda belum melengkapi kriteria Perhitungan Penetepan');
        }else{*/
            var nilai_retribusi         = ho_baru_nilai_index_lokasi * ho_baru_nilai_index_luas * ho_baru_nilai_index_gangguan * ho_baru_nilai_index_harga_dasar;
            $('#ho_baru_nilai_retribusi').val(nilai_retribusi);
        // }
        
    }
</script>


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
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Peninjauan Lapangan</label>
    <div class="col-sm-3">
        <input value="" type="date" class="form-control input-sm" name="ho_baru_tanggal_peninjauan_lapangan" id="ho_baru_tanggal_peninjauan_lapangan" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-6"><input type="text" value="<?php echo $penetapan->ho_baru_nama_pemilik; ?>" name="ho_baru_nama_pemilik" id="ho_baru_nama_pemilik" class="form-control input-sm" /></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-6"><input type="text" value="<?php echo $penetapan->ho_baru_nama_perusahaan; ?>" name="ho_baru_nama_perusahaan" id="ho_baru_nama_perusahaan" class="form-control input-sm" /></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea name="ho_baru_alamat_perusahaan" id="ho_baru_alamat_perusahaan" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-4">
        <select name="ho_baru_id_kec_perusahaan" id="ho_baru_id_kec_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#ho_baru_id_kec_perusahaan').change(function(){

            var ho_baru_id_kec_perusahaan = $('#ho_baru_id_kec_perusahaan').val();

            console.log(ho_baru_id_kec_perusahaan);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + ho_baru_id_kec_perusahaan,
                success: function(data) {

                    $('#ho_baru_id_kel_perusahaan').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Perusahaan</label>
    <div class="col-sm-4">
        <select name="ho_baru_id_kel_perusahaan" id="ho_baru_id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    
    <label for="" class="col-sm-2 control-label">Nama Bidang Usaha</label>
    <div class="col-sm-6"><input type="text" value="<?php echo $penetapan->ho_baru_nama_bidang_usaha; ?>" name="ho_baru_nama_bidang_usaha" id="ho_baru_nama_bidang_usaha" class="form-control input-sm" /></div>
    
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Luas Tempat Usaha (p x l)</label>
    <div class="col-sm-2">
        <input value="" type="number" class="form-control input-sm" name="ho_baru_panjang_tempat_usaha" id="ho_baru_panjang_tempat_usaha" />
    </div>

    <div class="col-sm-2">
        <input value="" type="number" class="form-control input-sm" name="ho_baru_lebar_tempat_usaha" id="ho_baru_lebar_tempat_usaha" />
    </div>
    
    

    <script type="text/javascript">
        $(document).ready(function(){
            $('#ho_baru_panjang_tempat_usaha').change(function(){
                var ho_baru_luas_tempat_usaha = $('#ho_baru_panjang_tempat_usaha').val() * $('#ho_baru_lebar_tempat_usaha').val();
                <?php $result = $this->db->get('t_index_luas')->result(); ?>
                <?php if($result): foreach($result as $r): ?>
                    if(ho_baru_luas_tempat_usaha > <?php echo $r->minimal ?> && ho_baru_luas_tempat_usaha <= <?php echo $r->maximal ?>){
                        var ho_baru_nilai_index_luas = <?php echo $r->nilai_index_luas ?>;
                        var ho_baru_kode_index_luas = <?php echo $r->kode_index_luas ?>;
                    }
                <?php endforeach; endif; ?>

                $('#ho_baru_nilai_index_luas').val(ho_baru_nilai_index_luas);
                $('#ho_baru_kode_index_luas').val(ho_baru_kode_index_luas);

                hitung_retribusi();
            });

            $('#ho_baru_lebar_tempat_usaha').change(function(){

                var ho_baru_luas_tempat_usaha = $('#ho_baru_panjang_tempat_usaha').val() * $('#ho_baru_lebar_tempat_usaha').val();
                // console.log(ho_baru_luas_tempat_usaha);
                
                <?php $result = $this->db->get('t_index_luas')->result(); ?>

                <?php if($result): foreach($result as $r): ?>
                    if(ho_baru_luas_tempat_usaha > <?php echo $r->minimal ?> && ho_baru_luas_tempat_usaha <= <?php echo $r->maximal ?>){
                        var ho_baru_nilai_index_luas = <?php echo $r->nilai_index_luas ?>;
                        var ho_baru_kode_index_luas = <?php echo $r->kode_index_luas ?>;
                    }
                <?php endforeach; endif; ?>

                $('#ho_baru_nilai_index_luas').val(ho_baru_nilai_index_luas);
                $('#ho_baru_kode_index_luas').val(ho_baru_kode_index_luas);

                hitung_retribusi();
            });
        });
    </script>

    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_baru_nilai_index_luas" id="ho_baru_nilai_index_luas">
        <input type="hidden" name="ho_baru_kode_index_luas" id="ho_baru_kode_index_luas">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Gangguan</label>
    <div class="col-sm-4">
        
        <select class="form-control input-sm" name="ho_baru_kode_index_gangguan" id="ho_baru_kode_index_gangguan">
            <option></option>
            <?php if($index_gangguan): foreach($index_gangguan as $r_index_gangguan): ?>
                <option value="<?php echo $r_index_gangguan->kode_index_gangguan ?>" nilai_index_gangguan="<?php echo $r_index_gangguan->nilai_index_gangguan; ?>"><?php echo $r_index_gangguan->nama_index_gangguan ?></option>
            <?php endforeach; endif; ?>
        </select>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#ho_baru_kode_index_gangguan').change(function(){
                var ho_baru_nilai_index_gangguan = $('#ho_baru_kode_index_gangguan > option:selected').attr('nilai_index_gangguan');
                console.log(ho_baru_nilai_index_gangguan);
                $('#ho_baru_nilai_index_gangguan').val(ho_baru_nilai_index_gangguan);

                hitung_retribusi();
            });
        })
    </script>

    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_baru_nilai_index_gangguan" id="ho_baru_nilai_index_gangguan">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Lokasi</label>
    <div class="col-sm-4">
        <select class="form-control input-sm" name="ho_baru_kode_index_lokasi" id="ho_baru_kode_index_lokasi">
            <option></option>
            <?php if($index_lokasi): foreach($index_lokasi as $r_index_lokasi): ?>
                <option value="<?php echo $r_index_lokasi->kode_index_lokasi ?>" nilai_index_lokasi="<?php echo $r_index_lokasi->nilai_index_lokasi ?>"><?php echo $r_index_lokasi->nama_index_lokasi ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#ho_baru_kode_index_lokasi').change(function(){
                var ho_baru_nilai_index_lokasi = $('#ho_baru_kode_index_lokasi > option:selected').attr('nilai_index_lokasi');
                console.log(ho_baru_nilai_index_lokasi);
                $('#ho_baru_nilai_index_lokasi').val(ho_baru_nilai_index_lokasi);

                hitung_retribusi();
            });
        })
    </script>
    
    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_baru_nilai_index_lokasi" id="ho_baru_nilai_index_lokasi">
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Harga Dasar</label>
    <div class="col-sm-4">
        <select class="form-control input-sm" name="ho_baru_kode_index_harga_dasar" id="ho_baru_kode_index_harga_dasar">
            <option></option>
            <?php if($index_harga_dasar): foreach($index_harga_dasar as $r_index_harga_dasar): ?>
                <option value="<?php echo $r_index_harga_dasar->kode_index_harga_dasar ?>" nilai_index_harga_dasar="<?php echo $r_index_harga_dasar->nilai_index_harga_dasar ?>"><?php echo $r_index_harga_dasar->nama_index_harga_dasar ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#ho_baru_kode_index_harga_dasar').change(function(){
                var ho_baru_nilai_index_harga_dasar = $('#ho_baru_kode_index_harga_dasar > option:selected').attr('nilai_index_harga_dasar');
                console.log(ho_baru_nilai_index_harga_dasar);
                $('#ho_baru_nilai_index_harga_dasar').val(ho_baru_nilai_index_harga_dasar);

                hitung_retribusi();
            });
        })
    </script>
    
    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_baru_nilai_index_harga_dasar" id="ho_baru_nilai_index_harga_dasar">
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nilai Retribusi</label>
    

    <div class="col-sm-4">
        <input type="text" class="form-control input-sm" name="ho_baru_nilai_retribusi" class="ho_baru_nilai_retribusi" id="ho_baru_nilai_retribusi">
    </div>
</div>
                    

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        
        <input type="submit" class="btn btn-primary btn-xs" value="tetapkan" name="tetapkan" id="tetapkan">

        <script type="text/javascript">
            $("#tetapkan").click(function(event){
                var ho_baru_nilai_index_lokasi      = $('#ho_baru_nilai_index_lokasi').val();
                var ho_baru_nilai_index_luas        = $('#ho_baru_nilai_index_luas').val();
                var ho_baru_nilai_index_gangguan    = $('#ho_baru_nilai_index_gangguan').val();
                var ho_baru_nilai_index_harga_dasar = $('#ho_baru_nilai_index_harga_dasar').val();
                
                if(ho_baru_nilai_index_lokasi == 0 || ho_baru_nilai_index_luas == 0 || ho_baru_nilai_index_gangguan == 0 || ho_baru_nilai_index_harga_dasar == 0){
                    event.preventDefault(); // cancel default behavior
                    alert('Anda belum melengkapi kriteria Perhitungan Penetepan');
                    
                }
                
              });
        </script>
    </div>
</div>
                    


