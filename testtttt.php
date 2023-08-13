roleid




line 58


<?php foreach ($subMenus as $subMenu) : $menu_id = $this->db->get_where('tbl_menu', ['id' => $subMenu['id_menu']])->row(); ?>
    <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
        <input type="checkbox" name="<?= $menu_id->id . '_' . $subMenu['id'] . '_update[]' ?>" class="form-control size-check">
    <?php endif; ?>
<?php endforeach; ?>


line 61

<?php foreach ($subMenus as $subMenu) : $menu_id = $this->db->get_where('tbl_menu', ['id' => $subMenu['id_menu']])->row(); ?>
    <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
        <input type="checkbox" name="<?= $menu_id->id . '_' . $subMenu['id'] . '_delete[]' ?>" class="form-control size-check">
    <?php endif; ?>
<?php endforeach; ?>



line 51

<?php foreach ($subMenus as $subMenu) : $menu_id = $this->db->get_where('tbl_menu', ['id' => $subMenu['id_menu']])->row(); ?>
    <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
        <input type="checkbox" name="<?= $menu_id->id . '_' . $subMenu['id'] . '_read[]' ?>" class="form-control size-check">
    <?php endif; ?>
<?php endforeach; ?>


line 54


<?php foreach ($subMenus as $subMenu) : $menu_id = $this->db->get_where('tbl_menu', ['id' => $subMenu['id_menu']])->row(); ?>
    <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
        <input type="checkbox" name="<?= $menu_id->id . '_' . $subMenu['id'] . '_create[]'; ?>" class="form-control size-check">
    <?php endif; ?>
<?php endforeach; ?>

line 34


<?php foreach ($subMenus as $p => $subMenu) :  ?>
    <?php if ($menu['id'] == $subMenu['id_menu']) : ?>
        <span>
            <?= ++$p; ?> <?= $subMenu['sub_menu']; ?> <br>
        </span>
    <?php endif; ?>
<?php endforeach; ?>


line33
<?= $menu['menu']; ?>


line 29

<?php foreach ($menus as $menu) : ?>

    line 54
<?php endforeach; ?>