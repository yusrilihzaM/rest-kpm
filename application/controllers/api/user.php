<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class user extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model','user');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id
        $id=$this->get('user_id');
        if($id===null){
            $user=$this->user->getUser();
        }else {
            $user=$this->user->getUser($id);
        }
        
        
        if($user){
            $this->response([
                'status' => true,
                'data' => $user
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
        $id=$this->delete('user_id');
        //cek harus ada id
        if($id===null){// id ada atau tidak
            $this->response([
                'status' => false,
                'message' => 'id kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id user
            if($this->user->deleteUser($id)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id tidak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'nama_lengkap'=>$this->put('nama_lengkap'),
            'jenkel_user'=>$this->put('jenkel_user'),
            'telpn_user'=>$this->put('telpn_user'),
            'id_provinsi'=>$this->put('id_provinsi'),
            'id_kabkota'=>$this->put('id_kabkota'),
            'id_kecamatan'=>$this->put('id_kecamatan'),
            'id_kelurahan'=>$this->put('id_kelurahan'),
            'alamat_user'=>$this->put('alamat_user'),
            'username_user'=>$this->put('username_user'),
            'password_user'=>$this->put('password_user'),
            'email_user'=>$this->put('email_user'),
            'umur_user'=>$this->put('umur_user'),
            'tanggal_lahir_user'=>$this->put('tanggal_lahir_user'),
            'jenjang_pendidikan'=>$this->put('jenjang_pendidikan'),
            'instansi'=>$this->put('instansi'),
            'jenis_user'=>$this->put('jenis_user')
        ];
        if($this->user->tambahUser($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data user baru tertambahkan'
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
        $id=$this->put('id');
        $data=[
            'nama_lengkap'=>$this->put('nama_lengkap'),
            'jenkel_user'=>$this->put('jenkel_user'),
            'telpn_user'=>$this->put('telpn_user'),
            'id_provinsi'=>$this->put('id_provinsi'),
            'id_kabkota'=>$this->put('id_kabkota'),
            'id_kecamatan'=>$this->put('id_kecamatan'),
            'id_kelurahan'=>$this->put('id_kelurahan'),
            'alamat_user'=>$this->put('alamat_user'),
            'username_user'=>$this->put('username_user'),
            'password_user'=>$this->put('password_user'),
            'email_user'=>$this->put('email_user'),
            'umur_user'=>$this->put('umur_user'),
            'tanggal_lahir_user'=>$this->put('tanggal_lahir_user'),
            'jenjang_pendidikan'=>$this->put('jenjang_pendidikan'),
            'instansi'=>$this->put('instansi'),
            'jenis_user'=>$this->put('jenis_user')

        ];
        if($this->user->updateUser($data,$id)>0){
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