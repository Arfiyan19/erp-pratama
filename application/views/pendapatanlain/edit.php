<div class="container">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="col-md-12">
        <h2 class="">Form Tambah Data</h2>
        <form action="" class="form-horizontal" method="POST">
        <input type="hidden" name="id" class="form-control" value="<?= $pendapatanlain['id'];?>">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">No Faktur</label>
                        <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="<?= $pendapatanlain['no_faktur'];?>" readonly>

                        <small><span class="text-danger"><?=form_error('no_faktur');?></span></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Tgl</label>
                        <input type="text" required name="tgl" class="form-control" value="<?= $pendapatanlain['tgl'];?>">
                        <small><span class="text-danger"><?=form_error('tgl');?></span></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Rekening</label>
                        <select class="form-control" name="rekening">
                            <option value="Kas" <?= $pendapatanlain['rekening'] == 'Kas' ? 'selected' : ''; ?> >Kas</option> 
                            <option value="Tunai" <?= $pendapatanlain['rekening']  == 'Tunai' ? 'selected' : '';?>>Tunai</option> 
                        </select>
                        <small><span class="text-danger"><?=form_error('rekening');?></span></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Kode Jurnal</label>
                        <input type="text" name="kode_jurnal" value="<?= count($setup_jurnal) > 0 ? $setup_jurnal[0]['kode_jurnal'] : '-'?>" readonly class="form-control form-control-sm">
                        <small><span class="text-danger"><?=form_error('kode_jurnal');?></span></small>
                    </div>
                </div>
            </div>
            <hr>
            <button type="button" class="btn btn-success btn-sm mb-2 add-new-akun"><i class="fa fa-plus"></i> tambah akun</button>
            <div class="transaksi-b">
                <?php foreach($coaedit as $k => $v){ ?>
                <div class="row transaksi-ba">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kode dan Nama Akun</label>
                            <select name="kode_akun[]" class="form-control select2">
                                <?php foreach($coa as $a){ ?>
                                    <option value="<?= $a['id'] ?>" <?php echo $a['id'] == $v['coa_id'] ? 'selected' : ''; ?>><?= $a['kode'] ?> - <?= $a['nama'] ?></option>
                                <?php } ?>
                            </select >
                            <small><span class="text-danger"><?=form_error('kode_akun');?></span></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Transaksi</label>
                            <input type="text" name="transaksi[]" value="<?= $v['transaksi'] ?>" required placeholder="Masukkan Transaksi" class="form-control">
                            <small><span class="text-danger"><?=form_error('transaksi');?></span></small>
                        </div>
                    </div>
                    <?php if($k != 0){ ?>
                        <div class="col-md-3">
                    <?php }else{ ?>
                            <div class="col-md-4">
                    <?php } ?>
                        <div class="form-group">
                            <label for="">Jumlah Sub Total</label>
                            <input type="number" name="subtotal[]" value="<?= $v['jumlah_subtotal'] ?>"  required placeholder="Masukkan Jumlah" class="form-control subtotal">
                            <small><span class="text-danger"><?=form_error('jumlah');?></span></small>
                        </div>
                    </div>
                    <?php if($k != 0){ ?>
                        <div class="col-md-1">
                            <div class="form-group">
                                <br>
                                <button class="btn btn-danger remove-akun"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            </div>
            <div class="transaksi-copy"></div>
            
            <div class="row mt-3 mb-3">
                <div class="col-md-4"></div>
                <div class="col-md-3"></div>
                <div class="col-md-5 text-right">
                    <div class="form-group mb-4">
                        <h5 for=""><b>Jumlah Total : <span id="jumlah_total"><?= number_format($pendapatanlain['jumlah_total'], 2, ',', '.') ?></span></b></h5>
                        <input type="hidden" id="jumlah_totalhd" value="<?= $pendapatanlain['jumlah_total'] ?>" name="jumlah_total">
                        <small><span class="text-danger"><?=form_error('jumlah_total');?></span></small>
                    </div>
                    <a href="<?=base_url('pendapatan');?>" class="btn btn-success mb-2">Kembali</a>
                    <button type="submit" class="btn btn-primary mb-2">Edit Data</button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }
    .select2-container--default .select2-selection--single{
        height: 37px!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 35px !important;
    }
</style>
<script>
    console.log('start');
    function sumsubtotal(){
        var total = 0;
        var sb = $('input[name="subtotal[]"]');

        $(sb).each(function () {
            total += parseFloat(this.value)
        });

        if (!isNaN(total)) {
            // pengiriman.value = parseFloat(total);
            $('#jumlah_total').html(new Intl.NumberFormat('id-ID').format(total));
            $('#jumlah_totalhd').val(total);
        }
    }
	$(document).ready(function() {
        $('.select2').select2();
        $(".add-new-akun").click(function(){
            var content = "";
            content = `
            <div class="row akun-new">    
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Kode dan Nama Akun</label>
                        <select name="kode_akun[]" class="form-control select2">
                            <?php foreach($coa as $a){ ?>
                                <option value="<?= $a['id'] ?>"><?= $a['kode'] ?> - <?= $a['nama'] ?></option>
                            <?php } ?>
                        </select >
                        <small><span class="text-danger"><?=form_error('kode_akun');?></span></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Transaksi</label>
                        <input type="text" name="transaksi[]" required placeholder="Masukkan Transaksi" class="form-control">
                        <small><span class="text-danger"><?=form_error('transaksi');?></span></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Jumlah Sub Total</label>
                        <input type="text" name="subtotal[]" required value="0" placeholder="Masukkan Jumlah" class="form-control subtotal">
                        <small><span class="text-danger"><?=form_error('jumlah');?></span></small>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-danger remove-akun"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
            `;
            $('.transaksi-copy').append(content);
            $('.select2').select2();
            sumsubtotal();
        });

        $(".transaksi-copy").on("click",".remove-akun",function(){ 
            $(this).parents(".akun-new").remove();
            sumsubtotal();
        });

        $(".transaksi-b").on("click",".remove-akun",function(){ 
            $(this).parents(".transaksi-ba").remove();
            sumsubtotal();
        });
        
        $(".transaksi-b").on("input", ".subtotal", function(){
            sumsubtotal();
        });

        $(".transaksi-copy").on("input", ".subtotal", function(){
            sumsubtotal();
        });


        
    });
</script>