<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_pendapatanlain');
        $this->load->model('M_account');
        $this->load->library('form_validation');
    }
    public function index(){
        
        $topik['judul'] = 'Halaman Menu Pendapatan Lain';
        $data['pendapatanlain'] = $this->M_pendapatanlain->tampil_data();
        $this->load->view('templates/header',$topik);
        $this->load->view('pendapatanlain/index',$data);
        $this->load->view('templates/footer');
    }
    public function filter(){
        $topik['judul'] = 'Halaman Menu Pendapatan Lain';
        $dfil['tanggal'] = $this->input->get('tanggal', true);
        $dfil['tanggal_sampai'] = $this->input->get('tanggal_sampai', true);

        $data['pendapatanlain'] = $this->M_pendapatanlain->filter($dfil);
        $this->load->view('templates/header',$topik);
        $this->load->view('pendapatanlain/index',$data);
        $this->load->view('templates/footer');
    }
    
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Pendapatan Lain';
        
        $dariDB = $this->M_pendapatanlain->cekkodependapatan();
        $data['coa'] = $this->M_account->tampil_data(NULL);
        $nourut = substr($dariDB, 3, 4);
        $cekkodependapatan = floatval($nourut) + floatval("1");
        $data2 = array('no_faktur' => $cekkodependapatan);

        $this->db->select('*');
        $this->db->from('tbl_setup_jurnal');
        $this->db->where('formulir',"pendapatan_lain");
        $data2['setup_jurnal'] = $this->db->get()->result_array();

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No Faktur','required');
        $this->form_validation->set_rules('kode_jurnal','Kode Jurnal','required');
        // $this->form_validation->set_rules('transaksi','Transaksi','required');
        // $this->form_validation->set_rules('jumlah','Jumlah','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$data);
            $this->load->view('pendapatanlain/tambah',$data2);
            $this->load->view('templates/footer');
        }else {
            $add = $this->M_pendapatanlain->tambahDataPendapatan();
            $plid = $this->db->insert_id();
            
            $dataakun = [];
            for($i=0;$i<=count($this->input->post('kode_akun',true))-1;$i++){
                $coa = $this->M_account->getAccountById($this->input->post('kode_akun',true)[$i]);
                $dataakun['pendapatanlain_id'] = $plid;
                $dataakun['coa_id'] = $this->input->post('kode_akun',true)[$i];
                $dataakun['coa_kode'] = $coa['kode'];
                $dataakun['coa_nama'] = $coa['nama'];
                $dataakun['transaksi'] = $this->input->post('transaksi',true)[$i];
                $dataakun['jumlah_subtotal'] = $this->input->post('subtotal',true)[$i];

                $this->M_pendapatanlain->tambahDataPendapatanAkun($dataakun);
            }

            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('pendapatan');
        }
        
    }
    // public function detail($id){
    //     $topik['judul'] = 'Detail Data Karyawan';
    //     $data['pendapatanlain'] = $this->M_pendapatanlain->getPengirimanById($id);
    //     $this->load->view('templates/header',$topik);
    //     $this->load->view('pendapatanlain/detail',$data);
    // }
    public function hapus($id){
        $this->M_pendapatanlain->hapusDataPendapatan($id);
        $this->M_pendapatanlain->hapusDataPendapatanAkunByPendapatanId($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('pendapatan');
    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Pendapatan Lain';
        $data['pendapatanlain'] = $this->M_pendapatanlain->getPendapatanById($id);
        $data['coa'] = $this->M_account->tampil_data(NULL);
        $data['coaedit'] = $this->M_pendapatanlain->getcoaByPendapatanId($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->db->select('*');
        $this->db->from('tbl_setup_jurnal');
        $this->db->where('formulir',"pendapatan_lain");
        $data['setup_jurnal'] = $this->db->get()->result_array();

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No Faktur','required');
        $this->form_validation->set_rules('kode_jurnal','Kode Jurnal','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$topik);
            $this->load->view('pendapatanlain/edit',$data);
        }else {
            $this->M_pendapatanlain->ubahDataPendapatan();
            $this->M_pendapatanlain->hapusDataPendapatanAkunByPendapatanId($id);
            
            $dataakun = [];
            for($i=0;$i<=count($this->input->post('kode_akun',true))-1;$i++){
                $coa = $this->M_account->getAccountById($this->input->post('kode_akun',true)[$i]);
                $dataakun['pendapatanlain_id'] = $id;
                $dataakun['coa_id'] = $this->input->post('kode_akun',true)[$i];
                $dataakun['coa_kode'] = $coa['kode'];
                $dataakun['coa_nama'] = $coa['nama'];
                $dataakun['transaksi'] = $this->input->post('transaksi',true)[$i];
                $dataakun['jumlah_subtotal'] = $this->input->post('subtotal',true)[$i];

                $this->M_pendapatanlain->tambahDataPendapatanAkun($dataakun);
            }
            $this->session->set_flashdata('flash','Diubah');
            redirect('pendapatan');
        }
}
}