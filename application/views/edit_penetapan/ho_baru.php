<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $penetapan->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $penetapan->tanggal_daftar ; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<hr>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
    <div class="col-sm-7">
        <select class="form-control input-sm" name="ho_baru_id_bidang" id="ho_baru_id_bidang" >
            <option></option>
            <?php if($bidang_ho): foreach($bidang_ho as $r_bidang_ho): ?>
                <option <?php echo ($penetapan->ho_baru_id_bidang == $r_bidang_ho->id_bidang_ho) ? 'selected=""' : ''; ?> value="<?php echo $r_bidang_ho->id_bidang_ho ?>"><?php echo $r_bidang_ho->nama_bidang_ho ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Luas Tempat Usaha (p x l)</label>
    <div class="col-sm-2">
        <input value="<?php echo $penetapan->ho_baru_panjang_tempat_usaha ?>" type="number" class="form-control input-sm" name="ho_baru_panjang_tempat_usaha" id="ho_baru_panjang_tempat_usaha" />
    </div>

    <div class="col-sm-2">
        <input value="<?php echo $penetapan->ho_baru_lebar_tempat_usaha ?>" type="number" class="form-control input-sm" name="ho_baru_lebar_tempat_usaha" id="ho_baru_lebar_tempat_usaha" />
    </div>
    
    

    <script type="text/javascript">
        $(document).ready(function(){
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


            $('#ho_baru_panjang_tempat_usaha').change(function(){

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
            });
        });
    </script>

    <div class="col-sm-1">
        <input type="text" readonly=""  class="form-control input-sm" name="ho_baru_nilai_index_luas" id="ho_baru_nilai_index_luas">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Gangguan</label>
    <div class="col-sm-4">
        
        <select class="form-control input-sm" name="ho_baru_kode_index_gangguan" id="ho_baru_kode_index_gangguan">
            <option></option>
            <?php if($index_gangguan): foreach($index_gangguan as $r_index_gangguan): ?>
                <option <?php echo ($penetapan->ho_baru_kode_index_gangguan == $r_index_gangguan->kode_index_gangguan) ? 'selected=""' : ''; ?> value="<?php echo $r_index_gangguan->kode_index_gangguan ?>" nilai_index_gangguan="<?php echo $r_index_gangguan->nilai_index_gangguan; ?>"><?php echo $r_index_gangguan->nama_index_gangguan ?></option>
            <?php endforeach; endif; ?>
        </select>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            var ho_baru_nilai_index_gangguan = $('#ho_baru_kode_index_gangguan > option:selected').attr('nilai_index_gangguan');
            console.log(ho_baru_nilai_index_gangguan);
            $('#ho_baru_nilai_index_gangguan').val(ho_baru_nilai_index_gangguan);

            $('#ho_baru_kode_index_gangguan').change(function(){
                var ho_baru_nilai_index_gangguan = $('#ho_baru_kode_index_gangguan > option:selected').attr('nilai_index_gangguan');
                console.log(ho_baru_nilai_index_gangguan);
                $('#ho_baru_nilai_index_gangguan').val(ho_baru_nilai_index_gangguan);
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
                <option <?php echo ($penetapan->ho_baru_kode_index_lokasi == $r_index_lokasi->kode_index_lokasi) ? 'selected=""' : ''; ?> value="<?php echo $r_index_lokasi->kode_index_lokasi ?>" nilai_index_lokasi="<?php echo $r_index_lokasi->nilai_index_lokasi ?>"><?php echo $r_index_lokasi->nama_index_lokasi ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            var ho_baru_nilai_index_lokasi = $('#ho_baru_kode_index_lokasi > option:selected').attr('nilai_index_lokasi');
            console.log(ho_baru_nilai_index_lokasi);
            $('#ho_baru_nilai_index_lokasi').val(ho_baru_nilai_index_lokasi);

            $('#ho_baru_kode_index_lokasi').change(function(){
                var ho_baru_nilai_index_lokasi = $('#ho_baru_kode_index_lokasi > option:selected').attr('nilai_index_lokasi');
                console.log(ho_baru_nilai_index_lokasi);
                $('#ho_baru_nilai_index_lokasi').val(ho_baru_nilai_index_lokasi);
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
                <option <?php echo ($penetapan->ho_baru_kode_index_harga_dasar = $r_index_harga_dasar->kode_index_harga_dasar) ? 'selected=""' : ''; ?> value="<?php echo $r_index_harga_dasar->kode_index_harga_dasar ?>" nilai_index_harga_dasar="<?php echo $r_index_harga_dasar->nilai_index_harga_dasar ?>"><?php echo $r_index_harga_dasar->nama_index_harga_dasar ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            var ho_baru_nilai_index_harga_dasar = $('#ho_baru_kode_index_harga_dasar > option:selected').attr('nilai_index_harga_dasar');
            console.log(ho_baru_nilai_index_harga_dasar);
            $('#ho_baru_nilai_index_harga_dasar').val(ho_baru_nilai_index_harga_dasar);

            $('#ho_baru_kode_index_harga_dasar').change(function(){
                var ho_baru_nilai_index_harga_dasar = $('#ho_baru_kode_index_harga_dasar > option:selected').attr('nilai_index_harga_dasar');
                console.log(ho_baru_nilai_index_harga_dasar);
                $('#ho_baru_nilai_index_harga_dasar').val(ho_baru_nilai_index_harga_dasar);
            });
        })
    </script>
    
    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_baru_nilai_index_harga_dasar" id="ho_baru_nilai_index_harga_dasar">
    </div>
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-1">
        <a class="btn btn-primary btn-xs" id="hitung" value="hitung" name="hitung">Hitung Ulang</a>
    </div>

    <script type="text/javascript">
            $(document).ready(function(){
                $('#hitung').click(function(){
                    var ho_baru_nilai_index_lokasi      = $('#ho_baru_nilai_index_lokasi').val();
                    var ho_baru_nilai_index_luas        = $('#ho_baru_nilai_index_luas').val();
                    var ho_baru_nilai_index_gangguan    = $('#ho_baru_nilai_index_gangguan').val();
                    var ho_baru_nilai_index_harga_dasar = $('#ho_baru_nilai_index_harga_dasar').val();

                    console.log(ho_baru_nilai_index_lokasi);
                    console.log(ho_baru_nilai_index_luas);
                    console.log(ho_baru_nilai_index_gangguan);
                    console.log(ho_baru_nilai_index_harga_dasar);

                    if(ho_baru_nilai_index_lokasi == 0 || ho_baru_nilai_index_luas == 0 || ho_baru_nilai_index_gangguan == 0 || ho_baru_nilai_index_harga_dasar == 0){
                        alert('Anda belum melengkapi kriteria Perhitungan Penetepan');
                    }else{
                        var nilai_retribusi         = ho_baru_nilai_index_lokasi * ho_baru_nilai_index_luas * ho_baru_nilai_index_gangguan * ho_baru_nilai_index_harga_dasar;
                        $('#ho_baru_nilai_retribusi').val(nilai_retribusi);
                    }
                    /**
                     * input#nilai_retribusi 
                     * berada pada file : v_penetapan_utama.php
                     */
                });
            });
        </script>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nilai Retribusi</label>
    

    <div class="col-sm-4">
        <input type="text" value="<?php echo $penetapan->ho_baru_nilai_retribusi ?>" class="form-control input-sm" name="ho_baru_nilai_retribusi" class="ho_baru_nilai_retribusi" id="ho_baru_nilai_retribusi">
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
        
        <input type="submit" class="btn btn-primary btn-xs" value="Tetapkan" name="tetapkan">

    </div>
</div>
                    


