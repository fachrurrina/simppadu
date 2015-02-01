<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Verifikasi I
            <small>Belum Di Verifikasi</small>
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        

        <!-- Main row -->
        <div class="row">

            <div class="col-lg-12">

                <div class="panel panel-default">
                    

                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="<?php echo site_url('c_verifikasi_i/belum'); ?>">Belum</a></li>
                            <li><a href="<?php echo site_url('c_verifikasi_i/tolak'); ?>">Tolak</a></li>
                            <li><a href="<?php echo base_url('c_verifikasi_i/sudah'); ?>">Sudah</a></li>
                        </ul>
                    </div>

                    <div class="panel-body">

                        <table class="table table-striped table-condensed datatable" >
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Berkas</th>
                                    <th>Tanggal Berkas</th>
                                    <th>Nama Pemohon</th>
                                    <th>Izin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($belum): foreach ($belum as $r_belum): ?>
                                <tr>
                                    <td>
                                        <form action="" method="post">
                                            
                                            <a href="<?php echo site_url('c_verifikasi_i/verifikasi/'. $r_belum->no_daftar); ?>" class="btn btn-primary btn-xs">Proses</a>
                                            
                                        </form>
                                        
                                    </td>
                                    <td><?php echo $r_belum->no_daftar; ?></td>
                                    <td><?php echo $r_belum->tanggal_daftar; ?></td>
                                    <td><?php echo $r_belum->nama_pemohon; ?></td>
                                    <td><?php echo $this->m_sub_modul->get_nama_sub_modul($r_belum->id_sub_modul); ?></td>
                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->


