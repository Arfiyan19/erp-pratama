<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller JabatanMitra
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Jabatan extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    
    $this->load->model('M_JabatanMitra');

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>');

    if ($this->session->userdata('id_role') != 1) {
      redirect('auth/login', 'refresh');
    }
  }

  public function index()
  {
    $topik['judul'] = 'Jabatan Mitra';
    $data['judul'] = $topik['judul'];       
    $data['jabatanList'] = $this->M_JabatanMitra->getAllData();

		$this->load->view('templates/header',$topik);
    $this->load->view('jabatan/index',$data);
    $this->load->view('templates/footer');
  }

  public function edit($id)
  {
    $topik['judul'] = 'Jabatan Mitra';
    $data['judul'] = $topik['judul'];       
    $data['jabatanList'] = $this->M_JabatanMitra->view($id);
    // echo json_encode($data['jabatanList']);

    if($this->input->post())
    {
      $post = $this->input->post();
      // echo json_encode($post);
      $this->form_validation->set_rules('kode', 'Kode', 'required');
      $this->form_validation->set_rules('name', 'Nama Jabatan', 'required');
      if ($this->form_validation->run() == TRUE)
      {
        // echo "OK";
        $this->M_JabatanMitra->update($post['id'], array(
          'kode' => $post['kode'],
          'name' => $post['name']
        ));
        
        $this->session->set_flashdata('success', 'Update Jabatan berhasil!');
        redirect('jabatan/edit/' . $id, 'refresh');
      }
    }

		$this->load->view('templates/header',$topik);
    $this->load->view('jabatan/view',$data);
    $this->load->view('templates/footer');
  }

  public function create(){
    if($this->input->post())
    {
      $post = $this->input->post();
      // echo json_encode($post);
      $this->form_validation->set_rules('kode', 'Kode', 'required');
      $this->form_validation->set_rules('name', 'Nama Jabatan', 'required');
      if ($this->form_validation->run() == TRUE)
      {
        $this->M_JabatanMitra->create(array(
          'kode' => $post['kode'],
          'name' => $post['name']
        ));
        
        // $this->session->set_flashdata('success', 'Update Jabatan berhasil!');
        // redirect('jabatan', 'refresh');

        // response as ajax
        $response = array(
          'msg' => 'Jabatan berhasil tersimpan!',
          'success' => true,
        );

      } else {
        // echo "Error";
        $response = array(
          'msg' => 'Error!',
          'success' => false,
        );
      }

      echo json_encode($response);
    }
  }

  public function hapus($id)
  {
    $query = $this->M_JabatanMitra->delete($id);        
    // $this->session->set_flashdata('success', 'Jabatan berhasil dihapus!');
    // redirect('jabatan', 'refresh');

    $response = array(
      'msg' => 'Jabatan berhasil dihapus!',
      'success' => true,
    );

    echo json_encode($response);
  }

  public function getkode()
  {
    $jsonArr = $this->M_JabatanMitra->getLastIndex();
    $docno = array_column($jsonArr, 'kode');
    $num = preg_replace('/\D/', '', $docno[0]);
    $newKode = "JM" . str_pad((int)$num+1, 3, '0', STR_PAD_LEFT);
    $response = array(
      'kode' => $newKode,
      'success' => true
    );

    // echo json_encode($response);
    echo ($newKode);
  }

}


/* End of file JabatanMitra.php */
/* Location: ./application/controllers/JabatanMitra.php */