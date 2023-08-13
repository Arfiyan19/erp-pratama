<?php

class M_manager extends CI_Model {
    public function tampil_data() { 
      return $this->db->get('manager')->result_array();
    }

    public function tampil_data_mitra()
    {
      return $this->db->get('daftar_mitra')->result_array();
    }

    public function tampil_data_pl()
    {
      $this->db->select('*, daftar_mitra.name');
      $this->db->from('weekly_manager2');
      $this->db->join('daftar_mitra', 'weekly_manager2.kode_id = daftar_mitra.kode');
      $query = $this->db->get();

      return $query->result_array();
    }

    public function tampil_data_pl_valid()
    {
      $this->db->select('*, daftar_mitra.name,weekly_manager2.id as wmid');
      $this->db->from('weekly_manager2');
      $this->db->join('daftar_mitra', 'weekly_manager2.kode_id = daftar_mitra.kode');
      $this->db->where('weekly_manager2.validasi', 'V');
      $query = $this->db->get();
      return $query->result_array();
    }

    public function tampil_data_pl_novalid()
    {
      $this->db->select('*, daftar_mitra.name');
      $this->db->from('weekly_manager2');
      $this->db->join('daftar_mitra', 'weekly_manager2.kode_id = daftar_mitra.kode');
      $this->db->where('weekly_manager2.validasi', 'V');
      $query = $this->db->get();

      return $query->result_array();
    }

    public function allMgr($jabatan) {
      $this->db->select('daftarmitra.nama, daftarmitra.kode_id');
      // $this->db->distinct();
      $this->db->from('daftarmitra');
      // $this->db->join('manager', 'manager.kode_id=daftarmitra=kode_id');
      $this->db->where('daftarmitra.jabatan', $jabatan);
      return $this->db->get()->result_array();
    }

    public function get_barang_mitra2($kode_mitra, $kode_barang = '', $nama_barang = '')
    {
        $this->db->select('id');
        $this->db->from('pengiriman');
        $this->db->where('kode_id', $kode_mitra);
        $mitrapengiriman = $this->db->get()->result_array();

        $idpengiriman = [];
        
        foreach($mitrapengiriman as $k => $v){
            $idpengiriman[] = $v['id'];
        }

        if(count($idpengiriman) > 0){
          $this->db->select('*, SUM(total) as total');
          $this->db->from('pengiriman_barang');
          $this->db->join('produk', 'produk.kode = pengiriman_barang.kode');
          // $this->db->join('tbl_category', 'tbl_category.kode = produk.kategori', 'LEFT');
          $this->db->where_in('pengiriman_barang.pengiriman_id', $idpengiriman);
          $this->db->group_by('pengiriman_barang.kode, pengiriman_barang.nama');
          if($kode_barang != ''){
              $this->db->where('pengiriman_barang.kode', $kode_barang);
          }
          if($nama_barang != ''){
              $this->db->where('pengiriman_barang.nama', $nama_barang);
          }
          $result = $this->db->get()->result_array();
          
          // echo json_encode($result);die();
          // var_dump($result[0]['kode']);
          
        }
        else{
            $result = [];
        }
        return $result;
        
    }

    public function invoiceMgr($weekending, $kode_id) {
      if ($weekending == date('d-m-Y')) {
        $weekending = "up";
      }
      $this->db->select('manager.*, daftarmitra.nama as nm_mgr, daftarmitra.akun_simpanan, daftarmitra.gudang');
      $this->db->from('manager, daftarmitra');
      $this->db->where('manager.tgl', $weekending);
      $this->db->where('manager.kode_id', $kode_id);
      $this->db->where('daftarmitra.kode_id', $kode_id);
      $this->db->where('manager.telah_diproses', 'T');
      // $this->db->where('manager.no_invoice', 'inout_manager.no_invoice');
      // $this->db->join('daftarmitra', 'manager.kode_id=daftarmitra.kode_id');
      // $this->db->join('users', 'manager.kode_id=users.kode_id');
      return $this->db->get()->result_array();
    }

    public function getAdditionalData($weekending, $kode_id) {
      if ($weekending == date('d-m-Y')) {
        $weekending = "up";
      }
      $this->db->select('SUM(manager.qty) as ttlqty, SUM(manager.totalotc) as ttlfullotc, SUM(manager.totalftc) as ttlfullftc');
      $this->db->from('manager');
      $this->db->where('manager.tgl', $weekending);
      $this->db->where('manager.kode_id', $kode_id);
      return $this->db->get()->row_array();
    }

    public function getSaldoUser($akun_simpanan) {
      $this->db->select('saldo_awal');
      $this->db->from('account_log');
      $this->db->where('kode', $akun_simpanan);
      $this->db->where('tanggal', 'up');
      return $this->db->get()->row_array();
    }

    public function getSUMInOut($no_invoice) {
      $this->db->select("SUM(kredit) as ttlkredit, SUM(debit) as ttldebit");
      $this->db->where("no_invoice", $no_invoice);
      return $this->db->get('inout_manager')->row_array();
    }

