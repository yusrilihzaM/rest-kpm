<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Menu_profil extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('MenuProfil_model','menuprofil');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_profil
        $id_profil=$this->get('id_profil');
        if($id_profil===null){
            $menuprofil=$this->menuprofil->getMenuProfil();
        }else {
            $menuprofil=$this->menuprofil->getMenuProfil($id_profil);
        }
        
        
        if($menuprofil){
            $this->response([
                'status' => true,
                'data' => $menuprofil
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_profilak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_profil=$this->delete('id_profil');
        //cek harus ada id_profil
        if($id_profil===null){// id_profil ada atau tid_profilak
            $this->response([
                'status' => false,
                'message' => 'id_profil kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_profil menuprofil
            if($this->menuprofil->deleteMenuProfil($id_profil)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_profil terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_profil tid_profilak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'id_profil'=>$this->put('id_profil'),
            'deskripsi_profil'=>$this->put('deskripsi_profil')
        ];
        if($this->menuprofil->tambahMenuProfil($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data menuprofil baru tertambahkan'
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
        $id_profil=$this->put('id_profil');
        $data=[
            'id_profil'=>$this->put('id_profil'),
            'deskripsi_profil'=>$this->put('deskripsi_profil')
        ];
        if($this->menuprofil->updateMenuProfil($data,$id_profil)>0){
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