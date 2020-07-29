<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class menu_home extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('MenuHome_model','menuhome');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_home
        $id_home=$this->get('id_home');
        if($id_home===null){
            $menuhome=$this->menuhome->getHome();
        }else {
            $menuhome=$this->menuhome->getHome($id_home);
        }
        
        
        if($menuhome){
            $this->response([
                'status' => true,
                'data' => $menuhome
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_homeak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_home=$this->delete('id_home');
        //cek harus ada id_home
        if($id_home===null){// id_home ada atau tid_homeak
            $this->response([
                'status' => false,
                'message' => 'id_home kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_home menuhome
            if($this->menuhome->deleteHome($id_home)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_home terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_home tid_homeak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'Judul'=>$this->put('Judul'),
            'Subjudul'=>$this->put('Subjudul'),
            'Gambar'=>$this->put('Gambar'),
            'motto'=>$this->put('motto')
        ];
        if($this->menuhome->tambahHome($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data menuhome baru tertambahkan'
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
        $id_home=$this->put('id_home');
        $data=[
            'Judul'=>$this->put('Judul'),
            'Subjudul'=>$this->put('Subjudul'),
            'Gambar'=>$this->put('Gambar'),
            'motto'=>$this->put('motto')
        ];
        if($this->menuhome->updateHome($data,$id_home)>0){
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