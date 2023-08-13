<div class="container">
    <div class="col-md-6">
        <h2 class="">Form Edit Role Akses</h2>
        <form action="" class="form-horizontal" method="POST">
            <input type="hidden" name="id" class="form-control" value="<?= $roleakses['id']; ?>">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" placeholder="Masukkan Role Akses" class="form-control" value="<?= $roleakses['name']; ?>">
                <small><span class="text-danger"><?= form_error('name'); ?></span></small>
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <input type="text" name="description" placeholder="Masukkan Deskripsi" class="form-control" value="<?= $roleakses['description']; ?>">
                <small><span class="text-danger"><?= form_error('description'); ?></span></small>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Edit Data</button>
            <a href="<?= base_url('roleakses'); ?>" class="btn btn-success mb-2">Kembali</a>
        </form>
    </div>
</div>