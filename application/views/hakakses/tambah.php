<div class="container">
    <div class="col-md-12">
        <form action="<?= base_url('Hakakses/tambah/done') ?>" class="form-horizontal" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <div class="form-inline d-flex justify-content-between">
                            <input type="text" name="nama_akses" placeholder="Nama" class="form-control flex-grow-1">
                        </div>
                        <small><span class="text-danger"><?= form_error('nama_akses'); ?></span></small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Sub Menu</th>
                                <th>C</th>
                                <th>R</th>
                                <th>U</th>
                                <th>D</th>
                            </tr>
                        </thead>

                        <?php foreach ($menus as $menu) : ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?= $menu['nama_menu']; ?>
                                    </td>
                                    <td>

                                        <?php foreach ($subMenus as $p => $subMenu) :  ?>
                                            <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
                                                <span>
                                                    <?= $subMenu['nama_sub_menu']; ?> <br>
                                                </span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <?php foreach ($subMenus as $subMenu) : $menu_id = $this->db->get_where('menu', ['id' => $subMenu['id_menu']])->row(); ?>
                                            <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
                                                <input type="checkbox" name="<?= $menu_id->id . '_' . $subMenu['id'] . 'tambah[]'; ?>" class="form-control size-check">
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </td>
                                    <td>
                                        <?php foreach ($subMenus as $subMenu) : $menu_id = $this->db->get_where('menu', ['id' => $subMenu['id_menu']])->row(); ?>
                                            <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
                                                <input type="checkbox" name="<?= $menu_id->id . '_' . $subMenu['id'] . 'akses[]' ?>" class="form-control size-check">
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </td>
                                    <td>
                                        <?php foreach ($subMenus as $subMenu) : $menu_id = $this->db->get_where('menu', ['id' => $subMenu['id_menu']])->row(); ?>
                                            <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
                                                <input type="checkbox" name="<?= $menu_id->id . '_' . $subMenu['id'] . 'update[]' ?>" class="form-control size-check">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>

                                        <?php foreach ($subMenus as $subMenu) : $menu_id = $this->db->get_where('menu', ['id' => $subMenu['id_menu']])->row(); ?>
                                            <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
                                                <input type="checkbox" name="delete" class="form-control size-check">
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                        <!-- //submenu -->

                                        <!-- //line 61 -->
                                    </td>
                                <?php endforeach; ?>
                                </tr>
                            </tbody>
                            <!-- line54 -->

                    </table>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="role" id="role" class="form-control">
                            <option value="">Pilih Role ID</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary mb-2">Tambah Data</button>
            <a href="<?= base_url('users'); ?>" class="btn btn-success mb-2">Kembali</a>
        </form>
    </div>
</div>