<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adjust_stok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_barang', 'M_AdjustStok']);
        $this->load->library('form_validation');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu Stok_akhir';
        // $data['produk'] = $this->m_barang->tampil_data();
        $data['dataAdjust'] = $this->M_AdjustStok->getDataAdjust();
        $this->load->view('templates/header', $topik);
        $this->load->view('adjuststok/index', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Stok_akhir';
        $data['databrg'] = $this->m_barang->show_barang();

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_penyesuaian', 'No Return', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('gudang_asal', 'Gudang Asal', 'required');
        $this->form_validation->set_rules('gudang_tujuan', 'Gudang Tujuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('adjuststok/tambah');
        } else {
            $result = $this->M_AdjustStok->tambahDataStok_akhir();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            echo json_encode($result);
        }
    }

    public function edit($id = NULL)
    {
        $topik['judul'] = 'Edit Data Stok Akhir';
        $data = [
            'all_gudang' => $this->M_AdjustStok->getAllGdg(),
            'dataAdjust' =>  $this->M_AdjustStok->getAdjustById($id),
            'dataAdjustDetail' => $this->M_AdjustStok->getAdjustDetailById($id),
            'databrg' => $this->m_barang->show_barang(),
        ];

        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_penyesuaian', 'No Penyesuaian', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('gudang_asal', 'Gudang Asal', 'required');
        $this->form_validation->set_rules('gudang_tujuan', 'Gudang Tujuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $topik);
            $this->load->view('adjuststok/edit', $data);
        } else {
            $result = $this->M_AdjustStok->ubahDataAdjustStok();
            $this->session->set_flashdata('flash', 'Diubah');
            echo json_encode($result);
        }
    }

    public function getLatestNoTf()
    {
        $result = $this->M_AdjustStok->getLatestNoTf();
        if ($result == '') {
            echo json_encode("0001/ADJ/" . date('Y'));
        } else {
            $idx = explode('/', $result['no_penyesuaian']);
            $kode = (int)substr($idx[0], -1, 4) + 1;
            $firsthalf = str_repeat('0', 4 - strlen((string)$kode)) . $kode . "/ADJ" . "/" . date('Y');
            echo json_encode($firsthalf);
        }
    }

    public function hapus($id)
    {
        $this->M_AdjustStok->hapusDataAdjustStok($id);
        $this->session->set_flashdata('flash2', 'Dihapus');
        redirect('adjust_stok');
    }
}
