
<div class="container">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Entry SITU</h4>
            </div>
        

            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="<?php echo site_url('c_entry/situ_entry'); ?>">Entry</a></li>
                    <li><a href="<?php echo site_url('c_entry/situ_listing'); ?>">Listing</a></li>
                </ul>
            </div>

            <div class="panel-body">

                <?php echo validation_errors('<p>', '</p>'); ?>
                <form class="form-horizontal" role="form" method="get" action="<?php echo site_url('c_fo/daftar_2'); ?>">
                    <div id="form-utama">


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control input-sm" name="tanggal_daftar"  id="tanggal_daftar" value="" />
                            </div>
                        </div>
		

                        
                        <input value="0"  type="hidden" class="form-control input-sm" name="no_daftar" id="no_daftar" />
                            

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
                            <div class="col-sm-3">
                                <input  value="" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Guna</label>
                            <div class="col-sm-3">
                                <select class="form-control input-sm" name="guna" id="guna" >
                                    <option ket="B" value="BARU">BARU</option>
                                    <option ket="P" value="PERPANJANGAN">PERPANJANGAN</option>
                                    <option ket="PR" value="PERUBAHAN">PERUBAHAN</option>
                                </select>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#guna').change(function(){
                                    var ket = $('#guna  > option:selected').attr('ket');
                                    console.log(ket);
                                    $('#ket').val(ket);
                                });
                            });
                        </script>

                        <input value="" type="hidden" name="ket" id="ket" >

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Direktur / Penanggung Jawab</label>
                            <div class="col-sm-3">
                                <input value="" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nomor NPWPD/NPWRD</label>
                            <div class="col-sm-3">
                                <input value="" type="text" class="form-control input-sm" name="npwpd_npwrd" id="npwpd_npwrd" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
                            <div class="col-sm-6"><textarea name="alamat_pemilik" id="alamat_pemilik" class="form-control input-sm"></textarea></div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
                            <div class="col-sm-4">
                                <select name="id_kec_pemilik" id="id_kec_pemilik" class="form-control input-sm">
                                    <option value=""></option>
                                    <?php foreach ($kec as $r_kec): ?>
                                        <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#id_kec_pemilik').change(function(){

                                    var id_kec_pemilik = $('#id_kec_pemilik').val();

                                    console.log(id_kec_pemilik);

                                    $.ajax({
                                        url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_pemilik,
                                        success: function(data) {

                                            $('#id_kel_pemilik').html(data);
                                            
                                        }
                                    });
                                });
                            });
                        </script>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Pemilik</label>
                            <div class="col-sm-4">
                                <select name="id_kel_pemilik" id="id_kel_pemilik" class="form-control input-sm">
                                    
                                </select>
                                <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
                            <div class="col-sm-6">
                                <input value="" type="text" class="form-control input-sm" name="nama_perusahaan" id="nama_perusahaan" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
                            <div class="col-sm-3">
                                <select class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
                                    <option></option>
                                    <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                                        <option  value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
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
                            <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                            <div class="col-sm-3">
                                <input value="" type="text" class="form-control input-sm" name="no_telp" id="no_telp" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Luas Tempat Usaha (Panjang x lebar = Luas M<sup>2</sup>)</label>
                            <div class="col-sm-2">
                                <input value="0" type="number" class="form-control input-sm" name="panjang_tempat_usaha" id="panjang_tempat_usaha" />
                            </div>
                            <label for="inputEmail3" class="col-sm-1 control-label" style="text-align: center;">x</label>
                            <div class="col-sm-2">
                                <input value="0" type="number" class="form-control input-sm" name="lebar_tempat_usaha" id="lebar_tempat_usaha" />
                            </div>
                            <label for="inputEmail3" class="col-sm-1 control-label" style="text-align: center;">=</label>

                            <script type="text/javascript">
                                $('#panjang_tempat_usaha').change(function(){
                                    var panjang_tempat_usaha = $(this).val();
                                    var lebar_tempat_usaha = $('#lebar_tempat_usaha').val();
                                    $('#luas_tempat_usaha').val(panjang_tempat_usaha * lebar_tempat_usaha);
                                });
                                $('#lebar_tempat_usaha').change(function(){
                                    var lebar_tempat_usaha = $(this).val();
                                    var panjang_tempat_usaha = $('#panjang_tempat_usaha').val();
                                    $('#luas_tempat_usaha').val(panjang_tempat_usaha * lebar_tempat_usaha);
                                });
                            </script>

                            <div class="col-sm-2">
                                <input value="0" type="number" class="form-control input-sm" name="luas_tempat_usaha" id="luas_tempat_usaha" />
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Untuk Membuka / Meneruskan Usaha</label>
                            <div class="col-sm-6">
                                <!-- <input value="" type="text" class="form-control input-sm" name="membuka_meneruskan_usaha" id="membuka_meneruskan_usaha" /> -->
                                <select class="form-control input-sm" name="id_bidang_situ" id="id_bidang_situ">
                                    <option value=""></option>
                                    <?php if($bidang_situ): foreach($bidang_situ as $r_bidang_situ): ?>
                                        <option value="<?php echo $r_bidang_situ->id_bidang_situ ?>"><?php echo $r_bidang_situ->nama_bidang_situ ?></option>
                                    <?php endforeach; endif; ?>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Klasifikasi</label>
                            <div class="col-sm-3">
                                <input value="" type="text" class="form-control input-sm" name="klasifikasi" id="klasifikasi" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
                            <div class="col-sm-6"><input  value="" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
                            <div class="col-sm-6"><input  value="" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
                        </div>

                        
                        <input value="1" type="hidden" id="status_berlaku" class="status_berlaku">
                        
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <!-- <a id="lanjutkan" class="btn btn-primary btn-sm">Lanjutkan</a> -->
                                <input type="submit" class="btn btn-primary btn-sm" value="simpan" name="simpan">
                            </div>
                        </div>
                    </div>


                    
                </form>

            </div>
        </div>
    </div>
</div>


