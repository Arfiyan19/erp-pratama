<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_mitra_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class M_mitra extends CI_Model {

  

  public function __construct()
  {
    parent::__construct();
  }

  public function tampil_data() {
    if ($this->session->userdata('id_role') === "2") {
      return $this->db->get_where('pengiriman', ['gudang_asal' => $this->session->userdata('gudang')]);
    } else {
        return $this->db->get('pengiriman');
    }
}

public function kode(){
  $this->db->select('RIGHT(daftar_mitra.id,2) as id', FALSE);
  $this->db->order_by('id','DESC');    
  $this->db->limit(1);    
  $query = $this->db->get('daftar_mitra');  //cek dulu apakah ada sudah ada kode di tabel.    
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
    return $this->db->get_where('daftar_mitra', ['gudang' => "Head Office"]);
}
  return $this->db->get('daftar_mitra');
}
}

/* End of file M_mitra_model.php */
/* Location: ./application/models/M_mitra_model.php */