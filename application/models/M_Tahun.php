<?php

class M_tahun extends CI_Model{
    public function tampil_data(){
        return $this->db->get('tbl_tahun')->result_array();
    }
    public function tambahDataTahun(){
      $data = [
        "year" => $this->input->post('year',true),
        "description" => $this->input->post('description',true),
        "is_active" => $this->input->post('is_active',true)
    ];
    $this->db->insert('tbl_tahun',$data);
    }
    public function getTahunById($id){
      return $this->db->get_where('tbl_tahun',['id'=>$id])->row_array();
  }
  public function hapusDataTahun($id){
      $this->db->where('id',$id);
      $this->db->delete('tbl_tahun');
  }
  public function ubahDataTahun(){
      $data = [
        "year" => $this->input->post('year',true),
        "description" => $this->input->post('description',true),
        "is_active" => $this->input->post('is_active',true)
      ];
      $this->db->where('id',$this->input->post('id'));
      $this->db->update('tbl_tahun',$data);
  }
    public function hitungJumlahAsset(){

    $query = $this->db->get('tbl_tahun');
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
?>