<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Piutang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Piutang']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $topik['judul'] = 'Halaman Menu Piutang';

        $data = [
            'clients' => $this->db->get_where('daftar_mitra')->result(),
        ];

        $this->load->view('templates/header', $topik);
        $this->load->view('Piutang/index', $data);
        $this->load->view('templates/footer');

        //load file javascript
        $this->load->view('Piutang/S_Piutang', $data);
    }

    public function getDataPiutang()
    {
        header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));

        $dataPiutang = $this->M_Piutang->getDataPiutang($dataPost);

        $finalDataPiutang    = [];
        foreach ($dataPiutang as $key => $value) {

            if ((int)$value->sisa_piutang != 0) {
                $dataTemp                = $value;

                $tanggal                 = new DateTime($value->tanggal);
                $tanggalTempo            = new DateTime($value->tanggal_jt);
                $tanggalSekarang         = new DateTime();
                $selisih                 = $tanggalTempo->diff($tanggal)->days;
                $selisih1                = $tanggalSekarang->diff($tanggal)->days;
                $dataTemp->usiaHutang    = (int)$selisih - (int)$selisih1;

                switch ($dataPost->usiaHutang) {
                    case 'kurang30':
                        if ($dataTemp->usiaHutang < 30) {
                            array_push($finalDataPiutang, $dataTemp);
                        }
                        break;

                    case '0':
                        if ($dataTemp->usiaHutang == 0) {
                            array_push($finalDataPiutang, $dataTemp);
                        }
                        break;
                    case 'lebih30':
                        if ($dataTemp->usiaHutang > 30) {
                            array_push($finalDataPiutang, $dataTemp);
                        }
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }

        echo json_encode($finalDataPiutang);
    }
}
