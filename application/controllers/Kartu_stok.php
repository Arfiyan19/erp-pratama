<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kartu_stok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_barang', 'M_KartuStok']);
        $this->load->library('form_validation');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu Kartu Stok';
        // $data['produk'] = $this->m_barang->tampil_data();
        $data = [
            'produk' => $this->m_barang->get_by_role(),
            'kodeProduk' => $this->M_KartuStok->getKodeProduk(),
            'gudangs' => $this->M_KartuStok->getGudang(),
        ];

        $this->load->view('templates/header', $topik);
        $this->load->view('kartustok/index', $data);
        $this->load->view('templates/footer');
    }

    public function getAllProduk()
    {
        $result = $this->M_KartuStok->getAllProduk();
        echo json_encode($result);
    }

    public function getProdukByFilter()
    {
        $kode = $this->input->post('kode');
        $gudang = $this->input->post('gudang');

        if ($kode == "all") {
            $result = $this->M_KartuStok->getAllProduk();
            echo json_encode($result);
        } else {
            $result = $this->M_KartuStok->getProdukByFilter($kode, $gudang);
            echo json_encode($result);
        }
    }
    //     public function tambah(){
    //         $data['judul'] = 'Form Tambah Data Stok_akhir';

    //         $this->form_validation->set_rules('kode','Kode','required');
    //         $this->form_validation->set_rules('nama','Nama','required');
    //         $this->form_validation->set_rules('alamat','Alamat','required');
    //         $this->form_validation->set_rules('telepon','Telepon','required');

    //         if ($this->form_validation->run() == FALSE) {
    //             $this->load->view('templates/header',$data);
    //             $this->load->view('barang/tambah');
    //         }else {
    //             $this->m_barang->tambahDataStok_akhir();
    //             $this->session->set_flashdata('flash','Ditambahkan');
    //             redirect('barang');
    //         }

    //     }
    //     public function hapus($id){
    //         $this->m_barang->hapusDataStok_akhir($id);
    //         $this->session->set_flashdata('flash2','Dihapus');
    //         redirect('barang');
    //     }
    //     public function edit($id){
    //         $topik['judul'] = 'Edit Data Stok_akhir';
    //         $data['barang'] = $this->m_barang->getStok_akhirById($id);
    //         // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

    //         $this->form_validation->set_rules('kode','Kode','required');
    //         $this->form_validation->set_rules('nama','Nama','required');
    //         $this->form_validation->set_rules('alamat','Alamat','required');
    //         $this->form_validation->set_rules('telepon','Telepon','required');


    //         if ($this->form_validation->run() == FALSE) {
    //             $this->load->view('templates/header',$topik);
    //             $this->load->view('barang/edit',$data);
    //         }else {
    //             $this->m_barang->ubahDataStok_akhir();
    //             $this->session->set_flashdata('flash','Diubah');
    //             redirect('barang');
    //         }
    // }
}
