
<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left"><?=$judul; ?></h6>
            <div class="float-right">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#jabatanModal">Tambah</a>
            </div>
        </div>
        <div class="card-body">
        <?php if($this->session->flashdata('success')) echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $this->session->flashdata('success') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>'; ?>

        <div class="table-responsive table table-hover">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($jabatanList):
                        $no=1;
                        foreach($jabatanList as $jabatan) {
                        ?>
                        <tr>
                            <td><?=$no;?>.</td>
                            <td><?=$jabatan['kode']; ?></td>
                            <td><?=$jabatan['name']; ?></td>
                            <td>
                                <a href="<?=base_url();?>jabatan/edit/<?=$jabatan['id'];?>" class="btn btn-success" style="margin-left:42px"><i class="fa fa-edit"></i>Edit</i></a>
                                <a href="#" class="btn btn-danger tagHapus" data-id="<?=$jabatan['id'];?>"><i class="fa fa-trash"></i>Hapus</a>
                            </td>
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

<!-- Jabatan Modal-->
<div class="modal fade" id="jabatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?=form_open('jabatan/create', array('id' => 'jabatanform','method'=>'post')); ?>
                    <div class="form-group">
                        <label class="my-1 mr-2">Kode</label>
                        <input type="text" class="form-control" name="kode" />
                    </div>

                    <div class="form-group">
                        <label class="my-1 mr-2">Nama Jabatan</label>
                        <input type="text" class="form-control" name="name" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" id="tagSubmit" class="btn btn-primary my-1">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    var deferred = new $.Deferred(), promise = deferred.promise();

    $('.tagHapus').on('click', function(e) {
        e.preventDefault();
        if(confirm('Yakin ingin dihapus?')) {
            var id = $(this).data("id");
            $.get("<?=base_url();?>jabatan/hapus/" + id, function(data, status){
                console.log(data);
                var obj = JSON.parse(data);
                if(obj.success){
                    Swal.fire({
                        icon: 'error',
                        text: obj.msg
                    });
                }
            });
            $(this).closest("tr").remove();
        }

    });

    $('#tagSubmit').on('click', function(e) {
        e.preventDefault();
        $('input[name=kode]').removeAttr('disabled');

        $.ajax({
            type: "POST",
            url: $('form#jabatanform').attr('action'),
            data: $('form#jabatanform').serialize(),
            success: function(response) {
                console.log(response);
                var obj = JSON.parse(response);
                if(obj.success){
                    $('#jabatanModal').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: obj.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

                setTimeout(function(){
                    window.location.reload();
                },2000);
            },
            error: function() {
                alert('Error');
            }
        });
        return false;
    });

    $('#jabatanModal').on('shown.bs.modal', function (e) {
        $.get("<?=base_url('jabatan/getkode');?>", function(data, status){
            // console.log(data);
            $('input[name=kode]').val(data).attr('disabled', 'disabled');
        });
    });

    setTimeout(function(){
        $(".alert").each(function(index){
            $(this).delay(200*index).fadeTo(1500,0).slideUp(500,function(){
                $(this).remove();
            });
        });
    },2000);
</script>