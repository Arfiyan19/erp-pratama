<?php

class M_mapping_coa extends CI_Model{
    public function tampil_data(){
        return $this->db->get('tbl_mapping_coa')->result_array();
    }
    public function tambahDataMappingCOA(){
      $data = [
        "id_coa" => $this->input->post('id_coa',true),
        "id_coa_1" => $this->input->post('id_coa_1',true),
        "id_coa_2" => $this->input->post('id_coa_2',true),
        "id_coa_3" => $this->input->post('id_coa_3',true)
    ];
    $this->db->insert('tbl_mapping_coa',$data);
    }
    public function getMappingCOAById($id){
      return $this->db->get_where('tbl_mapping_coa',['id'=>$id])->row_array();
  }
  public function hapusDataMappingCOA($id){
      $this->db->where('id',$id);
      $this->db->delete('tbl_mapping_coa');
  }
  public function ubahDataMappingCOA(){
      $data = [
        "id_coa" => $this->input->post('id_coa',true),
        "id_coa_1" => $this->input->post('id_coa_1',true),
        "id_coa_2" => $this->input->post('id_coa_2',true),
        "id_coa_3" => $this->input->post('id_coa_3',true)
      ];
      $this->db->where('id',$this->input->post('id'));
      $this->db->update('tbl_mapping_coa',$data);
  }
    public function hitungJumlahAsset(){

    $query = $this->db->get('tbl_mapping_coa');
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