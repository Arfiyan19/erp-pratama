<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('m_pengeluaran');
        $this->load->model('M_Rekening');
        $this->load->model('M_account');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Pengeluaran';
        $data['pengeluaran'] = $this->m_pengeluaran->tampil_data();
        $this->load->view('templates/header',$topik);
        $this->load->view('pengeluaran/index',$data);
        $this->load->view('templates/footer');
    }
    public function filter(){
        $topik['judul'] = 'Halaman Menu Pengeluaran';

        $dfil['tanggal'] = $this->input->get('tanggal', true);
        $dfil['tanggal_sampai'] = $this->input->get('tanggal_sampai', true);

        $data['pengeluaran'] = $this->m_pengeluaran->filter($dfil);
        $this->load->view('templates/header',$topik);
        $this->load->view('pengeluaran/index',$data);
        $this->load->view('templates/footer');
    }
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Pengeluaran';

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('uraian','Uraian','required');
        $this->form_validation->set_rules('reff','Reff','required');
        $this->form_validation->set_rules('kode_jurnal','Kode Jurnal','required');
        $this->form_validation->set_rules('rekening','Rekening','required');

        $this->db->select('*');
        $this->db->from('tbl_setup_jurnal');
        $this->db->where('formulir',"pengeluaran");
        $data['setup_jurnal'] = $this->db->get()->result_array();

        if ($this->form_validation->run() == FALSE) {
            $data['rekening'] = $this->M_Rekening->tampil_data();
            $data['coa'] = $this->M_account->tampil_data(NULL);

            $this->load->view('templates/header',$data);
            $this->load->view('pengeluaran/tambah');
        }else {
            $getrek = $this->M_Rekening->getRekeningById($this->input->post('rekening',true));
            $data = [
                "tgl" => $this->input->post('tgl',true),
                "uraian" => $this->input->post('uraian',true),
                "reff" => $this->input->post('reff',true),
                "rekening_id" => $this->input->post('rekening',true),
                "rekening" => $getrek['name'],
                "reff" => $this->input->post('reff',true),
                "kode_jurnal" => $this->input->post('kode_jurnal',true),
                "total_pengeluaran" => $this->input->post('jumlah_total',true)
            ];
            $add = $this->m_pengeluaran->tambahDataPengeluaran($data);
            $pid = $this->db->insert_id();

            $dataakun = [];
            for($i=0;$i<=count($this->input->post('kode_id',true))-1;$i++){
                $coa = $this->M_account->getAccountById($this->input->post('kode_id',true)[$i]);
                $dataakun['pengeluaran_id'] = $pid;
                $dataakun['coa_id'] = $this->input->post('kode_id',true)[$i];
                $dataakun['coa_kode'] = $coa['kode'];
                $dataakun['coa_nama'] = $coa['nama'];
                $dataakun['jumlah'] = $this->input->post('jumlah',true)[$i];
                $dataakun['batasan'] = $this->input->post('batasan',true)[$i];

                $this->m_pengeluaran->tambahDataPengeluaranAkun($dataakun);
            }

            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('pengeluaran');
        }
        
    }
    // public function detail($id){
    //     $topik['judul'] = 'Detail Data Karyawan';
    //     $data['pengeluaran'] = $this->m_pengeluaran->getPengirimanById($id);
    //     $this->load->view('templates/header',$topik);
    //     $this->load->view('pengeluaran/detail',$data);
    // }
    public function hapus($id){
        $this->m_pengeluaran->hapusDataPengeluaran($id);
        $this->m_pengeluaran->hapusAkunDataPengeluaran($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('pengeluaran');
    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Pengeluaran';
        $data['pengeluaran'] = $this->m_pengeluaran->getPengeluaranById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('uraian','Uraian','required');
        $this->form_validation->set_rules('reff','Reff','required');
        $this->form_validation->set_rules('kode_jurnal','Kode Jurnal','required');
        $this->form_validation->set_rules('rekening','Rekening','required');

        $this->db->select('*');
        $this->db->from('tbl_setup_jurnal');
        $this->db->where('formulir',"pengeluaran");
        $data['setup_jurnal'] = $this->db->get()->result_array();

        if ($this->form_validation->run() == FALSE) {
            $data['rekening'] = $this->M_Rekening->tampil_data();
            $data['coa'] = $this->M_account->tampil_data(NULL);
            $data['penge'] = $this->m_pengeluaran->getAkunPengeluaran($id);

            $this->load->view('templates/header',$topik);
            $this->load->view('pengeluaran/edit',$data);
        }else {
            $getrek = $this->M_Rekening->getRekeningById($this->input->post('rekening',true));
            $data = [
                "tgl" => $this->input->post('tgl',true),
                "uraian" => $this->input->post('uraian',true),
                "reff" => $this->input->post('reff',true),
                "rekening_id" => $this->input->post('rekening',true),
                "rekening" => $getrek['name'],
                "reff" => $this->input->post('reff',true),
                "kode_jurnal" => $this->input->post('kode_jurnal',true),
                "total_pengeluaran" => $this->input->post('jumlah_total',true)
            ];
            $this->m_pengeluaran->ubahDataPengeluaran($data);
            $this->m_pengeluaran->hapusAkunDataPengeluaran($id);
            $pid = $id;

            $dataakun = [];
            for($i=0;$i<=count($this->input->post('kode_id',true))-1;$i++){
                $coa = $this->M_account->getAccountById($this->input->post('kode_id',true)[$i]);
                $dataakun['pengeluaran_id'] = $pid;
                $dataakun['coa_id'] = $this->input->post('kode_id',true)[$i];
                $dataakun['coa_kode'] = $coa['kode'];
                $dataakun['coa_nama'] = $coa['nama'];
                $dataakun['jumlah'] = $this->input->post('jumlah',true)[$i];
                $dataakun['batasan'] = $this->input->post('batasan',true)[$i];

                $this->m_pengeluaran->tambahDataPengeluaranAkun($dataakun);
            }


            $this->session->set_flashdata('flash','Diubah');
            redirect('pengeluaran');
        }
}
}