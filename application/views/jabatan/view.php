
<div class="content-wrapper col-12">
<section class="content-header ml mt-2 auto">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$judul; ?></h6>
        </div>
        <div class="card-body">
            <?php if($this->session->flashdata('success')) echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $this->session->flashdata('success') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></div>'; ?>

            <?=validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></div>'); ?>

            <?=form_open(''); ?>
                <input type="hidden" name="id" value="<?=($jabatanList->id);?>" />
                <div class="form-group">
                    <label class="my-1 mr-2">Kode</label>
                    <input type="text" class="form-control" name="kode" value="<?=$jabatanList->kode;?>">
                </div>

                <div class="form-group">
                    <label class="my-1 mr-2">Nama Jabatan</label>
                    <input type="text" class="form-control" name="name" value="<?=$jabatanList->name;?>">
                </div>        
                <a href="<?=base_url('jabatan');?>" class="btn btn-secondary my-1">Cancel</a>
                <button type="submit" class="btn btn-primary my-1">Submit</button>
            </form>
        </div>
    </div>

</section> 
</div>

<script type="text/javascript">
    var deferred = new $.Deferred(),
        promise = deferred.promise();
    
    $('#content').on( "click", function() {
        // alert(1);
    });

    setTimeout(function(){
        $(".alert").each(function(index){
            $(this).delay(200*index).fadeTo(1500,0).slideUp(500,function(){
                $(this).remove();
            });
        });
    },2000);
</script>