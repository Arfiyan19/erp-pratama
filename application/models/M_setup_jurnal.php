<?php

class M_setup_jurnal extends CI_Model
{
  public function tampil_data()
  {
    return $this->db->get('tbl_setup_jurnal')->result_array();
  }
  public function tambahDataSetupJurnal($dataSetupJurnal)
  {
    $this->db->insert('tbl_setup_jurnal', $dataSetupJurnal);
    $setupJurnalID = $this->db->insert_id();

    $anggarans = $this->input->post('elemenjurnalAnggaran', true);
    for ($i = 0; $i < count($anggarans); $i++) {
      $anggaran = [
        "elemen" => $anggarans[$i],
        "tipe" => $this->input->post('d/kjurnalAnggaran', true)[$i],
        "nominal" => $this->input->post('nominaljurnalAnggaran', true)[$i],
        "setup_jurnal_id" => $setupJurnalID,
      ];

      $this->db->insert('tbl_setup_jurnal_anggaran', $anggaran);
    }

    $finansials = $this->input->post('elemenjurnalFinansial', true);
    for ($i = 0; $i < count($finansials); $i++) {
      $finansial = [
        "elemen" => $finansials[$i],
        "tipe" => $this->input->post('d/kjurnalFinansial', true)[$i],
        "nominal" => $this->input->post('nominaljurnalFinansial', true)[$i],
        "setup_jurnal_id" => $setupJurnalID,
      ];

      $this->db->insert('tbl_setup_jurnal_finansial', $finansial);
    }
  }

  public function getSetupJurnalById($id)
  {
    return $this->db->get_where('tbl_setup_jurnal', ['id' => $id])->row_array();
  }

  public function getSetupJurnalAnggaranById($id)
  {
    return $this->db->get_where('tbl_setup_jurnal_anggaran', ['setup_jurnal_id' => $id])->result_array();
  }

  public function getSetupJurnalFinansialById($id)
  {
    return $this->db->get_where('tbl_setup_jurnal_finansial', ['setup_jurnal_id' => $id])->result_array();
  }

  public function getSetupJurnalByFormulir($formulir)
  {
    return $this->db->get_where('tbl_setup_jurnal', ['formulir' => $formulir])->row_array();
  }

  public function hapusDataSetupJurnal($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('tbl_setup_jurnal');

    $this->db->where('setup_jurnal_id', $this->input->post('id'));
    $this->db->delete('tbl_setup_jurnal_anggaran');

    $this->db->where('setup_jurnal_id', $this->input->post('id'));
    $this->db->delete('tbl_setup_jurnal_finansial');
  }

  public function ubahDataSetupJurnal($dataSetupJurnal)
  {
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('tbl_setup_jurnal', $dataSetupJurnal);

    $this->db->where('setup_jurnal_id', $this->input->post('id'));
    $this->db->delete('tbl_setup_jurnal_anggaran');
    $anggarans = $this->input->post('elemenjurnalAnggaran', true);
    for ($i = 0; $i < count($anggarans); $i++) {
      $anggaran = [
        "elemen" => $anggarans[$i],
        "tipe" => $this->input->post('d/kjurnalAnggaran', true)[$i],
        "nominal" => $this->input->post('nominaljurnalAnggaran', true)[$i],
        "setup_jurnal_id" => $this->input->post('id'),
      ];

      $this->db->insert('tbl_setup_jurnal_anggaran', $anggaran);
    }

    $this->db->where('setup_jurnal_id', $this->input->post('id'));
    $this->db->delete('tbl_setup_jurnal_finansial');
    $finansials = $this->input->post('elemenjurnalFinansial', true);
    for ($i = 0; $i < count($finansials); $i++) {
      $finansial = [
        "elemen" => $finansials[$i],
        "tipe" => $this->input->post('d/kjurnalFinansial', true)[$i],
        "nominal" => $this->input->post('nominaljurnalFinansial', true)[$i],
        "setup_jurnal_id" => $this->input->post('id'),
      ];

      $this->db->insert('tbl_setup_jurnal_finansial', $finansial);
    }
  }

  public function hitungJumlahAsset()
  {

    $query = $this->db->get('tbl_setup_jurnal');
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }
}
