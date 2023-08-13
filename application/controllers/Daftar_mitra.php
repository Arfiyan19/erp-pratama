<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Daftar_mitra extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_daftar');
        $this->load->library('form_validation');
    }
    
    public function index(){
        $topik['judul'] = 'Halaman Menu Daftar Mitra';
        $data['daftarmitra'] = $this->M_daftar->tampil_data()->result_array();
        if ($this->input->post('keyword')) {
            $data['daftar_mitra'] = $this->M_daftar->cariDataSupplier();
        }
        $this->load->view('templates/header',$topik);
        $this->load->view('daftarmitra/index',$data);
        $this->load->view('templates/footer');
    }
    public function tambah(){
        $data2['judul'] = 'Form Tambah Data Daftar Mitra';

        $this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('tgl_lahir','Tgl_lahir','required');
        $this->form_validation->set_rules('jabatan','Jabatan','required');
        $this->form_validation->set_rules('promoter','Promoter','required');
        $this->form_validation->set_rules('thn_gabung','Thn_gabung','required');
        $this->form_validation->set_rules('gudang','Gudang','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('kota','Kota','required');
        $this->form_validation->set_rules('telepon','Telepon','required');
        $this->form_validation->set_rules('email','email','required');

        if ($this->form_validation->run() == FALSE) {
            $dariDB = $this->M_daftar->cekkodedaftar_mitra();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($dariDB, 5, 4);
            $kodeMitraSekarang = $nourut + 1;
            $data = array("kode" => $kodeMitraSekarang);
            $data['daftarmitra'] = $this->M_daftar->tampil_data()->result_array();
            $data['promoter'] = $this->M_daftar->tampil_promoter();
            $data['jabatan'] = $this->M_daftar->tampil_jabatan();
            $data['gudang'] = $this->M_daftar->tampil_gudang();
            
            // $data['jabatan'] = ['Vice President','Divisional Manager','Branch Manager','Tenant Manager','Assistant Manager','Win-win Manager','Top Leader','Leader'];
            $this->load->view('templates/header',$data2);
            $this->load->view('daftarmitra/tambah',$data);
            $this->load->view('templates/footer');
        }else {
            $this->M_daftar->tambahDataMitra();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('daftar_mitra');
        }
        
    }
    public function hapus($id){
        $this->M_supplier->hapusDataSupplier($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('supplier');
    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Supplier';
        $data['supplier'] = $this->M_supplier->getSupplierById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('telepon','Telepon','required');
        

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$topik);
            $this->load->view('supplier/edit',$data);
        }else {
            $this->M_supplier->ubahDataSupplier();
            $this->session->set_flashdata('flash','Diubah');
            redirect('supplier');
        }
    }
    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('Maulana Hidayat - re:code lab')
            ->setLastModifiedBy('Maulana Hidayat - re:code lab')
            ->setTitle('Tes Export Excel')
            ->setSubject('Tes Export Excel')
            ->setDescription('Tes Export Excel')
            ->setKeywords(' Tes Export Excel')
            ->setCategory('Test export excel');

    //Add data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Tanggal Lahir')
            ->setCellValue('D1', 'Jabatan')
            ->setCellValue('E1', 'Promoter')
            ->setCellValue('F1', 'Tahun Gabung')
            ->setCellValue('G1', 'Gudang')
            ->setCellValue('H1', 'Alamat')
            ->setCellValue('I1', 'Kota');

        $i = 2;

        // $mahasiswa = $this->model_mahasiswa->getAll();
        $produk = $this->M_daftar->tampil_data();

        foreach ($produk as $erp) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $erp['nama'])
                ->setCellValue('B' . $i, $erp['lokasi'])
                ->setCellValue('C' . $i, $erp['poin'])
                ->setCellValue('D' . $i, $erp['omzet']);
                // ->setCellValue('G' . $i, $erp->alamat);
            $i++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Report Excel' . date('Y-m-d'));
        $spreadsheet->setActiveSheetIndex(0);

    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
        header('Cache-Control: max-age=0');

        header('Cache-Control: max-age=1');


        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;

    }
}