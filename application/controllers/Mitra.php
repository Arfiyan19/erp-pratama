<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_mitra');
  }

  public function index()
  {
        $topik['judul'] = 'Daftar Pengiriman Mitra';
        $x['data1'] = $this->M_mitra->tampil_data();
				$x['kode'] = $this->M_mitra->kode();
				$x['data'] = $this->M_mitra->tampil_datamitra();
        $this->load->view('templates/header',$topik);
        $this->load->view('mitra/index',$x);
        $this->load->view('templates/footer');
  }

}


/* End of file Mitra.php */
/* Location: ./application/controllers/Mitra.php */