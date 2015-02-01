
<div class="container">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Entry SITU</h4>
            </div>
         

            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li><a href="<?php echo site_url('c_entry/situ_entry'); ?>">Entry</a></li>
                    <li class="active"><a href="<?php echo site_url('c_entry/situ_listing'); ?>">Listing</a></li>
                </ul>
            </div>

            <div class="panel-body">

                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>no_sk</th>
                            <th>ket</th>
                            <th>nama_pemilik</th>
                            <th>npwpd_npwprd</th>
                            <th>nama_perusahaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($all_situ): foreach ($all_situ as $row_situ): ?>
                            <tr>
                                <td>
                                    <form action="" method="post">
                                        <a href="<?php echo site_url('c_entry/situ_edit/'. $row_situ->no_urut); ?>" class="btn btn-primary btn-xs">Edit</a>
                                    </form>
                                </td>
                                <td><?php echo $row_situ->no_sk; ?></td>
                                <td><?php echo $row_situ->ket; ?></td>
                                <td><?php echo $row_situ->nama_pemilik; ?></td>
                                <td><?php echo $row_situ->npwpd_npwrd; ?></td>
                                <td><?php echo $row_situ->nama_perusahaan ?></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td colspan="6">Belum ada penerimaan berkas</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
