<div class="container">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <div class="col-md-12">
        <h5>Tambah Form Data</h5>

        <form action="" method="POST"> 
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail">Tanggal</label>
                    <input type="date" class="form-control" id="inputEmail" name="tgl" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTgl">Bukti Transaksi</label>
                    <input type="text" class="form-control" id="inputTgl" name="reff" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Kode Jurnal</label>
                    <input type="text" name="kode_jurnal" value="<?= count($setup_jurnal) > 0 ? $setup_jurnal[0]['kode_jurnal'] : '-'?>" readonly class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">Uraian</label>
                    <textarea type="text" class="form-control" id="inputEmail" name="uraian" required></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Rekening</label>
                    <select class="form-control" name="rekening">
                        <?php foreach($rekening as $a){ ?>
                            <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <hr>
            <button type="button" class="btn btn-success btn-sm mb-2 add-new-akun"><i class="fa fa-plus"></i> tambah akun</button>
            <div class="form-row pengeluaran-b">
                <div class="form-group col-md-4">
                    <label for="inputAlamat">No. Akun</label>
                    <select class="form-control select2" name="kode_id[]">
                        <?php foreach($coa as $a){ ?>
                            <option value="<?= $a['id'] ?>"><?= $a['kode'] ?> - <?= $a['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTahun">Jumlah</label>
                    <input type="text" class="form-control jumlah" value="0" id="inputTahun" name="jumlah[]" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputJabatan">Batasan</label>
                    <input type="text" class="form-control" id="inputJabatan" name="batasan[]" required>
                </div>
            </div>
            <div class="pengeluaran-copy"></div>
            
            <div class="row mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-3"></div>
                <div class="col-md-5 text-right">
                    <div class="form-group mb-4">
                        <h5 for=""><b>Jumlah Total : <span id="jumlah_total"><?= number_format(0, 2, ',', '.') ?></span></b></h5>
                        <input type="hidden" id="jumlah_totalhd" name="jumlah_total">
                    </div>
                    <a href="<?= base_url('penerimaan');?>" class="btn btn-success">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
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
        var sb = $('input[name="jumlah[]"]');

        $(sb).each(function () {
            total += parseFloat(this.value)
        });

        if (!isNaN(total)) {
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
                        <label for="">No. Akun</label>
                        <select name="kode_id[]" class="form-control select2">
                            <?php foreach($coa as $a){ ?>
                                <option value="<?= $a['id'] ?>"><?= $a['kode'] ?> - <?= $a['nama'] ?></option>
                            <?php } ?>
                        </select >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputTahun">Jumlah</label>
                        <input type="text" class="form-control jumlah" value="0" id="inputTahun" name="jumlah[]" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="inputJabatan">Batasan</label>
                        <input type="text" class="form-control" id="inputJabatan" name="batasan[]" required>
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
            $('.pengeluaran-copy').append(content);
            $('.select2').select2();
            sumsubtotal();
        });

        $(".pengeluaran-copy").on("click",".remove-akun",function(){ 
            $(this).parents(".akun-new").remove();
            sumsubtotal();
        });
        
        $(".pengeluaran-b").on("input", ".jumlah", function(){
            sumsubtotal();
        });

        $(".pengeluaran-copy").on("input", ".jumlah", function(){
            sumsubtotal();
        });


        
    });
</script>