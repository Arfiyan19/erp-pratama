<?php 

// $value="FirdySoft Creation Inc.Bontang Kalimantan Timur 
// Mobile: 0821-81000168 
// WhatsApp: 0821-81000168
// ";
$value="Jl. H. Naman No.24F, RT.13/RW.3, Pd. Klp., Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450";





?>
<div class="container">
        <div class="col-md-6">
            <h2 class="">Data Perusahaan</h2>
            <form action="" class="form-horizontal" method="POST">
            <input type="hidden" name="id" class="form-control" value="">
            <div class="form-row">
                <label for="inputNama">Nama</label>
                <input type="text" class="form-control" id="inputNama" name="nama"  value="PT Inovasi Sinar Terang">
                
            </div>

                <div class="form-row">
                <label for="inputAnak">Deskripsi</label>
                <textarea type="text" class="form-control" id="inputAnak" name="jumlah_anak" style="height: 100px;"><?= $value;?></textarea>
                
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="Masukkan Gaji Pokok" class="form-control" autocomplete="off" value="hello@ist-idn.com">
                </div>
                
                
                
                <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                <a href="<?=base_url('dashboard');?>" class="btn btn-success mb-2">Kembali</a>
            </form>
        </div>
    </div>