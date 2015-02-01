<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Front Office
            <small>Di Tolak Verifikasi I</small>
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
                            <li><a href="<?php echo site_url('c_fo/daftar_1'); ?>">Input Penerimaan</a></li>
                            <li><a href="<?php echo base_url('c_fo/tertunda'); ?>">Tertunda</a></li>
                            <li class="active"><a href="<?php echo site_url('c_fo/tolak'); ?>">Ditolak</a></li>
                            <li><a href="<?php echo site_url('c_fo/dalam_proses'); ?>">Dalam Proses</a></li>
                            <li><a href="<?php echo site_url('c_fo/selesai'); ?>">Selesai</a></li>
                        </ul>
                    </div>

                    <div class="panel-body">



                        <table class="table table-striped table-condensed datatable">
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
                                <?php if($tolak): foreach ($tolak as $r_tolak): ?>
                                <tr>
                                    <td>
                                        <form action="" method="post">
                                            <a href="<?php echo site_url('c_fo/edit_tolak/'. $r_tolak->no_daftar); ?>" class="btn btn-primary btn-xs">Edit</a>
                                        </form>
                                        
                                    </td>
                                    <td><?php echo $r_tolak->no_daftar; ?></td>
                                    <td><?php echo $r_tolak->tanggal_daftar; ?></td>
                                    <td><?php echo $r_tolak->nama_pemohon; ?></td>
                                    <td><?php echo $this->m_sub_modul->get_nama_sub_modul($r_tolak->id_sub_modul); ?></td>
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



