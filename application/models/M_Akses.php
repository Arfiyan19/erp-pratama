<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Akses extends CI_Model
{

  public function tambahHakAkses()
  {
    $data = [];

    foreach ($this->db->get('tbl_menu')->result() as $menu) {
      $data2  = [];
      foreach ($this->db->get_where('tbl_submenu', ['id_menu' => $menu->id])->result() as $submenu) {
        $data2[] = [
          $submenu->sub_menu => [
            'akses' => $this->input->post($menu->id . '_' . $submenu->id . 'akses'),
            'create'  => $this->input->post($menu->id . '_' . $submenu->id . 'create'),
            'update' => $this->input->post($menu->id . '_' . $submenu->id . 'update'),
            'delete' => $this->input->post($menu->id . '_' . $submenu->id . 'delete')
          ]
        ];
      }

      $data[$menu->menu] = $data2;
    }

    $data = [
      'name' => $this->input->post('name', true),
      'akesUser' => json_encode($data),
      'id_sub_menu' => ('1'),
      'role_id' => $this->input->post('role', true)
    ];

    $this->db->insert('tbl_akses', $data);
  }


  public function list_menu()
  {
    $menu = $this->db->where('aktif', '1')->get('tbl_sub_menu')->result_array();
    foreach ($menu as $mn) {
      $ada = false;
      foreach ($this->list_akses() as $a) {
        if ($mn['id'] == $a['id_sub_menu']) {
          $ada = true;
        }
      }
      if (!$ada) {
        $insert[] = [
          'id_sub_menu' => $mn['id'],
          'id_role' => $this->input->post('id_role'),
          'akses' => '0',
          'tambah' => '0',
          'update' => '0',
          'delete' => '0',
        ];
      }
    }
    if (isset($insert)) {
      $this->db->insert_batch('tbl_akses', $insert);
    }
    // return $this->input->post('id_role');
    return $this->db->select('m.nama_sub_menu,a.*')
      ->from('tbl_sub_menu m')
      ->join('tbl_akses a', 'm.id = a.id_sub_menu')
      ->where('a.id_role', $this->input->post('id_role', true))
      ->get()->result_array();
  }
  public function list_akses()
  {
    return $this->db->get_where('tbl_akses', ['id_role' => $this->input->post('id_role')])->result_array();
  }
  public function list_user()
  {
    return $this->db->get_where('tbl_akses', ['id_role' => $this->input->post('id_role')])->result_array();
  }
  public function list_name()
  {
    return $this->db->get_where('tbl_role', ['id' => $this->input->post('id_role')])->result_array();
  }

  public function simpan()
  {
    $list = $this->list_menu();
    $no = 0;
    foreach ($list as $ls) {
      $data[] = [
        'id_sub_menu' => $ls['id_sub_menu'],
        'tambah' => ($this->input->post('tambah' . $no) ? 1 : 0),
        'akses' => ($this->input->post('akses' . $no) ? 1 : 0),
        'update' => ($this->input->post('update' . $no) ? 1 : 0),
        'delete' => ($this->input->post('delete' . $no) ? 1 : 0),
      ];
      $this->db->where('id_role', $this->input->post('id_role'));
      $this->db->update_batch('tbl_akses', $data, 'id_sub_menu');
      $no++;
    }

    return $data;
  }

  public function getJabatan()
  {
    return $this->db->get_where('karyawan', 'jabatan')->result();
  }
}

/* End of file M_Akses_model.php */
/* Location: ./application/models/M_Akses_model.php */