    public function fetchInOut($no_invoice) {
      $this->db->where("no_invoice", $no_invoice);
      return $this->db->get('inout_manager')->result_array();
    }
	
	function tampil_data1() {
    $username=$this->session->userdata("username");
     $this->db->where('users.username',"$username");
	  $this->db->select('manager.id,manager.kode_id,manager.kode,manager.nama,manager.qty,manager.otc,manager.totalotc,manager.ftc,manager.totalftc');
	 $this->db->from('users');
	 $this->db->join('manager','manager.kode_id=users.kode_id');
	 $query = $this->db->get();
	 return $query->result_array();
	}

	function tampil_data_manager($fil) {
    $kodeid=$this->session->userdata("kode_id");
    $this->db->select('*');
    $this->db->from('weekly_manager2');

    if($fil['faktur'] != ''){
      $this->db->where('no_invoice', $fil['faktur']);
    }
    if($fil['tgl_mulai'] != ''){
      $this->db->where('tgl >= ', $fil['tgl_mulai']);
    }
    if($fil['tgl_sampai'] != ''){
      $this->db->where('tgl <= ', $fil['tgl_sampai']);
    }
    
    $this->db->where('kode_id',"$kodeid");
    $query = $this->db->get();
	 return $query->result_array();
	}

	function hapusDataManager($id) {
    $this->db->where('id', $id);
		$this->db->delete('weekly_manager2');
	}

	function hapusDataBarangManager($weeklymid) {
    $this->db->where('id_weekly_manager2', $weeklymid);
		$this->db->delete('weekly_manager2_barang');
	}

  public function getDataSearch()
  {
    $this->db->select('manager.no_invoice, bukubesar.tgl, produk.hargasetoran, bukubesar.tutup_buku');
    $this->db->from('manager');
    $this->db->join('bukubesar', 'bukubesar.kode = manager.kode_id');
    $this->db->join('produk', 'produk.kode_id= manager.kode_id');
    return $this->db->get();
  }

  public function getSearch($getData = '')
  {
    $start_date = $getData['start_date'];
    $end_date = $getData['end_date'];
    $sql = "SELECT
    `manager`.`no_invoice`,
    `bukubesar`.`tgl`,
    `produk`.`hargasetoran`,
    `bukubesar`.`tutup_buku`
  FROM
    manager
  LEFT JOIN bukubesar ON
     `bukubesar`.`kode` = `manager`.`kode_id`
  LEFT JOIN produk ON
    `produk`.`kode_id` = `manager`.`kode_id` 
    WHERE `bukubesar`.`tgl` BETWEEN '$start_date' AND '$end_date'";
    $query = $this->db->query($sql);
  
    return $query->result_array();
  }

  function fetchData($weekending, $jabatan, $manager) {
    // if ($weekending && $jabatan && $manager) {
      $this->db->select('manager.*, daftarmitra.nama as mitra, gudang.nama as gudang');
      $this->db->from('manager');
      $this->db->where('manager.tgl', $weekending);
      $this->db->where('daftarmitra.nama', $manager);
      $this->db->where('daftarmitra.jabatan', $jabatan);
      $this->db->join('daftarmitra','daftarmitra.kode_id=manager.kode_id');
      $this->db->join('gudang','gudang.nama=daftarmitra.gudang');
      return $this->db->get()->result_array();
    // }
  }

    function kode_barang() {
      $gudang = $this->session->userdata("gudang");
      $this->db->select('produk.kode');
      $this->db->from('produk');
      $this->db->where('produk.gudang', $gudang);
      return $this->db->get()->result_array();
    }

    function barang($barang) {
      $kode_id = $this->session->userdata("kode_id");
      $gudang = $this->session->userdata("gudang");
      $this->db->select('produk.nama, produk.qty, produk.hargasetoran, produk.sebelumpajak');
      $this->db->from('produk');
      $this->db->where('produk.gudang', $gudang);
      $this->db->where('produk.kode', $barang);
      return $this->db->get()->result_array();
    }
	
    public function latest_no_invoice() {
      $this->db->select('no_invoice');
      $this->db->order_by('no_invoice', 'DESC');
      $this->db->limit(1);
      $this->db->from('manager');
      return $this->db->get()->result_array();
    }

