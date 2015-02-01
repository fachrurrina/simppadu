
<div class="container">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Master Syarat (Tambah)</h4>
            </div>
         

            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li><a href="<?php echo site_url('c_syarat/listing'); ?>">Listing</a></li>
                    <li class="active"><a href="<?php echo site_url('c_syarat/tambah'); ?>">Tambah</a></li>
                </ul>
            </div>

            <div class="panel-body">

                <?php echo validation_errors('<p>', '</p>'); ?>
                
                <form class="form-horizontal" role="form" method="post" action="">
                    <div id="form-utama">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Modul</label>
                            <div class="col-sm-4">
                                <select class="form-control input-sm" name="id_modul" id="id_modul">
                                    <option></option>
                                    <?php foreach ($modul as $r_modul): ?>
                                        <option value="<?php echo $r_modul->id_modul; ?>"><?php echo $r_modul->nama_modul; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#id_modul').change(function() {

                                    var id_modul = $('#id_modul').val();

                                    console.log('berhasil');

                                    $.ajax({
                                        url: '<?php echo site_url("c_syarat/get_where_id_modul") ?>/' + id_modul,
                                        success: function(data) {
                                            $('#id_sub_modul').html(data);
                                        }
                                    });

                                });
                            });
                        </script>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sub Modul</label>
                            <div class="col-sm-4">
                                <select class="form-control input-sm" name="id_sub_modul" id="id_sub_modul">
                                    <!-- isi dari combo sub modul akan di load dari ajax -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Syarat</label>
                            <div class="col-sm-7">
                                <textarea name="nama_syarat" id="nama_syarat" class="form-control input-sm" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <!-- <a id="lanjutkan" class="btn btn-primary btn-sm">Lanjutkan</a> -->
                                <input type="submit" class="btn btn-primary btn-sm" value="Simpan" name="simpan">
                            </div>
                        </div>
                        
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
