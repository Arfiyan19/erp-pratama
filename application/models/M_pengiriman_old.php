<?php

class M_pengiriman extends CI_Model{
    public function tampil_data() {
        if ($this->session->userdata('id_role') === "2") {
        	return $this->db->get_where('pengiriman', ['gudang_asal' => $this->session->userdata('gudang')]);
        } else {
            return $this->db->get('pengiriman');
        }
    }
	
	function tampil_barang() {
	    if ($this->session->userdata('id_role') === "2") {
	        return $this->db->get_where('produk', ['gudang' => $this->session->userdata('gudang')]);
	    }
        return $this->db->get('produk');
    }
    
    // public function cekStok($)
	
	function tampil_cetak(){
	 $this->db->select('*');
	 $this->db->from('pengiriman');
	 $this->db->order_by('id', 'DESC');
	 $this->db->limit(1);
	 $query = $this->db->get();
	 return $query->result();
	}
	
    public function tampil(){
     $hasil=$this->db->query("SELECT * FROM `pengiriman` ORDER BY id DESC  LIMIT 1");
		 return $hasil;
			}
	
	public function allGdg() {
	    $this->db->select('kode, nama, alamat');
	    return $this->db->get('gudang');
	}
	
	public function cekStok($id) {
	    $this->db->select('kode, gudang_asal');
	    $data = $this->db->get_where('pengiriman', ['id' => $id])->row_array();
	    
	    
	    $this->db->select('unitbagus, unitrusak');
	    return $this->db->get_where('produk', ['kode' => $data['kode'], 'gudang' => $data['gudang_asal']])->row_array();
	}
	
	public function kode(){
		  $this->db->select('RIGHT(daftarmitra.id,2) as id', FALSE);
		  $this->db->order_by('id','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('daftarmitra');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->id) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $tgl=date('d/'); 
			  $batas = str_pad($kode, 4, "PP/", STR_PAD_LEFT);    
			  $kodetampil = ""."".$tgl.$batas;  //format kode
			  return $kodetampil;  
		 }
	
	public function tampil_datamitra() {
        if ($this->session->userdata('id_role') === "2") {
	        return $this->db->get_where('daftarmitra', ['gudang' => "Head Office"]);
	    }
        return $this->db->get('daftarmitra');
    }
	
	
	function tampil_datamitra1(){
    $username=$this->session->userdata("username");
     $this->db->where('users.username',"$username");
	  $this->db->select('*');
	 $this->db->from('users');
	 $this->db->join('pengiriman','pengiriman.kode_id=users.kode_id');
	 $query = $this->db->get();
	 return $query->result_array();
	}
	
	function input_data($data,$table) {
		$this->db->insert($table,$data);
	}
	
	function update_data($where,$data,$table) {
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	
    public function tambahDataPengiriman() {
      $data = [
        "kode" => $this->input->post('kode',true),
        "nama" => $this->input->post('nama',true),
        "qty_karton" => $this->input->post('qty_karton',true),
        "qty_perkarton" => $this->input->post('qty_perkarton',true),
        "total" => $this->input->post('total',true),
        "qty_karton_rusak" => $this->input->post('qty_karton_rsk',true),
        "qty_perkarton_rusak" => $this->input->post('qty_perkarton_rsk',true),
        "total_rusak" => $this->input->post('total_rsk',true),
        "gudang_asal" => $this->input->post('gudang_asal',true),
        "gudang_tujuan" => $this->input->post('gudang_tujuan',true),
        "kepada" => $this->input->post('kepada',true),
        "alamat" => $this->input->post('alamat',true),
        "kota" => $this->input->post('kota',true),
        "no_telepon" => $this->input->post('no_telepon',true),
        "tanggal" => $this->input->post('tanggal',true),
        "no_do" => $this->input->post('no_do',true),
        "manager_gudang" => $this->input->post('manager_gudang',true),
        "no_kontainer" => $this->input->post('no_kontainer',true),
        "no_segel" => $this->input->post('no_segel',true),
        "kode_id" => $this->input->post('kode_id',true),
      ];
      $this->db->insert('pengiriman',$data);
    }
    public function getPengirimanById($id){
        return $this->db->get_where('pengiriman',['id'=>$id])->row_array();
    }
	
	
    public function hapusDataPengiriman($id){
        $this->db->where('id',$id);
        $this->db->delete('pengiriman');
    }
    public function ubahDataPengiriman(){
      $data = [
        "kode" => $this->input->post('kode',true),
        "nama" => $this->input->post('nama',true),
        "qty_karton" => $this->input->post('qty_karton',true),
        "qty_perkarton" => $this->input->post('qty_perkarton',true),
        "total" => $this->input->post('total',true),
        "qty_karton_rusak" => $this->input->post('qty_karton_rsk',true),
        "qty_perkarton_rusak" => $this->input->post('qty_perkarton_rsk',true),
        "total_rusak" => $this->input->post('total_rsk',true),
        "gudang_asal" => $this->input->post('gudang_asal',true),
        "gudang_tujuan" => $this->input->post('gudang_tujuan',true),
        "kepada" => $this->input->post('kepada',true),
        "alamat" => $this->input->post('alamat',true),
        "kota" => $this->input->post('kota',true),
        "no_telepon" => $this->input->post('no_telepon',true),
        "tanggal" => $this->input->post('tanggal',true),
        "no_do" => $this->input->post('no_do',true),
        "manager_gudang" => $this->input->post('manager_gudang',true),
        "no_kontainer" => $this->input->post('no_kontainer',true),
        "no_segel" => $this->input->post('no_segel',true),
        "kode_id" => $this->input->post('kode_id',true),
     ];
     $this->db->where('id', $this->input->post('id'));
     $this->db->update('pengiriman', $data);
   }
    public function cariDataKaryawan(){
        $keyword = $this->input->post('keyword',true);
        $this->db->like('nama',$keyword);
        $this->db->or_like('jabatan',$keyword);
        $this->db->or_like('alamat',$keyword);
        return $this->db->get('pengiriman')->result_array();
    }
}