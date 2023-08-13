<div class="content-wrapper col-12">
    <section class="content-header ml my-2 auto">

        <div style="margin-left:5px">

            <div class="">
                <?php if ($this->session->flashdata('flash2')) : ?>
                    <div class="row mt-3">
                        <div class="col md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Role Akses <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="row mt-3">
                        <div class="col md-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">Data Role Akses <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <a href="<?= base_url('roleakses/tambah'); ?>" class="btn btn-primary mb-2 mt-2">Tambah Data </a>
                <div class="table-responsive pt-2 pr-2">
                    <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
                    <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="" style="font-size: 12px;">

                        <thead>
                            <tr style="text-align: center;">
                                <th>No.</th>
                                <th>Role Id</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            <?php $i = 1; ?>
                            <?php foreach ($tbl_role as $usr) : ?>
                                <tr>
                                    <td width="">
                                        <?php echo $i; ?>
                                    </td>

                                    <td style="text-align:center">
                                        <?php echo $usr['id'] ?>
                                    </td>
                                    <td width="">
                                        <?php echo $usr['name'] ?>
                                    </td>

                                    <td width="">
                                        <?php echo $usr['description'] ?>
                                    </td>

                                    <td>
                                        <a href="<?php echo base_url(); ?>roleakses/edit/<?= $usr['id']; ?>" class="btn btn-success" style="margin-left:42px"><i class="fa fa-edit"></i></i></a>
                                        <a href="<?= base_url(); ?>roleakses/hapus/<?= $usr['id']; ?>" class="btn btn-danger" style="margin-left:42px" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                $('#mytable').dataTable({
                    language: {
                        search: "",
                        searchPlaceholder: "Cari data Role Akses.."
                    },
                    bInfo: false
                });
            </script>