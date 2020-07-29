<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Siswa_berprestasi extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('SiswaBerprestasi_model','siswaberprestasi');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_siswa_berprestasi
        $id_siswa_berprestasi=$this->get('id_siswa_berprestasi');
        if($id_siswa_berprestasi===null){
            $siswaberprestasi=$this->siswaberprestasi->getSiswaBerprestasi();
        }else {
            $siswaberprestasi=$this->siswaberprestasi->getSiswaBerprestasi($id_siswa_berprestasi);
        }
        
        
        if($siswaberprestasi){
            $this->response([
                'status' => true,
                'data' => $siswaberprestasi
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_siswa_berprestasiak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_siswa_berprestasi=$this->delete('id_siswa_berprestasi');
        //cek harus ada id_siswa_berprestasi
        if($id_siswa_berprestasi===null){// id_siswa_berprestasi ada atau tid_siswa_berprestasiak
            $this->response([
                'status' => false,
                'message' => 'id_siswa_berprestasi kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_siswa_berprestasi siswaberprestasi
            if($this->siswaberprestasi->deleteSiswaBerprestasi($id_siswa_berprestasi)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_siswa_berprestasi terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_siswa_berprestasi tid_siswa_berprestasiak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'id_siswa_berprestasi'=>$this->post('id_siswa_berprestasi'),
            'user_id'=>$this->post('user_id'),
            'prestasi'=>$this->post('prestasi'),
            'foto_prestasi'=>$this->post('foto_prestasi')
        ];
        if($this->siswaberprestasi->tambahSiswaBerprestasi($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data siswaberprestasi baru tertambahkan'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Tambah data gagal'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put(){
        // data yang isinya kolom-kolam dalam tabel
        $id_siswa_berprestasi=$this->put('id_siswa_berprestasi');
        $data=[
            'id_siswa_berprestasi'=>$this->post('id_siswa_berprestasi'),
            'user_id'=>$this->post('user_id'),
            'prestasi'=>$this->post('prestasi'),
            'foto_prestasi'=>$this->post('foto_prestasi')
        ];
        if($this->siswaberprestasi->updateSiswaBerprestasi($data,$id_siswa_berprestasi)>0){
            $this->response([
                'status' => true,
                'message' => 'data terupdate'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => false,
                'message' => 'update data gagal'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
} 