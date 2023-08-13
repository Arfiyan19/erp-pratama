<?php
// echo json_encode($overrides);
?>
<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$judul; ?></h6>
        </div>
        <div class="card-body">
        <div class="table-responsive table table-hover">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Kantor</th>
                        <th>Summary</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($overrides):
                        $no=1;
                        foreach($overrides as $override) {
                        ?>
                        <tr>
                            <td><?=$no;?>.</td>
                            <td><?=$override['nama']; ?></td>
                            <td><?=$override['kantor']; ?></td>
                            <td><?=$override['summary']; ?></td>
                            <td><?=$override['total_saving']; ?></td>
                        </tr>
                        <?php
                            $no++;
                        }
                    endif; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>

</section> 
</div>