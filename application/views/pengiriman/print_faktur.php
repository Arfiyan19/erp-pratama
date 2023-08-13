<!DOCTYPE html>
<html><head><title>Print Faktur</title>
  <style>
    table {
      border-collapse:collapse;
      table-layout:fixed;
	  font-size: 11pt;
	  font-style: Times new roman;
    }
	 table td {
      word-wrap:break-word;
      width:40%;
    }
  </style>
</head><body>
  <div style="place-items: flex-end;display: flex;">
    <div style="width: 49%;margin-right: 1%;">
      <h4>Kepada Yth</h4>
      <div style="border: 1px solid #000;padding: 23px 10px;">
        <?= $pengiriman['kepada'] ?>
      </div>
    </div>
    <div style="width: 49%;">
      <h1 style="text-decoration: underline;">INVOICE</h1>
      <table border="1" style="text-align: left;" cellpadding="2">
        <tr>
          <th>No</th>
          <td><?= $pengiriman['kode']?></td>
        </tr>
        <tr>
          <th>Tanggal</th>
          <td><?= $pengiriman['tanggal']?></td>
        </tr>
        <tr>  
          <th>Terms</th>
          <td>TES</td>
        </tr>
      </table>
    </div>
  </div>
  <br><br>
  	<table border="1" cellpadding="8" style="width:100%">	
			<tr align="center">
          <th widht="20px">Kode</th>
          <th>Nama Produk</th>
				  <th>Jumlah Total</th>
			</tr>
		
			<?php 
      $gtot = 0;
      foreach($barang as $k => $v){ ?>
        <tr align="center">
          <td><?php echo $v['kode'] ?></td>
          <td><?php echo $v['nama'] ?></td>
          <td><?php echo $v['total'] ?></td>
        </tr>
      <?php 
      $gtot += $gtot + $v['subtotal'];
      } ?>
			
    <tr>
      <td align="right" colspan="2">Total </td>
      <td align="center"><?php echo $gtot; ?></td>
    </tr>
  </table>

  <br><br>
    
  <table border="0" cellpadding="8" style="width:100%;background-color: #efefef;">	
			<tr align="center">
          <th widht="60%">Deskripsi</th>
          <th>Subtotal</th>
				  <td><?php echo $gtot; ?></td>
			</tr>
			<tr align="center">
          <th widht="20px">-</th>
          <th>Total</th>
				  <td><?php echo $pengiriman['total_pengiriman']; ?></td>
			</tr>
  </table>
  <br>
  <br>
  <br>
  <table>
  <tr>
  <td></td>
  <td></td>
  <td>Hormat Kami</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>
  
  <tr>
  <td></td>
  <td></td>
  <td><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>
  </table>
  <br><br>
  <table>
  <tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>
  
  <tr>
  <td><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>
  </table>
  <font>lembar putih:kantor pusat lembar merah:gudang lembar kuning:Accounting lembar hijau:logistic lembar biru:penerima</font>
</body></html>
