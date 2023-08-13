<?php

class M_rekening extends CI_Model{
    public function tampil_data(){
        return $this->db->get('tbl_rekening')->result_array();
    }
    public function tambahDataRekening(){
      $data = [
        "name" => $this->input->post('name',true),
        "id_chartofaccount" => $this->input->post('id_chartofaccount',true)
    ];
    $this->db->insert('tbl_rekening',$data);
    }
    public function getRekeningById($id){
      return $this->db->get_where('tbl_rekening',['id'=>$id])->row_array();
  }
  public function hapusDataRekening($id){
      $this->db->where('id',$id);
      $this->db->delete('tbl_rekening');
  }
  public function ubahDataRekening(){
      $data = [
        "name" => $this->input->post('name',true),
        "id_chartofaccount" => $this->input->post('id_chartofaccount',true)
      ];
      $this->db->where('id',$this->input->post('id'));
      $this->db->update('tbl_rekening',$data);
  }
    public function hitungJumlahAsset(){

    $query = $this->db->get('tbl_rekening');
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