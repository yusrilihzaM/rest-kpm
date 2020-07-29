<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class kategori_pelajaran extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('KategoriPelajaran_model','kategoripelajaran');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_kategori_pelajaran
        $id_kategori_pelajaran=$this->get('id_kategori_pelajaran');
        if($id_kategori_pelajaran===null){
            $kategoripelajaran=$this->kategoripelajaran->getKategoriPelajaran();
        }else {
            $kategoripelajaran=$this->kategoripelajaran->getKategoriPelajaran($id_kategori_pelajaran);
        }
        
        
        if($kategoripelajaran){
            $this->response([
                'status' => true,
                'data' => $kategoripelajaran
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_kategori_pelajaranak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_kategori_pelajaran=$this->delete('id_kategori_pelajaran');
        //cek harus ada id_kategori_pelajaran
        if($id_kategori_pelajaran===null){// id_kategori_pelajaran ada atau tid_kategori_pelajaranak
            $this->response([
                'status' => false,
                'message' => 'id_kategori_pelajaran kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_kategori_pelajaran kategoripelajaran
            if($this->kategoripelajaran->deleteKategoriPelajaran($id_kategori_pelajaran)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_kategori_pelajaran terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_kategori_pelajaran tid_kategori_pelajaranak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'id_kategori_pelajaran'=>$this->put('id_kategori_pelajaran'),
            'info_infaq'=>$this->put('info_infaq')
        ];
        if($this->kategoripelajaran->tambahKategoriPelajaran($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data kategoripelajaran baru tertambahkan'
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
        $id_kategori_pelajaran=$this->put('id_kategori_pelajaran');
        $data=[
            'id_kategori_pelajaran'=>$this->put('id_kategori_pelajaran'),
            'info_infaq'=>$this->put('info_infaq')
        ];
        if($this->kategoripelajaran->updateKategoriPelajaran($data,$id_kategori_pelajaran)>0){
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