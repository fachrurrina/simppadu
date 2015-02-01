


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



<hr />

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Peninjauan Lapangan</label>
    <div class="col-sm-3">
        <input <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> value="<?php echo $data_lalu->tanggal_peninjauan_lapangan; ?>" type="date" class="form-control input-sm" name="ho_perpanjangan_tanggal_peninjauan_lapangan" id="ho_perpanjangan_tanggal_peninjauan_lapangan" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> name="ho_perpanjangan_alamat_pemilik" id="ho_perpanjangan_alamat_pemilik" class="form-control input-sm"><?php echo $data_lalu->alamat_pemilik; ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> name="ho_perpanjangan_id_kec_pemilik" id="ho_perpanjangan_id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($data_lalu->id_kec_pemilik == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#ho_perpanjangan_id_kec_pemilik').change(function(){

            var ho_perpanjangan_id_kec_pemilik = $('#ho_perpanjangan_id_kec_pemilik').val();

            console.log(ho_perpanjangan_id_kec_pemilik);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + ho_perpanjangan_id_kec_pemilik,
                success: function(data) {

                    $('#ho_perpanjangan_id_kel_pemilik').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Pemilik</label>
    <div class="col-sm-4">
        <select <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> name="ho_perpanjangan_id_kel_pemilik" id="ho_perpanjangan_id_kel_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($data_lalu->id_kel_pemilik == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
    <div class="col-sm-7">
        <select <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> class="form-control input-sm" name="ho_perpanjangan_id_bidang_" id="ho_perpanjangan_id_bidang_" >
            <option></option>
            <?php if($bidang_ho): foreach($bidang_ho as $r_bidang_ho): ?>
                <option <?php echo ($data_lalu->id_bidang_ho == $r_bidang_ho->id_bidang_ho) ? 'selected=""' : ''; ?> value="<?php echo $r_bidang_ho->id_bidang_ho ?>"><?php echo $r_bidang_ho->nama_bidang_ho ?></option>
            <?php endforeach; endif; ?>
        </select>
        <input type="hidden" name="ho_perpanjangan_id_bidang" id="ho_perpanjangan_id_bidang">

        <script type="text/javascript">
            $(document).ready(function(){

                // pada saat load ambil data masukkan kedalam element hidden
                $('#ho_perpanjangan_id_bidang').val($('#ho_perpanjangan_id_bidang_').find(":selected").attr('value'));
                console.log($('#ho_perpanjangan_id_bidang_').find(":selected").attr('value'));

                // jika memilih ... maka ganti value dalam input hidden
                $('#ho_perpanjangan_id_bidang_').change(function(){
                    $('#ho_perpanjangan_id_bidang').val($('#ho_perpanjangan_id_bidang_').find(":selected").attr('value'));
                    console.log($('#ho_perpanjangan_id_bidang_').find(":selected").attr('value'));
                });
            });
        </script>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Luas Tempat Usaha (p x l)</label>
    <div class="col-sm-2">
        <input <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> value="<?php echo $data_lalu->panjang_tempat_usaha ?>" type="number" class="form-control input-sm" name="ho_perpanjangan_panjang_tempat_usaha" id="ho_perpanjangan_panjang_tempat_usaha" />
    </div>
    

    <div class="col-sm-2">
        <input <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> value="<?php echo $data_lalu->lebar_tempat_usaha ?>" type="number" class="form-control input-sm" name="ho_perpanjangan_lebar_tempat_usaha" id="ho_perpanjangan_lebar_tempat_usaha" />
    </div>

    
    

    <script type="text/javascript">
        $(document).ready(function(){

            /*-----------------------------------------------------------------------------------------------------------------------*/
            var ho_perpanjangan_luas_tempat_usaha = $('#ho_perpanjangan_panjang_tempat_usaha').val() * $('#ho_perpanjangan_lebar_tempat_usaha').val();
            // console.log(ho_perpanjangan_luas_tempat_usaha);
            
            <?php $result = $this->db->get('t_index_luas')->result(); ?>

            <?php if($result): foreach($result as $r): ?>
                if(ho_perpanjangan_luas_tempat_usaha > <?php echo $r->minimal ?> && ho_perpanjangan_luas_tempat_usaha <= <?php echo $r->maximal ?>){
                    var ho_perpanjangan_nilai_index_luas = <?php echo $r->nilai_index_luas ?>;
                    var ho_perpanjangan_kode_index_luas = <?php echo $r->kode_index_luas ?>;
                }
            <?php endforeach; endif; ?>

            $('#ho_perpanjangan_nilai_index_luas').val(ho_perpanjangan_nilai_index_luas);
            $('#ho_perpanjangan_kode_index_luas').val(ho_perpanjangan_kode_index_luas);
            /*-----------------------------------------------------------------------------------------------------------------------*/


            /*-----------------------------------------------------------------------------------------------------------------------*/
            $('#ho_perpanjangan_panjang_tempat_usaha').change(function(){

                var ho_perpanjangan_luas_tempat_usaha = $('#ho_perpanjangan_panjang_tempat_usaha').val() * $('#ho_perpanjangan_lebar_tempat_usaha').val();
                // console.log(ho_perpanjangan_luas_tempat_usaha);
                
                <?php $result = $this->db->get('t_index_luas')->result(); ?>

                <?php if($result): foreach($result as $r): ?>
                    if(ho_perpanjangan_luas_tempat_usaha > <?php echo $r->minimal ?> && ho_perpanjangan_luas_tempat_usaha <= <?php echo $r->maximal ?>){
                        var ho_perpanjangan_nilai_index_luas = <?php echo $r->nilai_index_luas ?>;
                        var ho_perpanjangan_kode_index_luas = <?php echo $r->kode_index_luas ?>;
                    }
                <?php endforeach; endif; ?>

                $('#ho_perpanjangan_nilai_index_luas').val(ho_perpanjangan_nilai_index_luas);
                $('#ho_perpanjangan_kode_index_luas').val(ho_perpanjangan_kode_index_luas);
            });
            /*-----------------------------------------------------------------------------------------------------------------------*/

            /*-----------------------------------------------------------------------------------------------------------------------*/
            $('#ho_perpanjangan_lebar_tempat_usaha').change(function(){

                var ho_perpanjangan_luas_tempat_usaha = $('#ho_perpanjangan_panjang_tempat_usaha').val() * $('#ho_perpanjangan_lebar_tempat_usaha').val();
                // console.log(ho_perpanjangan_luas_tempat_usaha);
                
                <?php $result = $this->db->get('t_index_luas')->result(); ?>

                <?php if($result): foreach($result as $r): ?>
                    if(ho_perpanjangan_luas_tempat_usaha > <?php echo $r->minimal ?> && ho_perpanjangan_luas_tempat_usaha <= <?php echo $r->maximal ?>){
                        var ho_perpanjangan_nilai_index_luas = <?php echo $r->nilai_index_luas ?>;
                        var ho_perpanjangan_kode_index_luas = <?php echo $r->kode_index_luas ?>;
                    }
                <?php endforeach; endif; ?>

                $('#ho_perpanjangan_nilai_index_luas').val(ho_perpanjangan_nilai_index_luas);
                $('#ho_perpanjangan_kode_index_luas').val(ho_perpanjangan_kode_index_luas);
            });
            /*-----------------------------------------------------------------------------------------------------------------------*/
        });
    </script>

    <div class="col-sm-1">
        <input <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> type="text" readonly="" class="form-control input-sm" name="ho_perpanjangan_nilai_index_luas" id="ho_perpanjangan_nilai_index_luas">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Gangguan</label>
    <div class="col-sm-4">
        
        <select <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> class="form-control input-sm" name="ho_perpanjangan_kode_index_gangguan_" id="ho_perpanjangan_kode_index_gangguan_">
            <option></option>
            <?php if($index_gangguan): foreach($index_gangguan as $r_index_gangguan): ?>
                <option <?php echo ($data_lalu->kode_index_gangguan == $r_index_gangguan->kode_index_gangguan) ? 'selected=""' : ''; ?> value="<?php echo $r_index_gangguan->kode_index_gangguan ?>" nilai_index_gangguan="<?php echo $r_index_gangguan->nilai_index_gangguan; ?>"><?php echo $r_index_gangguan->nama_index_gangguan ?></option>
            <?php endforeach; endif; ?>
        </select>

        <input <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> type="hidden" name="ho_perpanjangan_kode_index_gangguan" id="ho_perpanjangan_kode_index_gangguan">

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            /*-----------------------------------------------------------------------------------------------------------------*/
            $('#ho_perpanjangan_kode_index_gangguan').val($('#ho_perpanjangan_kode_index_gangguan_ > option:selected').attr('value'));
            var ho_perpanjangan_nilai_index_gangguan = $('#ho_perpanjangan_kode_index_gangguan_ > option:selected').attr('nilai_index_gangguan');
            console.log(ho_perpanjangan_nilai_index_gangguan);

            $('#ho_perpanjangan_nilai_index_gangguan').val(ho_perpanjangan_nilai_index_gangguan);
            /*-----------------------------------------------------------------------------------------------------------------*/


            <?php if($penetapan->ho_perpanjangan_status_perubahan == 1): ?>
            /*-----------------------------------------------------------------------------------------------------------------*/
            $('#ho_perpanjangan_kode_index_gangguan_').change(function(){

                $('#ho_perpanjangan_kode_index_gangguan').val($('#ho_perpanjangan_kode_index_gangguan_ > option:selected').attr('value'));
                var ho_perpanjangan_nilai_index_gangguan = $('#ho_perpanjangan_kode_index_gangguan_ > option:selected').attr('nilai_index_gangguan');
                console.log(ho_perpanjangan_nilai_index_gangguan);
                $('#ho_perpanjangan_nilai_index_gangguan').val(ho_perpanjangan_nilai_index_gangguan);
            });
            /*-----------------------------------------------------------------------------------------------------------------*/
            <?php endif; ?>
        });
    </script>

    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_perpanjangan_nilai_index_gangguan" id="ho_perpanjangan_nilai_index_gangguan">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Lokasi</label>
    <div class="col-sm-4">
        <select <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> class="form-control input-sm" name="ho_perpanjangan_kode_index_lokasi_" id="ho_perpanjangan_kode_index_lokasi_">
            <option></option>
            <?php if($index_lokasi): foreach($index_lokasi as $r_index_lokasi): ?>
                <option <?php echo ($data_lalu->kode_index_lokasi == $r_index_lokasi->kode_index_lokasi) ? 'selected=""' : ''; ?> value="<?php echo $r_index_lokasi->kode_index_lokasi ?>" nilai_index_lokasi="<?php echo $r_index_lokasi->nilai_index_lokasi ?>"><?php echo $r_index_lokasi->nama_index_lokasi ?></option>
            <?php endforeach; endif; ?>
        </select>

        <input <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> type="hidden" name="ho_perpanjangan_kode_index_lokasi" id="ho_perpanjangan_kode_index_lokasi">
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            /*-------------------------------------------------------------------------------------------------------------------*/
            $('#ho_perpanjangan_kode_index_lokasi').val($('#ho_perpanjangan_kode_index_lokasi_ > option:selected').attr('value'));
            var ho_perpanjangan_nilai_index_lokasi = $('#ho_perpanjangan_kode_index_lokasi_ > option:selected').attr('nilai_index_lokasi');
            console.log(ho_perpanjangan_nilai_index_lokasi);
            $('#ho_perpanjangan_nilai_index_lokasi').val(ho_perpanjangan_nilai_index_lokasi);
            /*-------------------------------------------------------------------------------------------------------------------*/

            <?php if($penetapan->ho_perpanjangan_status_perubahan == 1): ?>
            /*-------------------------------------------------------------------------------------------------------------------*/
            $('#ho_perpanjangan_kode_index_lokasi_').change(function(){
                $('#ho_perpanjangan_kode_index_lokasi').val($('#ho_perpanjangan_kode_index_lokasi_ > option:selected').attr('value'));
                var ho_perpanjangan_nilai_index_lokasi = $('#ho_perpanjangan_kode_index_lokasi_ > option:selected').attr('nilai_index_lokasi');
                console.log(ho_perpanjangan_nilai_index_lokasi);
                $('#ho_perpanjangan_nilai_index_lokasi').val(ho_perpanjangan_nilai_index_lokasi);
            });
            /*-------------------------------------------------------------------------------------------------------------------*/
            <?php endif; ?>
        });
    </script>
    
    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_perpanjangan_nilai_index_lokasi" id="ho_perpanjangan_nilai_index_lokasi">
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Harga Dasar</label>
    <div class="col-sm-4">
        <select <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> class="form-control input-sm" name="ho_perpanjangan_kode_index_harga_dasar_" id="ho_perpanjangan_kode_index_harga_dasar_">
            <option></option>
            <?php if($index_harga_dasar): foreach($index_harga_dasar as $r_index_harga_dasar): ?>
                <option <?php echo ($data_lalu->kode_index_harga_dasar == $r_index_harga_dasar->kode_index_harga_dasar) ? 'selected=""' : ''; ?> value="<?php echo $r_index_harga_dasar->kode_index_harga_dasar ?>" nilai_index_harga_dasar="<?php echo $r_index_harga_dasar->nilai_index_harga_dasar ?>"><?php echo $r_index_harga_dasar->nama_index_harga_dasar ?></option>
            <?php endforeach; endif; ?>
        </select>

        <input <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> type="hidden" name="ho_perpanjangan_kode_index_harga_dasar" id="ho_perpanjangan_kode_index_harga_dasar">
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            /*-----------------------------------------------------------------------------------------------------------------------------------*/
            $('#ho_perpanjangan_kode_index_harga_dasar').val($('#ho_perpanjangan_kode_index_harga_dasar_ > option:selected').attr('value'));
            var ho_perpanjangan_nilai_index_harga_dasar = $('#ho_perpanjangan_kode_index_harga_dasar_ > option:selected').attr('nilai_index_harga_dasar');
            console.log(ho_perpanjangan_nilai_index_harga_dasar);
            $('#ho_perpanjangan_nilai_index_harga_dasar').val(ho_perpanjangan_nilai_index_harga_dasar);
            /*-----------------------------------------------------------------------------------------------------------------------------------*/

            <?php if($penetapan->ho_perpanjangan_status_perubahan == 1): ?>
            /*-----------------------------------------------------------------------------------------------------------------------------------*/
            $('#ho_perpanjangan_kode_index_harga_dasar_').change(function(){
                $('#ho_perpanjangan_kode_index_harga_dasar').val($('#ho_perpanjangan_kode_index_harga_dasar_ > option:selected').attr('value'));
                var ho_perpanjangan_nilai_index_harga_dasar = $('#ho_perpanjangan_kode_index_harga_dasar_ > option:selected').attr('nilai_index_harga_dasar');
                console.log(ho_perpanjangan_nilai_index_harga_dasar);
                $('#ho_perpanjangan_nilai_index_harga_dasar').val(ho_perpanjangan_nilai_index_harga_dasar);
            });
            /*-----------------------------------------------------------------------------------------------------------------------------------*/
            <?php endif; ?>
        });
    </script>
    
    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_perpanjangan_nilai_index_harga_dasar" id="ho_perpanjangan_nilai_index_harga_dasar">
    </div>
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-1">
        <a class="btn btn-primary btn-xs" id="hitung" value="hitung" name="hitung">Hitung</a>
    </div>

    <script type="text/javascript">
            $(document).ready(function(){
                /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
                var ho_perpanjangan_nilai_index_lokasi      = $('#ho_perpanjangan_nilai_index_lokasi').val();
                var ho_perpanjangan_nilai_index_luas        = $('#ho_perpanjangan_nilai_index_luas').val();
                var ho_perpanjangan_nilai_index_gangguan    = $('#ho_perpanjangan_nilai_index_gangguan').val();
                var ho_perpanjangan_nilai_index_harga_dasar = $('#ho_perpanjangan_nilai_index_harga_dasar').val();

                console.log(ho_perpanjangan_nilai_index_lokasi);
                console.log(ho_perpanjangan_nilai_index_luas);
                console.log(ho_perpanjangan_nilai_index_gangguan);
                console.log(ho_perpanjangan_nilai_index_harga_dasar);

                if(ho_perpanjangan_nilai_index_lokasi == 0 || ho_perpanjangan_nilai_index_luas == 0 || ho_perpanjangan_nilai_index_gangguan == 0 || ho_perpanjangan_nilai_index_harga_dasar == 0){
                    alert('Anda belum melengkapi kriteria Perhitungan Penetepan');
                }else{
                    var nilai_retribusi         = ho_perpanjangan_nilai_index_lokasi * ho_perpanjangan_nilai_index_luas * ho_perpanjangan_nilai_index_gangguan * ho_perpanjangan_nilai_index_harga_dasar;
                    $('#ho_perpanjangan_nilai_retribusi').val(nilai_retribusi);
                }
                /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/


                /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
                $('#hitung').click(function(){
                    var ho_perpanjangan_nilai_index_lokasi      = $('#ho_perpanjangan_nilai_index_lokasi').val();
                    var ho_perpanjangan_nilai_index_luas        = $('#ho_perpanjangan_nilai_index_luas').val();
                    var ho_perpanjangan_nilai_index_gangguan    = $('#ho_perpanjangan_nilai_index_gangguan').val();
                    var ho_perpanjangan_nilai_index_harga_dasar = $('#ho_perpanjangan_nilai_index_harga_dasar').val();

                    console.log(ho_perpanjangan_nilai_index_lokasi);
                    console.log(ho_perpanjangan_nilai_index_luas);
                    console.log(ho_perpanjangan_nilai_index_gangguan);
                    console.log(ho_perpanjangan_nilai_index_harga_dasar);

                    if(ho_perpanjangan_nilai_index_lokasi == 0 || ho_perpanjangan_nilai_index_luas == 0 || ho_perpanjangan_nilai_index_gangguan == 0 || ho_perpanjangan_nilai_index_harga_dasar == 0){
                        alert('Anda belum melengkapi kriteria Perhitungan Penetepan');
                    }else{
                        var nilai_retribusi         = ho_perpanjangan_nilai_index_lokasi * ho_perpanjangan_nilai_index_luas * ho_perpanjangan_nilai_index_gangguan * ho_perpanjangan_nilai_index_harga_dasar;
                        $('#ho_perpanjangan_nilai_retribusi').val(nilai_retribusi);
                    }
                    /**
                     * input#nilai_retribusi 
                     * berada pada file : v_penetapan_utama.php
                     */
                });
                /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
            });
        </script>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nilai Retribusi</label>
    

    <div class="col-sm-4">
        <input <?php echo ($penetapan->ho_perpanjangan_status_perubahan == 1) ? '' : 'readonly=""' ?> type="text" class="form-control input-sm" name="ho_perpanjangan_nilai_retribusi" class="ho_perpanjangan_nilai_retribusi" id="ho_perpanjangan_nilai_retribusi">
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
                    


