<div class="container">
    <div class="col-md-6">
        <h2 class="">Form Tambah Data</h2>
        <form action="<?= base_url('Users/tambah') ?>" class="form-horizontal" method="POST">
            <div class="form-group">
                <label for="">Nama</label>
                <div class="form-inline d-flex justify-content-between">
                    <input type="text" name="firstname" placeholder="Nama Depan" class="form-control flex-grow-1">
                    &emsp;
                    <input type="text" name="lastname" placeholder="Nama Belakang" class="form-control flex-grow-1">
                </div>
                <small><span class="text-danger"><?=form_error('firstname');?></span></small>
                <small><span class="text-danger"><?=form_error('lastname');?></span></small>
            </div>
            
            <!-- <div class="row">
                <div class="col-md-12">
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
                        <?php foreach($menus as $menu) : ?>
                        <tbody>
                            <tr>
                                <td><?= $menu['menu']; ?></td>
                                <td>
                                    <?php foreach($subMenus as $p => $subMenu) :  ?>
                                        <?php if($menu['id'] == $subMenu['id_menu']) : ?>
                                            <span>
                                                <?= ++$p; ?> <?= $subMenu['sub_menu']; ?> <br>
                                            </span>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                                
                                <td>
                                    <?php foreach($subMenus as $subMenu) : $menu_id = $this->db->get_where('tbl_menu', ['id' => $subMenu['id_menu']])->row(); ?>                                            
                                        <?php if($menu['id'] == $subMenu['id_menu']) : ?>
                                            <input type="checkbox" name="<?= $menu_id->id.'_'.$subMenu['id'].'_create[]'; ?>" class="form-control size-check">
                                        <?php endif; ?>
                                    <?php endforeach; ?>    
                                </td>
                                <td>
                                    <?php foreach($subMenus as $subMenu) : $menu_id = $this->db->get_where('tbl_menu', ['id' => $subMenu['id_menu']])->row(); ?>           
                                        <?php if($menu['id'] == $subMenu['id_menu']) : ?>
                                            <input type="checkbox" name="<?= $menu_id->id.'_'.$subMenu['id'].'_read[]' ?>" class="form-control size-check">
                                        <?php endif; ?>
                                    <?php endforeach; ?>    
                                </td>
                                <td>
                                    <?php foreach($subMenus as $subMenu) : $menu_id = $this->db->get_where('tbl_menu', ['id' => $subMenu['id_menu']])->row(); ?>           
                                        <?php if($menu['id'] == $subMenu['id_menu']) : ?>
                                            <input type="checkbox" name="<?= $menu_id->id.'_'.$subMenu['id'].'_update[]' ?>" class="form-control size-check">
                                        <?php endif; ?>
                                    <?php endforeach; ?>    
                                </td>
                                <td>
                                    <?php foreach($subMenus as $subMenu) : $menu_id = $this->db->get_where('tbl_menu', ['id' => $subMenu['id_menu']])->row(); ?>                                            
                                        <?php if($menu['id'] == $subMenu['id_menu']) : ?>
                                            <input type="checkbox" name="<?= $menu_id->id.'_'.$subMenu['id'].'_delete[]' ?>" class="form-control size-check">
                                        <?php endif; ?>
                                    <?php endforeach; ?>    
                                </td>
                            </tr>
                        </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div> -->


            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" placeholder="Masukkan Username" class="form-control">
                <small><span class="text-danger"><?=form_error('username');?></span></small>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Masukkan Email" class="form-control">
                <small><span class="text-danger"><?=form_error('email');?></span></small>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" class="form-control">
                <small><span class="text-danger"><?=form_error('password');?></span></small>
            </div>
    		<div class="form-group">
                <label for="">Kode Id</label>
                <input type="text" name="kode_id" placeholder="Masukkan Kode Id" class="form-control">
                <small><span class="text-danger"><?=form_error('kode_id');?></span></small>
            </div>
            <div class="form-group">
                <label class="d-block" for="">Role</label>
                <select name="" id="" class="form-control">
                    <?php foreach($roles as $role): ?>
                        <option value=""><?= $role->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary mb-2">Tambah Data</button>
            <a href="<?=base_url('users');?>" class="btn btn-success mb-2">Kembali</a>
        </form>
    </div>
</div>