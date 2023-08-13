<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_override
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

class M_override extends CI_Model {

  protected $table = 'overrides';

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function getAllData()
  {
    return $this->db->get($this->table)->result_array();
  }

  // ------------------------------------------------------------------------

}

/* End of file M_override_model.php */
/* Location: ./application/models/M_override_model.php */