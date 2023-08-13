<?php

class M_kategori extends CI_Model{
    public function tampil_data(){
        return $this->db->get('tbl_category')->result_array();
    }
    public function tambahDataKategori(){
      $data = [
        "kode" => $this->input->post('kode',true),
        "name" => $this->input->post('name',true),
        "description" => $this->input->post('description',true)
    ];
    $this->db->insert('tbl_category',$data);
    }
    public function getKategoriById($id){
      return $this->db->get_where('tbl_category',['id'=>$id])->row_array();
  }
  public function hapusDataKategori($id){
      $this->db->where('id',$id);
      $this->db->delete('tbl_category');
  }
  public function ubahDataKategori(){
      $data = [
          "kode" => $this->input->post('kode',true),
          "name" => $this->input->post('name',true),
          "description" => $this->input->post('description',true),

      ];
      $this->db->where('id',$this->input->post('id'));
      $this->db->update('tbl_category',$data);
  }
    public function hitungJumlahAsset(){

    $query = $this->db->get('tbl_category');
    if($query->num_rows()>0)
    {
      return $query->num_rows();
    }
    else
    {
      return 0;
    }
    }
}
