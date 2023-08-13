<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_barang');
        $this->load->model('M_kategori');
        $this->load->model('M_gudang');
        $this->load->model('M_karyawan');
        $this->load->model('M_override');
        $this->load->model('M_JabatanMitra');
        // $this->check_login();
        if ($this->session->userdata('id_role') != 1) {
            redirect('auth/login', 'refresh');
        }
    }
	public function index()
	{
        $topik['judul'] = 'Halaman Dashboard';
        $data['produk'] = $this->M_barang->hitungJumlahAsset();
        $data['tbl_category'] = $this->M_kategori->hitungJumlahAsset();
        $data['gudang'] = $this->M_gudang->hitungJumlahAsset();
        $data['karyawan'] = $this->M_karyawan->hitungJumlahAsset();

		$this->load->view('templates/header',$topik);
        $this->load->view('dashboard/index',$data);
        // $this->load->view('dashboard/index');
        $this->load->view('templates/footer');
    }

    public function Override() {
        $topik['judul'] = 'Override';
        $data['judul'] = $topik['judul'];       
        $data['overrides'] = $this->M_override->getAllData();
        $data['jabatanList'] = $this->M_JabatanMitra->getAllData();

		$this->load->view('templates/header',$topik);
        $this->load->view('dashboard/override',$data);
        $this->load->view('templates/footer');
    }

    public function Override_Saldo(){
        $topik['judul'] = 'Saldo Override';
        $data['judul'] = $topik['judul'];       
        $data['overrides'] = $this->M_override->getAllData();       

		$this->load->view('templates/header',$topik);
        $this->load->view('dashboard/override_saldo',$data);
        $this->load->view('templates/footer');
    }

    public function getkode_override()
    {
        // OV-00001
        $jsonArr = $this->M_JabatanMitra->getLastIndex();
        $docno = array_column($jsonArr, 'kode');
        $num = preg_replace('/\D/', '', $docno[0]);
        $newKode = "OV" . str_pad((int)$num+1, 5, '0', STR_PAD_LEFT);

        echo ($newKode);
    }
   
}
