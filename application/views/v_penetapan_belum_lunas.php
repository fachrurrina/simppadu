

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Penetapan
            <small>Belum Lunas</small>
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
                            <li><a href="<?php echo site_url('c_penetapan/belum'); ?>">belum</a></li>
                            <li class="active"><a href="<?php echo site_url('c_penetapan/belum_lunas'); ?>">belum lunas</a></li>
                            <li><a href="<?php echo base_url('c_penetapan/sudah_lunas'); ?>">Sudah lunas</a></li>
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
                                <?php if($belum_lunas): foreach ($belum_lunas as $r_belum_lunas): ?>
                                <tr>
                                    <td>
                                        <form action="" method="post">
                                            <a href="<?php echo site_url('c_penetapan/cetak_ssrd/'. $r_belum_lunas->no_daftar); ?>" class="btn btn-primary btn-xs">Cetak SSRD</a>
                                            <a href="<?php echo site_url('c_penetapan/lunaskan/'. $r_belum_lunas->no_daftar); ?>" class="btn btn-primary btn-xs">Lunaskan</a>
                                            <a href="<?php echo site_url('c_penetapan/batalkan_penetapan/'. $r_belum_lunas->no_daftar); ?>" class="btn btn-primary btn-xs">Batalkan Penetapan</a>
                                        </form>
                                        
                                    </td>
                                    <td><?php echo $r_belum_lunas->no_daftar; ?></td>
                                    <td><?php echo $r_belum_lunas->tanggal_daftar; ?></td>
                                    <td><?php echo $r_belum_lunas->nama_pemohon; ?></td>
                                    <td><?php echo $this->m_sub_modul->get_nama_sub_modul($r_belum_lunas->id_sub_modul); ?></td>
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


