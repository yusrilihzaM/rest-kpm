<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Menu_artikel extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('MenuArtikel_model','menu_artikel');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_artikel
        $id_artikel=$this->get('id_artikel');
        if($id_artikel===null){
            $id_artikel=$this->id_artikel->getArtikel();
        }else {
            $id_artikel=$this->id_artikel->getArtikel($id_artikel);
        }
        
        
        if($id_artikel){
            $this->response([
                'status' => true,
                'data' => $id_artikel
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_artikelak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_artikel=$this->delete('id_artikel');
        //cek harus ada id_artikel
        if($id_artikel===null){// id_artikel ada atau tid_artikelak
            $this->response([
                'status' => false,
                'message' => 'id_artikel kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_artikel id_artikel
            if($this->id_artikel->deleteArtikel($id_artikel)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_artikel terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_artikel tid_artikelak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'id_artikel'=>$this->post('id_artikel'),
            'judul_artikel'=>$this->post('judul_artikel'),
            'isi_artikel'=>$this->post('isi_artikel'),
            'gambar_artikel'=>$this->post('gambar_artikel'),
            'tanggal_artikel'=>$this->post('tanggal_artikel')
        ];
        if($this->id_artikel->tambahArtikel($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data id_artikel baru tertambahkan'
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
        $id_artikel=$this->put('id_artikel');
        $data=[
            'id_artikel'=>$this->post('id_artikel'),
            'judul_artikel'=>$this->post('judul_artikel'),
            'isi_artikel'=>$this->post('isi_artikel'),
            'gambar_artikel'=>$this->post('gambar_artikel'),
            'tanggal_artikel'=>$this->post('tanggal_artikel')
        ];
        if($this->id_artikel->updateArtikel($data,$id_artikel)>0){
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