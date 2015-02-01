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
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-5">
        <input value="<?php echo $data_lalu->nama_pemilik ?>" type="text" class="form-control input-sm" name="ho_perpanjangan_nama_pemilik" id="ho_perpanjangan_nama_pemilik" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-5">
        <input value="<?php echo $data_lalu->nama_perusahaan ?>" type="text" class="form-control input-sm" name="ho_perpanjangan_nama_perusahaan" id="ho_perpanjangan_nama_perusahaan" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select class="form-control input-sm" name="ho_perpanjangan_id_bentuk_perusahaan" id="ho_perpanjangan_id_bentuk_perusahaan">
            <option></option>
            <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                <option <?php echo ($data_lalu->id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : '' ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea name="ho_perpanjangan_alamat_perusahaan" id="ho_perpanjangan_alamat_perusahaan" class="form-control input-sm"><?php echo $data_lalu->alamat_perusahaan ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-4">
        <select name="ho_perpanjangan_id_kec_perusahaan" id="ho_perpanjangan_id_kec_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($data_lalu->id_kec_perusahaan == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#ho_perpanjangan_id_kec_perusahaan').change(function(){

            var ho_perpanjangan_id_kec_perusahaan = $('#ho_perpanjangan_id_kec_perusahaan').val();

            console.log(ho_perpanjangan_id_kec_perusahaan);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + ho_perpanjangan_id_kec_perusahaan,
                success: function(data) {

                    $('#ho_perpanjangan_id_kel_perusahaan').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong Perusahaan</label>
    <div class="col-sm-4">
        <select name="ho_perpanjangan_id_kel_perusahaan" id="ho_perpanjangan_id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($data_lalu->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
    <div class="col-sm-7">
        <input value="<?php echo $data_lalu->nama_bidang_usaha ?>" type="text" class="form-control input-sm" name="ho_perpanjangan_nama_bidang_usaha" id="ho_perpanjangan_nama_bidang_usaha">
    </div>
</div>

<div class="form-group">

    <label for="inputEmail3" class="col-sm-2 control-label">Luas Tempat Usaha (p x l)</label>
    <div class="col-sm-10">
        
        <table class="table" style="margin-bottom: 2px;" id="table-luas">
            <tbody>
                <?php  
                $array_ket_luas_tempat_usaha = explode('|', $data_lalu->ket_luas_tempat_usaha);
                $array_panjang_tempat_usaha  = explode('|', $data_lalu->panjang_tempat_usaha);
                $array_lebar_tempat_usaha    = explode('|', $data_lalu->lebar_tempat_usaha);

                /*echo "<pre>";
                print_r($array_ket_luas_tempat_usaha);
                print_r($array_panjang_tempat_usaha);
                print_r($array_lebar_tempat_usaha);
                echo "</pre>";*/
                ?>

                <?php for($i = 0; $i < count($array_ket_luas_tempat_usaha); $i++): ?>
                <tr>
                    <td><input value="<?php echo $array_ket_luas_tempat_usaha[$i] ?>" type="text" class="ho_perpanjangan_ket_luas_tempat_usaha form-control input-sm" name="ho_perpanjangan_ket_luas_tempat_usaha[]" id="ho_perpanjangan_ket_luas_tempat_usaha[]" /></td>
                    <td><input value="<?php echo $array_panjang_tempat_usaha[$i] ?>" type="number" class="ho_perpanjangan_panjang_tempat_usaha form-control input-sm" name="ho_perpanjangan_panjang_tempat_usaha[]" id="ho_perpanjangan_panjang_tempat_usaha[]" /></td>
                    <td><input value="<?php echo $array_lebar_tempat_usaha[$i] ?>" type="number" class="ho_perpanjangan_lebar_tempat_usaha form-control input-sm" name="ho_perpanjangan_lebar_tempat_usaha[]" id="ho_perpanjangan_lebar_tempat_usaha[]" /></td>
                    <td><a class="hapus btn btn-danger btn-xs">Hapus</a></td>
                </tr>
                <?php endfor; ?>
            </tbody>
            <tfoot>
                
                <tr>
                    <td>Sub Total :</td>
                    <td><input readonly="" value="" type="number" class="form-control input-sm" name="ho_perpanjangan_panjang_tempat_usaha_total" id="ho_perpanjangan_panjang_tempat_usaha_total" /></td>
                    <td><input readonly="" value="" type="number" class="form-control input-sm" name="ho_perpanjangan_lebar_tempat_usaha_total" id="ho_perpanjangan_lebar_tempat_usaha_total" /></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Total Luas Tempat Usaha :</td>
                    <td></td>
                    <td><input readonly="" value="" type="number" class="form-control input-sm" name="ho_perpanjangan_luas_tempat_usaha" id="ho_perpanjangan_luas_tempat_usaha" /></td>
                    <td></td>
                </tr>

                <tr>
                    <td>Nilai Index Luas Bangunan : </td>
                    <td></td>
                    <td><input readonly="" value="" type="number" class="form-control input-sm" name="ho_perpanjangan_nilai_index_luas" id="ho_perpanjangan_nilai_index_luas" /></td>
                    <td></td>
                </tr>
                <input type="hidden" name="ho_perpanjangan_kode_index_luas" id="ho_perpanjangan_kode_index_luas">
            </tfoot>
        </table>

       

        <a onclick="tambah();" class="btn btn-primary btn-xs" id="tambah">Tambah</a>
        
        <script>
        function tambah(){
                
                var clone = $('#table-luas > tbody > tr').first().clone(true);
                clone.appendTo('#table-luas > tbody');

                $('.hapus').bind("click", hapus);

                jumlahkan();
            
        }

        function hapus(){
            
            var tbodyChild = $(this).parent().parent().parent().children().length;

            if(tbodyChild !== 1){
                var par = $(this).parent().parent(); //tr    
                par.remove();
                jumlahkan();
            }else{
                alert('Minimal harus ada satu!');
                return;
            }
        }

        function isInt(value) {
            var x = parseFloat(value);
            return !isNaN(value) && (x | 0) === x;
        }

        function jumlahkan(){

            var sum_panjang = 0;
            $('.ho_perpanjangan_panjang_tempat_usaha').each(function(){
                if(isInt(this.value)){
                    sum_panjang += parseInt(this.value); 
                }else{
                    sum_panjang += 0;
                }
            });

            $('#ho_perpanjangan_panjang_tempat_usaha_total').val(sum_panjang);

            var sum_lebar = 0;
            $('.ho_perpanjangan_lebar_tempat_usaha').each(function(){
                if(isInt(this.value)){
                    sum_lebar += parseInt(this.value); 
                }else{
                    sum_lebar += 0;
                }
            });

            $('#ho_perpanjangan_lebar_tempat_usaha_total').val(sum_lebar);

            $('#ho_perpanjangan_luas_tempat_usaha').val(sum_panjang * sum_lebar);

            var ho_perpanjangan_luas_tempat_usaha = sum_panjang * sum_lebar;

            <?php $result = $this->db->get('t_index_luas')->result(); ?>

            <?php if($result): foreach($result as $r): ?>
                if(ho_perpanjangan_luas_tempat_usaha > <?php echo $r->minimal ?> && ho_perpanjangan_luas_tempat_usaha <= <?php echo $r->maximal ?>){
                    var ho_perpanjangan_nilai_index_luas = <?php echo $r->nilai_index_luas ?>;
                    var ho_perpanjangan_kode_index_luas = <?php echo $r->kode_index_luas ?>;
                }
            <?php endforeach; endif; ?>

            $('#ho_perpanjangan_nilai_index_luas').val(ho_perpanjangan_nilai_index_luas);
            $('#ho_perpanjangan_kode_index_luas').val(ho_perpanjangan_kode_index_luas);
            

                
        }

        $('.ho_perpanjangan_panjang_tempat_usaha').change(function(){
            jumlahkan();
        }); 

        $('.ho_perpanjangan_lebar_tempat_usaha').change(function(){
            jumlahkan();
        }); 


        $(document).ready(function(){
            jumlahkan();
            $('.hapus').bind("click", hapus);
        })
        
        </script>
        

        
    </div>
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tinggi Tower</label>
    <div class="col-sm-4">
        <input value="<?php echo $data_lalu->tinggi_tower ?>" readonly="" type="number" class="form-control input-sm" name="ho_perpanjangan_tinggi_tower" id="ho_perpanjangan_tinggi_tower">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
        <label>
            <input checked="" type="checkbox" name="jenis_tower" value="1" id="jenis_tower" /> Centang jika Izin HO adalah jenis Tower
        </label>
        <br />

        <script type="text/javascript">
        $('#jenis_tower').click(function(){
            if($(this).is(':checked')){
                
                $('#ho_perpanjangan_tinggi_tower').removeAttr('readonly');
                $('#ho_perpanjangan_tinggi_tower').val(0);
            }else{
                $('#ho_perpanjangan_tinggi_tower').attr('readonly', '');
                $('#ho_perpanjangan_tinggi_tower').val(0);
            }
        });

        $(document).ready(function(){
            <?php if($data_lalu->tinggi_tower == 0): ?>
                $('#ho_perpanjangan_tinggi_tower').attr('readonly', '');
                $('#jenis_tower').removeAttr('checked');
                $('#ho_perpanjangan_tinggi_tower').val(0);
            <?php endif; ?>
        });
            
        </script>
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Gangguan</label>
    <div class="col-sm-4">
        
        <select class="form-control input-sm" name="ho_perpanjangan_kode_index_gangguan" id="ho_perpanjangan_kode_index_gangguan">
            <option></option>
            <?php if($index_gangguan): foreach($index_gangguan as $r_index_gangguan): ?>
                <option <?php echo ($data_lalu->kode_index_gangguan == $r_index_gangguan->kode_index_gangguan) ? 'selected=""' : '' ?> value="<?php echo $r_index_gangguan->kode_index_gangguan ?>" nilai_index_gangguan="<?php echo $r_index_gangguan->nilai_index_gangguan; ?>"><?php echo $r_index_gangguan->nama_index_gangguan ?></option>
            <?php endforeach; endif; ?>
        </select>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#ho_perpanjangan_kode_index_gangguan').change(function(){
                var ho_perpanjangan_nilai_index_gangguan = $('#ho_perpanjangan_kode_index_gangguan > option:selected').attr('nilai_index_gangguan');
                console.log(ho_perpanjangan_nilai_index_gangguan);
                $('#ho_perpanjangan_nilai_index_gangguan').val(ho_perpanjangan_nilai_index_gangguan);
            });

            var ho_perpanjangan_nilai_index_gangguan = $('#ho_perpanjangan_kode_index_gangguan > option:selected').attr('nilai_index_gangguan');
            console.log(ho_perpanjangan_nilai_index_gangguan);
            $('#ho_perpanjangan_nilai_index_gangguan').val(ho_perpanjangan_nilai_index_gangguan);

        })
    </script>

    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_perpanjangan_nilai_index_gangguan" id="ho_perpanjangan_nilai_index_gangguan">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Lokasi</label>
    <div class="col-sm-4">
        <select class="form-control input-sm" name="ho_perpanjangan_kode_index_lokasi" id="ho_perpanjangan_kode_index_lokasi">
            <option></option>
            <?php if($index_lokasi): foreach($index_lokasi as $r_index_lokasi): ?>
                <option <?php echo ($data_lalu->kode_index_lokasi == $r_index_lokasi->kode_index_lokasi) ? 'selected=""' : '' ?> value="<?php echo $r_index_lokasi->kode_index_lokasi ?>" nilai_index_lokasi="<?php echo $r_index_lokasi->nilai_index_lokasi ?>"><?php echo $r_index_lokasi->nama_index_lokasi ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#ho_perpanjangan_kode_index_lokasi').change(function(){
                var ho_perpanjangan_nilai_index_lokasi = $('#ho_perpanjangan_kode_index_lokasi > option:selected').attr('nilai_index_lokasi');
                console.log(ho_perpanjangan_nilai_index_lokasi);
                $('#ho_perpanjangan_nilai_index_lokasi').val(ho_perpanjangan_nilai_index_lokasi);
            });

            var ho_perpanjangan_nilai_index_lokasi = $('#ho_perpanjangan_kode_index_lokasi > option:selected').attr('nilai_index_lokasi');
            console.log(ho_perpanjangan_nilai_index_lokasi);
            $('#ho_perpanjangan_nilai_index_lokasi').val(ho_perpanjangan_nilai_index_lokasi);
        })
    </script>
    
    <div class="col-sm-1">
        <input type="text" readonly="" class="form-control input-sm" name="ho_perpanjangan_nilai_index_lokasi" id="ho_perpanjangan_nilai_index_lokasi">
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Indeks Harga Dasar</label>
    <div class="col-sm-4">
        <select class="form-control input-sm" name="ho_perpanjangan_kode_index_harga_dasar" id="ho_perpanjangan_kode_index_harga_dasar">
            <option></option>
            <?php if($index_harga_dasar): foreach($index_harga_dasar as $r_index_harga_dasar): ?>
                <option <?php echo ($data_lalu->kode_index_harga_dasar == $r_index_harga_dasar->kode_index_harga_dasar) ? 'selected=""' : '' ?> value="<?php echo $r_index_harga_dasar->kode_index_harga_dasar ?>" nilai_index_harga_dasar="<?php echo $r_index_harga_dasar->nilai_index_harga_dasar ?>"><?php echo $r_index_harga_dasar->nama_index_harga_dasar ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#ho_perpanjangan_kode_index_harga_dasar').change(function(){
                var ho_perpanjangan_nilai_index_harga_dasar = $('#ho_perpanjangan_kode_index_harga_dasar > option:selected').attr('nilai_index_harga_dasar');
                console.log(ho_perpanjangan_nilai_index_harga_dasar);
                $('#ho_perpanjangan_nilai_index_harga_dasar').val(ho_perpanjangan_nilai_index_harga_dasar);
            });

            var ho_perpanjangan_nilai_index_harga_dasar = $('#ho_perpanjangan_kode_index_harga_dasar > option:selected').attr('nilai_index_harga_dasar');
            console.log(ho_perpanjangan_nilai_index_harga_dasar);
            $('#ho_perpanjangan_nilai_index_harga_dasar').val(ho_perpanjangan_nilai_index_harga_dasar);
        })
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
                });

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
            });
        </script>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nilai Retribusi</label>
    

    <div class="col-sm-4">
        <input type="text" class="form-control input-sm" name="ho_perpanjangan_nilai_retribusi" class="ho_perpanjangan_nilai_retribusi" id="ho_perpanjangan_nilai_retribusi">
    </div>
