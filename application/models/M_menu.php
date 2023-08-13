<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model {

  public function getMenu()
  {
    $query = $this->db->get('menu')->result_array();
    return $query;
  }

  public function getSubMenu()
  {
      $query = $this->db->get('tbl_sub_menu')->result_array();
      return $query;
  }

  public function getRole()
  {
    $query = $this->db->get('tbl_role')->result_array();
    return $query;
  }
}

/* End of file M_menu_model.php */
/* Location: ./application/models/M_menu_model.php */