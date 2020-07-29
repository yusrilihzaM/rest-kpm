<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class admin extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('Admin_model','admin');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_admin
        $id_admin=$this->get('id_admin');
        if($id_admin===null){
            $admin=$this->admin->getAdmin();
        }else {
            $admin=$this->admin->getAdmin($id_admin);
        }
        
        
        if($admin){
            $this->response([
                'status' => true,
                'data' => $admin
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tidak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_admin=$this->delete('id_admin');
        //cek harus ada id_admin
        if($id_admin===null){// id_admin ada atau tidak
            $this->response([
                'status' => false,
                'message' => 'id_admin kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_admin admin
            if($this->admin->deleteAdmin($id_admin)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_admin terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_admin tidak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'id_admin'=>$this->post('id_admin'),
            'username_admin'=>$this->post('username_admin'),
            'password_admin'=>$this->post('password_admin'),
            'nama_admin'=>$this->post('nama_admin'),
            'gambar_admin'=>$this->post('gambar_admin')
        ];
        if($this->admin->tambahAdmin($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data admin baru tertambahkan'
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
        $id_admin=$this->put('id_admin');
        $data=[
            'id_admin'=>$this->post('id_admin'),
            'username_admin'=>$this->post('username_admin'),
            'password_admin'=>$this->post('password_admin'),
            'nama_admin'=>$this->post('nama_admin'),
            'gambar_admin'=>$this->post('gambar_admin')
        ];
        if($this->admin->updateAdmin($data,$id_admin)>0){
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