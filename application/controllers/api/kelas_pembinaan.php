<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class kelas_pembinaan extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('kelasPembinaan_model','kelaspembinaan');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_kelas_pembinaan
        $id_kelas_pembinaan=$this->get('id_kelas_pembinaan');
        if($id_kelas_pembinaan===null){
            $kelaspembinaan=$this->kelaspembinaan->getKelasPembinaan();
        }else {
            $kelaspembinaan=$this->kelaspembinaan->getKelasPembinaan($id_kelas_pembinaan);
        }
        
        
        if($kelaspembinaan){
            $this->response([
                'status' => true,
                'data' => $kelaspembinaan
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_kelas_pembinaanak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_kelas_pembinaan=$this->delete('id_kelas_pembinaan');
        //cek harus ada id_kelas_pembinaan
        if($id_kelas_pembinaan===null){// id_kelas_pembinaan ada atau tid_kelas_pembinaanak
            $this->response([
                'status' => false,
                'message' => 'id_kelas_pembinaan kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_kelas_pembinaan kelaspembinaan
            if($this->kelaspembinaan->deleteKelasPembinaan($id_kelas_pembinaan)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_kelas_pembinaan terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_kelas_pembinaan tid_kelas_pembinaanak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'id_kelas_pembinaan'=>$this->post('id_kelas_pembinaan'),
            'kelas_pembinaan'=>$this->post('kelas_pembinaan'),
            'deskripsi_kelas_pembinaan'=>$this->post('deskripsi_kelas_pembinaan'),
            'id_kategori_pelajaran'=>$this->post('id_kategori_pelajaran'),
            'gambar_kelas_pembinaan'=>$this->post('gambar_kelas_pembinaan')
        ];
        if($this->kelaspembinaan->tambahKelasPembinaan($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data kelaspembinaan baru tertambahkan'
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
        $id_kelas_pembinaan=$this->put('id_kelas_pembinaan');
        $data=[
            'id_kelas_pembinaan'=>$this->post('id_kelas_pembinaan'),
            'kelas_pembinaan'=>$this->post('kelas_pembinaan'),
            'deskripsi_kelas_pembinaan'=>$this->post('deskripsi_kelas_pembinaan'),
            'id_kategori_pelajaran'=>$this->post('id_kategori_pelajaran'),
            'gambar_kelas_pembinaan'=>$this->post('gambar_kelas_pembinaan')
        ];
        if($this->kelaspembinaan->updateKelasPembinaan($data,$id_kelas_pembinaan)>0){
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