</div>
                    
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Peninjauan Lapangan</label>
    <div class="col-sm-3">
        <input value="<?php echo $data_lalu->tanggal_peninjauan_lapangan ?>" type="date" class="form-control input-sm" name="ho_perpanjangan_tanggal_peninjauan_lapangan" id="ho_perpanjangan_tanggal_peninjauan_lapangan" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        
        <input type="submit" class="btn btn-primary btn-xs" value="tetapkan" name="tetapkan">

        <script type="text/javascript">
            $("#tetapkan").click(function(event){
                var ho_perpanjangan_nilai_retribusi      = $('#ho_perpanjangan_nilai_retribusi').val();
                
                if(ho_perpanjangan_nilai_retribusi){
                    event.preventDefault(); // cancel default behavior
                    alert('Anda belum melengkapi kriteria Perhitungan Penetepan');
                    
                }
                
              });
        </script>
    </div>
</div>
                    

<script type="text/javascript">
   $(document).ready(function(){
        $('#containerForm').bootstrapValidator({
            container: 'tooltip',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'ho_perpanjangan_tanggal_peninjauan_lapangan': {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Peninjauan Lapangan harus diisi'
                        }
                    }
                },
                'ho_perpanjangan_id_kec_pemilik': {
                    validators: {
                        notEmpty: {
                            message: 'Kecamatan Pemilik harus dipilih'
                        }
                    }
                },
                'ho_perpanjangan_id_kel_pemilik': {
                    validators: {
                        notEmpty: {
                            message: 'Gampong Pemilik harus dipilih'
                        }
                    }
                },
                'ho_perpanjangan_nama_bidang_usaha': {
                    validators: {
                        notEmpty: {
                            message: 'Nama Bidang Usaha harus diisi'
                        }
                    }
                },
                'ho_perpanjangan_ket_luas_tempat_usaha[]': {
                    validators: {
                        notEmpty: {
                            message: 'Keterangan Luas Tempat Usaha Tidak Boleh Kosong'
                        }
                    }
                },
                'ho_perpanjangan_panjang_tempat_usaha[]': {
                    validators: {
                        notEmpty: {
                            message: 'Tidak Boleh Kosong'
                        },
                        greaterThan: {
                            inclusive: false,
                            value: 0,
                            message: 'Tidak Boleh 0 (Nol)'
                        }
                    }
                },
                'ho_perpanjangan_lebar_tempat_usaha[]': {
                    validators: {
                        notEmpty: {
                            message: 'Tidak Boleh Kosong'
                        },
                        greaterThan: {
                            inclusive: false,
                            value: 0,
                            message: 'Tidak Boleh 0 (Nol)'
                        }
                    }
                },
                'ho_perpanjangan_kode_index_gangguan': {
                    validators: {
                        notEmpty: {
                            message: 'harus dipilih'
                        }
                    }
                },
                'ho_perpanjangan_kode_index_lokasi': {
                    validators: {
                        notEmpty: {
                            message: 'harus dipilih'
                        }
                    }
                },
                'ho_perpanjangan_kode_index_harga_dasar': {
                    validators: {
                        notEmpty: {
                            message: 'harus dipilih'
                        }
                    }
                }


                
                
            }
        });
    });
</script>
