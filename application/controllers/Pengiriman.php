<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengiriman extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_pengiriman');
    $this->load->library('form_validation');
  }
  public function index()
  {
    $topik['judul'] = 'Halaman Menu Pengiriman Barang';
    $x['data1'] = $this->m_pengiriman->tampil_data();
    $x['kode'] = $this->m_pengiriman->kode();
    $x['data'] = $this->m_pengiriman->tampil_datamitra();

    $this->db->select('*');
    $this->db->from('tbl_setup_jurnal');
    $this->db->where('formulir',"pengiriman_barang");
    $x['setup_jurnal'] = $this->db->get()->result_array();

    $this->load->view('templates/header', $topik);
    $this->load->view('pengiriman/index', $x);
    $this->load->view('templates/footer');
  }

  public function filter()
  {
    $topik['judul'] = 'Halaman Menu Pengiriman Barang';

    $dfil['kode_id'] = $this->input->get('kode_id', true);
    $dfil['kepada'] = $this->input->get('kepada', true);
    $dfil['alamat'] = $this->input->get('alamat', true);
    $dfil['kota'] = $this->input->get('kota', true);
    $dfil['telepon'] = $this->input->get('telepon', true);
    $dfil['tanggal'] = $this->input->get('tanggal', true);
    $dfil['tanggal_sampai'] = $this->input->get('tanggal_sampai', true);
    $dfil['no_do'] = $this->input->get('no_do', true);
    $dfil['manager_gudang'] = $this->input->get('manager_gudang', true);
    $dfil['no_kontainer'] = $this->input->get('no_kontainer', true);
    $dfil['no_segel'] = $this->input->get('no_segel', true);
    $dfil['setup_jurnal'] = $this->input->get('setup_jurnal', true);
    $dfil['jenis_transaksi'] = $this->input->get('jenis_transaksi', true);
    $dfil['tanggal_jt'] = $this->input->get('tanggal_jt', true);

    $this->db->select('*');
    $this->db->from('tbl_setup_jurnal');
    $this->db->where('formulir',"pengiriman_barang");
    $x['setup_jurnal'] = $this->db->get()->result_array();

    $x['df'] = $dfil;
    $x['data1'] = $this->m_pengiriman->filter_data($dfil);
    $x['kode'] = $this->m_pengiriman->kode();
    $x['data'] = $this->m_pengiriman->tampil_datamitra();
    $this->load->view('templates/header', $topik);
    $this->load->view('pengiriman/filter', $x);
    $this->load->view('templates/footer');
  }
  // $x['data2'] = $this->m_pengiriman->tampil_barang();

  public function cetak_faktur($id = null)
  {
    ob_start();

		$this->load->library('dompdf_gen');
    $data['pengiriman'] = $this->m_pengiriman->getPengirimanById($id);
    $data['barang'] = $this->m_pengiriman->getBarangByPengirimanId($id);

    // $html = $this->load->view('pengiriman/print_faktur', $data);
    $html = $this->load->view('pengiriman/print_faktur', $data);
    
    $this->dompdf->set_paper('A4', 'potrait');
		
		// $html = $this->output->get_output();
    // libxml_use_internal_errors(true);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Data Pengiriman.pdf", array('Attachment' =>0));

    ob_end_clean();
    
    // $this->load->library('pdfGenerator');
        
    // // $this->data['title_pdf'] = 'Laporan Penjualan Toko Kita';
    
    // $file_pdf = 'Data Pengiriman';
    // $paper = 'A4';
    // $orientation = "portrait";
    
    // $html = $this->load->view('pengiriman/print_faktur',$data, true);	    
    
    // $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    
    
    // $this->load->library('dompdf_gen');

    // $html= $this->output->get_output();
    // $this->dompdf->set_paper('A4', 'potrait');
    // $this->dompdf->load_html($html);
    // $this->dompdf->render();
    // $this->dompdf->stream("Data Pengiriman.pdf", ['Attachment' => 0]);
    



    //  var_dump($data['pengiriman']);die();
    // $this->load->library('Pdf');
    // $this->pdf->filename = "Data Pengiriman.pdf";
    // $this->pdf->load_view('pengiriman/print_faktur', $data);
    
    // die();
    // $html = ob_get_contents();
    // ob_end_clean();
    // require_once('./asset/html2pdf/html2pdf.class.php');
    // $pdf = new HTML2PDF('P', 'A4', 'en');
    // $pdf->WriteHTML($html);
    // $pdf->Output('Data Pengiriman.pdf', 'D');



    // $this->load->view('pengiriman/print_faktur', $data);
    // die();
    // $html = ob_get_contents();
    // require_once('./asset/html2pdf/html2pdf.class.php');
    // $pdf = new HTML2PDF('P', 'A4', 'en');
    // $pdf->WriteHTML($html);
    // $pdf->Output('Data Pengiriman.pdf', 'D');
  }

  public function cetak_alamat()
  {
    ob_start();
    $data['pengiriman'] = $this->m_pengiriman->tampil_cetak();
    $this->load->view('pengiriman/print', $data);
    $html = ob_get_contents();
    ob_end_clean();
    require_once('./asset/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P', 'A4', 'en');
    $pdf->WriteHTML($html);
    $pdf->Output('Data Pengiriman.pdf', 'D');
  }

  public function getLatestNoDO()
  {
    $no_do_firsthalf = "SJ/" . date('ymd') . "/";
    $no_do_latest = $this->m_pengiriman->getLatestNoDO();
    if ($no_do_latest) {
      $no_do_latest = explode("/", $no_do_latest['no_do']);
      $no_do_latest = ((int)$no_do_latest[2] + 1);

      if (strlen($no_do_latest) >= 6) {
        $no_do = $no_do_firsthalf . (string)$no_do_latest;
      } else {
        $no_do = $no_do_firsthalf . str_repeat("0", (6 - strlen((string)$no_do_latest))) . $no_do_latest;
      }
    } else {
      $no_do = $no_do_firsthalf . "000001";
    }

    echo json_encode($no_do);
  }

  public function tambah()
  {
    $data['judul'] = 'Tambah Data Pengiriman Barang';

    $x['data1'] = $this->m_pengiriman->tampil_data();
    $x['data2'] = $this->m_pengiriman->tampil_barang();
    $x['kode'] = $this->m_pengiriman->kode();
    $x['data'] = $this->m_pengiriman->tampil_datamitra();
    $x['gdg'] = $this->m_pengiriman->allGdg();

    $this->db->select('*');
    $this->db->from('tbl_setup_jurnal');
    $this->db->where('formulir',"pengiriman_barang");
    $x['setup_jurnal'] = $this->db->get()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('pengiriman/tambah', $x);
    $this->load->view('templates/footer');
  }

  public function tambahDataPengiriman()
  {
    
    $this->form_validation->set_rules('jenis_transaksi', 'Jenis Transaksi', 'required');
    $this->form_validation->set_rules('setupjurnal', 'Setup Jurnal', 'required');
    $this->form_validation->set_rules('tanggaljt', 'Tanggal J/T', 'required');
    // $this->form_validation->set_rules('kode', 'Kode', 'required');
    // $this->form_validation->set_rules('nama', 'Nama', 'required');
    // $this->form_validation->set_rules('qty_karton', 'Jumlah Karton', 'required');
    // $this->form_validation->set_rules('qty_perkarton', 'Jumlah Perkarton', 'required');
    // $this->form_validation->set_rules('total', 'Total', 'required');
    // $this->form_validation->set_rules('qty_karton_rsk', 'Jumlah Karton Rusak', 'required');
    // $this->form_validation->set_rules('qty_perkarton_rsk', 'Jumlah Perkarton Rusak', 'required');
    // $this->form_validation->set_rules('total_rsk', 'Total Rusak', 'required');
    // $this->form_validation->set_rules('gudang_asal', 'Gudang Asal', 'required');
    // $this->form_validation->set_rules('gudang_tujuan', 'Gudang Tujuan', 'required');
    // $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
    // $this->form_validation->set_rules('subtotal', 'Subtotal', 'required');
    // $this->form_validation->set_rules('stok', 'Stok', 'required');
    // $this->form_validation->set_rules('stok_rsk', 'Stok Rusak', 'required');
    $this->form_validation->set_rules('kepada', 'Kepada', 'required');
    $this->form_validation->set_rules('kota', 'Kota', 'required');
    $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('no_do', 'No DO', 'required');
    $this->form_validation->set_rules('nama_expedisi','Nama Ekspedisi','required');
    $this->form_validation->set_rules('alamat','Alamat','required');
    $this->form_validation->set_rules('manager_gudang','Manager Gudang','required');
    $this->form_validation->set_rules('no_kontainer','No Kontainer','required');
    $this->form_validation->set_rules('no_segel','No Segel','required');
    $this->form_validation->set_rules('total_pengiriman','Total Pengiriman','required');

    if ($this->form_validation->run() == FALSE) {
      $errors = ['errors' => validation_errors()];
      echo json_encode($errors, true);
    } else {
      $dataPengiriman = [
        // "kode" => $this->input->post('kode', true),
        "jenis_transaksi" => $this->input->post('jenis_transaksi', true),
        "setup_jurnal" => $this->input->post('setupjurnal', true),
        "tanggal_jt" => $this->input->post('tanggaljt', true),
        "kepada" => $this->input->post('kepada', true),
        "alamat" => $this->input->post('alamat', true),
        "kota" => $this->input->post('kota', true),
        "no_telepon" => $this->input->post('no_telepon', true),
        "tanggal" => $this->input->post('tanggal', true),
        "no_do" => $this->input->post('no_do', true),
        "manager_gudang" => $this->input->post('manager_gudang', true),
        "no_kontainer" => $this->input->post('no_kontainer', true),
        "no_segel" => $this->input->post('no_segel', true),
        "kode_id" => $this->input->post('kode_id', true),
        "nama_expedisi" => $this->input->post('nama_expedisi', true),
        "ongkir" => $this->input->post('ongkir', true),
        "berat_ongkir" => $this->input->post('berat_ongkir', true),
        "jenis_kendaraan" => $this->input->post('jenis_kendaraan', true),
        "no_polisi" => $this->input->post('no_polisi', true),
        "driver" => $this->input->post('driver', true),
        "total_qty" => $this->input->post('total_qty', true),
        "total_ongkir" => $this->input->post('total_ongkir', true),
        "pembayaran" => $this->input->post('pembayaran', true),
        "total_pengiriman" => $this->input->post('total_pengiriman', true)
      ];

      $addPengiriman = $this->m_pengiriman->tambahDataPengiriman($dataPengiriman);
      $pengiriman_id = $this->db->insert_id();

      foreach($this->input->post('barang', true) as $b){
        $dataBarang = [
          "pengiriman_id" => $pengiriman_id,
          "kode" => $b['kode'],
          "nama" => $b['nama'],
          "qty_karton" => $b['qty_karton'],
          "qty_karton_rusak" => $b['qty_karton_rsk'],
          "qty_perkarton" => $b['qty_perkarton'],
          "qty_perkarton_rusak" => $b['qty_perkarton_rsk'],
          "total" => $b['total'],
          "total_rusak" => $b['total_rsk'],
          "stok" => $b['stok'],
          "stok_rusak" => $b['stok_rsk'],
          "gudang_asal" => $b['gudang_asal'],
          "gudang_tujuan" => $b['gudang_tujuan'],
          "harga_jual" => $b['harga_jual'],
          "subtotal" => $b['subtotal'],
        ];
        $this->m_pengiriman->tambahDataBarangPengiriman($dataBarang);
      }

      // for($i=0;$i<=count($this->input->post('nama', true));$i++){
        
      // }

      // echo json_encode($this->input->post('kode',true));
      echo json_encode('ok');
    }
  }

  // public function detail($id){
  //     $topik['judul'] = 'Detail Data Karyawan';
  //     $data['pengiriman'] = $this->m_pengiriman->getPengirimanById($id);
  //     $this->load->view('templates/header',$topik);
  //     $this->load->view('pengiriman/detail',$data);
  // }
  public function hapus($id)
  {
    $this->m_pengiriman->hapusDataPengiriman($id);
    $this->m_pengiriman->hapusDataPengirimanBarangByPengirimanId($id);
    $this->session->set_flashdata('flash2', 'Dihapus');
    redirect('pengiriman');
  }

  public function edit($id = NULL)
  {
    $topik['judul'] = 'Edit Data Pengiriman';

    $x['data2'] = $this->m_pengiriman->tampil_barang();
    //$x['data1'] = $this->m_pengiriman->tampil();
    $x['data'] = $this->m_pengiriman->tampil_datamitra();
    $x['kode'] = $this->m_pengiriman->kode();

    $x['pengiriman'] = $this->m_pengiriman->getPengirimanById($id);
    $x['barang'] = $this->m_pengiriman->getBarangByPengirimanId($id);
    // var_dump($x['barang']);die();

    $this->db->select('*');
    $this->db->from('tbl_setup_jurnal');
    $this->db->where('formulir',"pengiriman_barang");
    $x['setup_jurnal'] = $this->db->get()->result_array();

    $x['stok'] = $this->m_pengiriman->cekStok($id);

    // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

    $this->form_validation->set_rules('kode', 'Kode', 'required');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('qty_karton', 'Qty Karton', 'required');
    $this->form_validation->set_rules('qty_perkarton', 'Qty Perkarton', 'required');
    $this->form_validation->set_rules('total', 'Total', 'required');
    $this->form_validation->set_rules('qty_karton_rsk', 'Qty Karton Rusak', 'required');
    $this->form_validation->set_rules('qty_perkarton_rsk', 'Qty Perkarton Rusak', 'required');
    $this->form_validation->set_rules('total_rsk', 'Total Rusak', 'required');
    $this->form_validation->set_rules('gudang_asal', 'Gudang Asal', 'required');
    $this->form_validation->set_rules('gudang_tujuan', 'Gudang Tujuan', 'required');
    $this->form_validation->set_rules('kepada', 'Kepada', 'required');
    $this->form_validation->set_rules('kota', 'Kota', 'required');
    $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('no_do', 'No DO', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $topik);
      $this->load->view('pengiriman/edit', $x);
      $this->load->view('templates/footer');
    } else {
      $this->m_pengiriman->ubahDataPengiriman();
      $this->session->set_flashdata('flash', 'Diubah');
      redirect('pengiriman');
    }
  }

  public function edit_koreksi($id)
  {
    $topik['judul'] = 'Edit Data Pengiriman';

    $x['data2'] = $this->m_pengiriman->tampil_barang();
    //$x['data1'] = $this->m_pengiriman->tampil();
    $x['data'] = $this->m_pengiriman->tampil_datamitra();
    $x['kode'] = $this->m_pengiriman->kode();

    $x['pengiriman'] = $this->m_pengiriman->getPengirimanById($id);
    // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

    $this->form_validation->set_rules('kode_id', 'Kode_id', 'required');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('qty_karton', 'Qty_karton', 'required');
    $this->form_validation->set_rules('qty_perkarton', 'Qty Perkarton', 'required');
    $this->form_validation->set_rules('total', 'Total', 'required');
    $this->form_validation->set_rules('gudang_asal', 'Gudang Asal', 'required');
    $this->form_validation->set_rules('gudang_tujuan', 'Gudang Tujuan', 'required');
    $this->form_validation->set_rules('stok', 'Stok', 'required');
    $this->form_validation->set_rules('kepada', 'Kepada', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('kota', 'Kota', 'required');
    $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('no_do', 'No DO', 'required');
    $this->form_validation->set_rules('manager_gudang', 'Manager Gudang', 'required');
    $this->form_validation->set_rules('no_kontainer', 'No Kontainer', 'required');
    $this->form_validation->set_rules('no_segel', 'No Segel', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $topik);
      $this->load->view('pengiriman/edit_koreksi', $x);
      $this->load->view('templates/footer');
    } else {
      $this->m_pengiriman->ubahDataPengiriman();
      $this->session->set_flashdata('flash', 'Diubah');
      redirect('pengiriman');
    }
  }

  function update($id)
  {
    $this->form_validation->set_rules('jenis_transaksi', 'Jenis Transaksi', 'required');
    $this->form_validation->set_rules('setupjurnal', 'Setup Jurnal', 'required');
    $this->form_validation->set_rules('tanggaljt', 'Tanggal J/T', 'required');
    // $this->form_validation->set_rules('kode', 'Kode', 'required');
    // $this->form_validation->set_rules('nama', 'Nama', 'required');
    // $this->form_validation->set_rules('qty_karton', 'Jumlah Karton', 'required');
    // $this->form_validation->set_rules('qty_perkarton', 'Jumlah Perkarton', 'required');
    // $this->form_validation->set_rules('total', 'Total', 'required');
    // $this->form_validation->set_rules('qty_karton_rsk', 'Jumlah Karton Rusak', 'required');
    // $this->form_validation->set_rules('qty_perkarton_rsk', 'Jumlah Perkarton Rusak', 'required');
    // $this->form_validation->set_rules('total_rsk', 'Total Rusak', 'required');
    // $this->form_validation->set_rules('gudang_asal', 'Gudang Asal', 'required');
    // $this->form_validation->set_rules('gudang_tujuan', 'Gudang Tujuan', 'required');
    // $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
    // $this->form_validation->set_rules('subtotal', 'Subtotal', 'required');
    // $this->form_validation->set_rules('stok', 'Stok', 'required');
    // $this->form_validation->set_rules('stok_rsk', 'Stok Rusak', 'required');
    $this->form_validation->set_rules('kepada', 'Kepada', 'required');
    $this->form_validation->set_rules('kota', 'Kota', 'required');
    $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('no_do', 'No DO', 'required');
    $this->form_validation->set_rules('nama_expedisi','Nama Ekspedisi','required');
    $this->form_validation->set_rules('alamat','Alamat','required');
    $this->form_validation->set_rules('manager_gudang','Manager Gudang','required');
    $this->form_validation->set_rules('no_kontainer','No Kontainer','required');
    $this->form_validation->set_rules('no_segel','No Segel','required');
    $this->form_validation->set_rules('total_pengiriman','Total Pengiriman','required');

    if ($this->form_validation->run() == FALSE) {
      $errors = ['errors' => validation_errors()];
      echo json_encode($errors, true);
    } else {
      $dataPengiriman = [
        // "kode" => $this->input->post('kode', true),
        "jenis_transaksi" => $this->input->post('jenis_transaksi', true),
        "setup_jurnal" => $this->input->post('setupjurnal', true),
        "tanggal_jt" => $this->input->post('tanggaljt', true),
        "kepada" => $this->input->post('kepada', true),
        "alamat" => $this->input->post('alamat', true),
        "kota" => $this->input->post('kota', true),
        "no_telepon" => $this->input->post('no_telepon', true),
        "tanggal" => $this->input->post('tanggal', true),
        "no_do" => $this->input->post('no_do', true),
        "manager_gudang" => $this->input->post('manager_gudang', true),
        "no_kontainer" => $this->input->post('no_kontainer', true),
        "no_segel" => $this->input->post('no_segel', true),
        "kode_id" => $this->input->post('kode_id', true),
        "nama_expedisi" => $this->input->post('nama_expedisi', true),
        "ongkir" => $this->input->post('ongkir', true),
        "berat_ongkir" => $this->input->post('berat_ongkir', true),
        "jenis_kendaraan" => $this->input->post('jenis_kendaraan', true),
        "no_polisi" => $this->input->post('no_polisi', true),
        "driver" => $this->input->post('driver', true),
        "total_qty" => $this->input->post('total_qty', true),
        "total_ongkir" => $this->input->post('total_ongkir', true),
        "pembayaran" => $this->input->post('pembayaran', true),
        "total_pengiriman" => $this->input->post('total_pengiriman', true)
      ];

      $where = array(
        'id' => $id
      );
  
      $this->m_pengiriman->update_data($where, $dataPengiriman, 'pengiriman');

      $delbp = $this->m_pengiriman->hapusDataPengirimanBarangByPengirimanId($id);
      
      foreach($this->input->post('barang', true) as $b){
        $dataBarang = [
          "pengiriman_id" => $id,
          "kode" => $b['kode'],
          "nama" => $b['nama'],
          "qty_karton" => $b['qty_karton'],
          "qty_karton_rusak" => $b['qty_karton_rsk'],
          "qty_perkarton" => $b['qty_perkarton'],
          "qty_perkarton_rusak" => $b['qty_perkarton_rsk'],
          "total" => $b['total'],
          "total_rusak" => $b['total_rsk'],
          "stok" => $b['stok'],
          "stok_rusak" => $b['stok_rsk'],
          "gudang_asal" => $b['gudang_asal'],
          "gudang_tujuan" => $b['gudang_tujuan'],
          "harga_jual" => $b['harga_jual'],
          "subtotal" => $b['subtotal'],
        ];
        $this->m_pengiriman->tambahDataBarangPengiriman($dataBarang);
      }

      // for($i=0;$i<=count($this->input->post('nama', true));$i++){
        
      // }

      // echo json_encode($this->input->post('kode',true));
      echo json_encode('ok');
    }

    
  }

  function update_koreksi()
  {
    $id = $this->input->post('id');
    $kode_id = $this->input->post('kode_id');
    $nama = $this->input->post('nama');
    $qty_karton = $this->input->post('qty_karton');
    $qty_perkarton = $this->input->post('qty_perkarton');
    $total = $this->input->post('total');
    $gudang_asal = $this->input->post('gudang_asal');
    $gudang_tujuan = $this->input->post('gudang_tujuan');
    $stok = $this->input->post('stok');
    $kepada = $this->input->post('kepada');
    $alamat = $this->input->post('alamat');
    $kota = $this->input->post('kota');
    $no_telepon = $this->input->post('no_telepon');
    $tanggal = $this->input->post('tanggal');
    $no_do = $this->input->post('no_do');
    $manager_gudang = $this->input->post('manager_gudang');
    $no_kontainer = $this->input->post('no_kontainer');
    $no_segel = $this->input->post('no_segel');


    $data = array(
      'kode_id' => $kode_id,
      'nama' => $nama,
      'qty_karton' => $qty_karton,
      'qty_perkarton' => $qty_perkarton,
      'total' => $total,
      'gudang_asal' => $gudang_asal,
      'gudang_tujuan' => $gudang_tujuan,
      'stok' => $stok,
      'kepada' => $kepada,
      'alamat' => $alamat,
      'kota' => $kota,
      'no_telepon' => $no_telepon,
      'tanggal' => $tanggal,
      'no_do' => $no_do,
      'manager_gudang' => $manager_gudang,
      'no_kontainer' => $no_kontainer,
      'no_segel' => $no_segel
    );

    $where = array(
      'id' => $id
    );

    $this->m_pengiriman->update_data($where, $data, 'pengiriman');
    $this->session->set_flashdata('flash', 'Diubah');
    redirect('pengiriman/index_tampil');
  }
}
