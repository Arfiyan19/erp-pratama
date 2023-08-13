<form action="<?php echo site_url('hakakses/'); ?>simpan" method="post">
    <div class="modal fade" class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Hak Akses
                        <?php $i = 1; ?>
                        <?php foreach ($list_user as $usr) : ?>
                            <tr>
                                <td width="">
                                    <?php echo $usr['name'] ?>
                                </td>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                            </h3>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
                        <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: small;">

                            <thead>
                                <tr style="text-align:center">
                                    <th>Nama Sub Menu</th>
                                    <th>C</th>
                                    <th>R</th>
                                    <th>U</th>
                                    <th>D</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <input type="hidden" name="id_role" value="<?= $this->input->post('id_role')  ?>">
                                <?php
                                function input($no, $aktif, $jenis)
                                {
                                    return '<td>
                                        <input type="checkbox" name="' . $jenis . $no . '" value="1" ' . ($aktif == 1 ? 'checked' : '') . '></td>';
                                }
                                ?>

                                <?php $i = 0; ?>
                                <?php foreach ($list_menu as $lm) : ?>
                                    <?php
                                    echo '<tr>';
                                    echo '<td>' . $lm['nama_sub_menu'] . $i . '</td>';
                                    echo input($i, $lm['tambah'], 'tambah');
                                    echo input($i, $lm['akses'], 'akses');
                                    echo input($i, $lm['update'], 'update');
                                    echo input($i, $lm['delete'], 'delete');
                                    echo '</tr>';
                                    ?>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>