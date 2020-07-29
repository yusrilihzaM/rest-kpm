<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('Mahasiswa_model','m_user');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id
        $id=$this->get('id');
        if($id===null){
            $mahasiswa=$this->mahasiswa->getMahasiswa();
        }else {
            $mahasiswa=$this->mahasiswa->getMahasiswa($id);
        }
        
        
        if($mahasiswa){
            $this->response([
                'status' => true,
                'data' => $mahasiswa
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
        $id=$this->delete('id');
        //cek harus ada id
        if($id===null){// id ada atau tidak
            $this->response([
                'status' => false,
                'message' => 'id kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id mahasiswa
            if($this->mahasiswa->deleteMahasiswa($id)> 0){
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
            'nrp'=>$this->post('nrp'),
            'nama'=>$this->post('nama'),
            'email'=>$this->post('email'),
            'jurusan'=>$this->post('jurusan')
        ];
        if($this->mahasiswa->tambahMahasiswa($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data mahasiswa baru tertambahkan'
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
            'nrp'=>$this->put('nrp'),
            'nama'=>$this->put('nama'),
            'email'=>$this->put('email'),
            'jurusan'=>$this->put('jurusan')
        ];
        if($this->mahasiswa->updateMahasiswa($data,$id)>0){
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