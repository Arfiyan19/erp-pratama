<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_JabatanMitra
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

class M_JabatanMitra extends CI_Model {

  protected $table = 'jabatan_mitra';

  public function __construct()
  {
    parent::__construct();
    $this->load->dbforge();
    // $this->up();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function getAllData()
  {
    return $this->db->get($this->table)->result_array();
  }

  public function create($data)
  {
    // $this->db->db_debug = false;
    // $query = $this->db->insert($this->table,$data);
    // if(!@$this->db->query($query))
    // {
    //   $error = $this->db->error();
    //   // do something in error case
    // }else{
    //   // do something in success case
    // }

    return $this->db->insert($this->table,$data);
  }

  public function view($id, $limit="", $offset="")
  {
    return $this->db->get_where($this->table, array('id' => $id), $limit, $offset)->row();
    // $this->db->get()->result();
  }

  public function update($id, $data)
  {
    return $this->db->update($this->table, $data, array('id' => $id));
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete($this->table);
  }

  public function getLastIndex(){
    // $this->db->select_max('docid')->from($this->table);
    // $query = $this->db->get();
    $this->db->select_max('kode');
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function up()
  {
    $fields = array(
      'kode' => array(
        'type' => 'VARCHAR',
        'constraint' => 10,
        'after' => 'id',
        'unique' => TRUE
      )
    );
    // echo json_encode($fields);
    return $this->dbforge->add_column($this->table, $fields);
  }

  public function down()
  {
    $this->dbforge->drop_column($this->table, 'kode');
  }

}

/* End of file M_jabatanmitra.php_model.php */
/* Location: ./application/models/M_jabatanmitra.php_model.php */