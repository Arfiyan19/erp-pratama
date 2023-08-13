<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Juice_4u extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('m_juice');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Juice4U';
        // $data['produk'] = $this->m_juice->get_by_role();
        // if ($this->input->post('keyword')) {
        //     $data['produk'] = $this->m_jurnalumum->cariDataBarang();
        // }
        $data['tgl'] = $this->get_tgl();
        // if ($this->input->post('keyword')) {
        //     $data['gudang'] = $this->m_gudang->cariDataGudang();
        // }
        $this->load->view('templates/header',$topik);
        $this->load->view('juice/index',$data);
        $this->load->view('templates/footer');
    }

    public function get_tgl() {
        return $this->m_juice->get_tgl();
    }

    public function getDataById($id) {
        echo json_encode($this->m_juice->getDataById($id));
    }

    public function tampil_data($weekending = NULL) {
        echo json_encode($this->m_juice->tampil_data($weekending));
    }

    public function tambah(){
        
        $data['judul'] = 'Form Tambah Data';

        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('lokasi','Lokasi','required');
        $this->form_validation->set_rules('point','Point','required');
        $this->form_validation->set_rules('omzet','Omzet','required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$data);
            $this->load->view('juice/tambah');
        }else {
            $this->m_juice->tambahDataJuice();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('juice_4u');
        }
    }

    public function edit() {
        $this->form_validation->set_rules('nama2','Nama','required');
        $this->form_validation->set_rules('lokasi2','Lokasi','required');
        $this->form_validation->set_rules('point2','Point','required');
        $this->form_validation->set_rules('omzet2','Omzet','required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$data);
            $this->load->view('juice/edit');
        } else {
            $this->m_juice->editDataJuice();
            $this->session->set_flashdata('flash','Diedit');
            redirect('juice_4u');
        }
    }
   
    public function hapus($id){
        $this->m_juice->hapusDataJuice($id);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('juice_4u');
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
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'Lokasi')
            ->setCellValue('C1', 'Point')
            ->setCellValue('D1', 'Omzet');

        $i = 2;

        // $mahasiswa = $this->model_mahasiswa->getAll();
        $produk = $this->m_juice->tampil_semua_data();

        foreach ($produk as $erp) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $erp['nama'])
                ->setCellValue('B' . $i, $erp['lokasi'])
                ->setCellValue('C' . $i, $erp['point'])
                ->setCellValue('D' . $i, $erp['omzet']);
                // ->setCellValue('G' . $i, $erp->alamat);
            $i++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Report Excel Juice 4U' . date('Y-m-d'));
        $spreadsheet->setActiveSheetIndex(0);

    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report Excel Juice 4U.xlsx"');
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