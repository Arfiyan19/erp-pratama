<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Return_gudang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_returngudang', 'm_barang']);
        $this->load->library('form_validation');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu Return_gudang';
        $data['return_gudang'] = $this->m_returngudang->tampil_data();
        $this->load->view('templates/header', $topik);
        $this->load->view('return_gudang/index', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Return_gudang';
        $data['databrg'] = $this->m_barang->show_barang();

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_return', 'No Return', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('gudang_asal', 'Gudang Asal', 'required');
        $this->form_validation->set_rules('gudang_tujuan', 'Gudang Tujuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('return_gudang/tambah');
        } else {
            $result = $this->m_returngudang->tambahDataReturn_gudang();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            echo json_encode($result);
            // redirect('return_gudang');
        }
    }
    public function hapus($id)
    {
        $this->m_returngudang->hapusDataReturn_gudang($id);
        $this->session->set_flashdata('flash2', 'Dihapus');
        redirect('return_gudang');
    }
    public function edit($id = NULL)
    {
        $topik['judul'] = 'Edit Data Return_gudang';
        $data = [
            'all_gudang' => $this->m_returngudang->getAllGdg(),
            'return_gudang' =>  $this->m_returngudang->getReturn_gudangById($id),
            'return_gudang_detail' => $this->m_returngudang->getReturn_gudang_detailById($id),
            'databrg' => $this->m_barang->show_barang(),
        ];

        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_return', 'No Return', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('gudang_asal', 'Gudang Asal', 'required');
        $this->form_validation->set_rules('gudang_tujuan', 'Gudang Tujuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $topik);
            $this->load->view('return_gudang/edit', $data);
        } else {
            $result = $this->m_returngudang->ubahDataReturn_gudang();
            $this->session->set_flashdata('flash', 'Diubah');
            echo json_encode($result);
        }
    }

    public function getLatestNoTf()
    {
        $result = $this->m_returngudang->getLatestNoTf();
        if ($result == '') {
            echo json_encode("0001/Retur/" . date('Y'));
        } else {
            $idx = explode('/', $result['no_return']);
            $kode = (int)substr($idx[0], -1, 4) + 1;
            $firsthalf = str_repeat('0', 4 - strlen((string)$kode)) . $kode . "/Retur" . "/" . date('Y');
            echo json_encode($firsthalf);
        }
    }
}