    public function tambahDataPenjualanManager() {
      // $latest_no_invoice = $this->input->post('latest_no_invoice');
      $latest_no_invoice = ((int)"00999" + 1);
      $latest_no_invoice = (string)$latest_no_invoice;
      $no_invoice = "INV/".date('ymd')."/";
      $jmlNol = 0;

      for ($i = 0; $i < strlen($latest_no_invoice); $i++) {
        if ($latest_no_invoice[$i] != "0") {
          $no_invoice .= str_repeat("0", $jmlNol).((int)substr($latest_no_invoice, $i) + 1);
          break;
        } else {
          $jmlNol++;
        }
      }

      echo $no_invoice;
      die;
        $data = [
            "id" => "",
            "kode_id" => $this->session->userdata('kode_id'),
            "tgl" => "up",
            "no_invoice" => $no_invoice,
            "kode" => $this->input->post('kode',true),
            "nama" => $this->input->post('nama',true),
            "qty" => $this->input->post('qty',true),
            "otc" => $this->input->post('otc', true),
            "totalotc" => $this->input->post('otc',true) * $this->input->post('qty',true),
            "ftc" => $this->input->post('ftc',true),
            "totalftc" => $this->input->post('ftc',true) * $this->input->post('qty',true),
            "telah_diproses" => "N"
        ];

        $data2 = [
          "id" => "",
          "tgl" => "up",
          "manager" => $this->session->userdata("name"),
          "cabang" => $this->session->userdata("gudang"),
          "jumlah_deposit" => $this->input->post('ftc',true) * $this->input->post('qty',true),
          "jumlah_pengeluaran" => 0,
          "total_deposit" => $this->input->post('ftc',true) * $this->input->post('qty',true),
          "status" => "Aman",
          "kode_id" => $this->session->userdata("kode_id")
        ];

        $this->db->insert('manager', $data);
        $this->db->insert('deposit', $data2);
    }

    public function tambahDataPenjualanManagerBaru($data) {
      $this->db->insert('manager', $data);
    }

    public function tambahInOut($kode_id, $no_invoice, $keterangan, $jenis, $jumlah, $akun) {
      if (explode(" ", $jenis)[0] == "Pemasukan") {
        $data = [
          'id' => null,
          'tgl' => 'up',
          'no_invoice' => $no_invoice,
          'kode_id' => $kode_id,
          'keterangan' => $keterangan,
          'jenis' => $jenis,
          'debit' => $jumlah,
          'kredit' => 0,
          'akun' => $akun
        ];
      } else {
        $data = [
          'id' => null,
          'tgl' => 'up',
          'no_invoice' => $no_invoice,
          'kode_id' => $kode_id,
          'keterangan' => $keterangan,
          'jenis' => $jenis,
          'debit' => 0,
          'kredit' => $jumlah,
          'akun' => $akun
        ];
      }
      $this->db->insert('inout_manager', $data);
    }

    public function editInOut($id, $keterangan, $jenis, $jumlah, $akun) {
      if (explode(" ", $jenis)[0] == "Pemasukan") {
        $data = [
          'keterangan' => $keterangan,
          'jenis' => $jenis,
          'debit' => $jumlah,
          'kredit' => 0,
          'akun' => $akun
        ];
      } else {
        $data = [
          'keterangan' => $keterangan,
          'jenis' => $jenis,
          'debit' => 0,
          'kredit' => $jumlah,
          'akun' => $akun
        ];
      }
      $this->db->set($data);
      $this->db->where('id', $id);
      $this->db->update('inout_manager');
    }

    public function hapusInOut($id) {
      return $this->db->delete('inout_manager', ['id' => $id]);
    }

    public function getInOut($id) {
      return $this->db->get_where('inout_manager', ['id' => $id])->result_array();
    }

    public function getData($id) {
      $this->db->select('manager.*, produk.qty as stok, produk.gudang');
      $this->db->from('manager');
      // $this->db->from('manager');
      $this->db->where('manager.id', $id);
      // $this->db->where('manager.kode', 'produk.kode');
      $this->db->join('produk', 'manager.kode_id=produk.kode_id');
      // $this->db->where('gudang.nama', 'produk.gudang');
      return $this->db->get()->result_array();
    }

    public function prosesInvoice($no_invoice) {
      $this->db->set('telah_diproses', 'Y');
      $this->db->where('no_invoice', $no_invoice);
      $this->db->update('manager');
    }

    public function getKaryawanById($id){
        return $this->db->get_where('manager',['id'=>$id])->row_array();
    }
    public function hapusDataKaryawan($id){
        $this->db->where('id',$id);
        $this->db->delete('manager');
    }
    public function ubahDataKaryawan(){
        $data = [
            "kode_id" => $this->input->post('kode_id',true),
            "nama" => $this->input->post('nama',true),
            "tgl_lahir" => $this->input->post('tgl_lahir',true),
            "jabatan" => $this->input->post('jabatan',true),
            "thn_gabung" => $this->input->post('thn_gabung',true),
            "alamat" => $this->input->post('alamat',true),
            "kota" => $this->input->post('kota',true),
            "no_telp" => $this->input->post('no_telp',true),
            "email" => $this->input->post('email',true),
        ];
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('manager',$data);
    }
    public function cariDataKaryawan(){
        $keyword = $this->input->post('keyword',true);
        $this->db->like('nama',$keyword);
        $this->db->or_like('jabatan',$keyword);
        $this->db->or_like('alamat',$keyword);
        return $this->db->get('manager')->result_array();
    }

    public function getMitra()
    {
      $query = $this->db->query('SELECT `name`,`kode` FROM daftar_mitra LEFT JOIN users ON daftar_mitra.kode = users.kode_id')->row();
      return $query;
    }
}