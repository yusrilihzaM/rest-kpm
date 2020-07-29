<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pengajar extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('Pengajar_model','pengajar');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada user_id
        $user_id=$this->get('user_id');
        if($user_id===null){
            $pengajar=$this->pengajar->getPengajar();
        }else {
            $pengajar=$this->pengajar->getPengajar($user_id);
        }
        if($pengajar){
            $this->response([
                'status' => true,
                'data' => $pengajar
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tuser_idak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $user_id=$this->delete('user_id');
        //cek harus ada user_id
        if($user_id===null){// user_id ada atau tuser_idak
            $this->response([
                'status' => false,
                'message' => 'user_id kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek user_id pengajar
            if($this->pengajar->deletePengajar($user_id)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'user_id terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'user_id tuser_idak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'user_id'=>$this->post('user_id'),
            'deskripsi'=>$this->post('deskripsi'),
            'kode_pengajar'=>$this->post('kode_pengajar'),
            'user_id_pembinaan'=>$this->post('user_id_pembinaan'),
            'user_id'=>$this->post('user_id')
        ];
        if($this->pengajar->tambahPengajar($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data pengajar baru tertambahkan'
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
        $user_id=$this->put('user_id');
        $data=[
            'user_id'=>$this->post('user_id'),
            'deskripsi'=>$this->post('deskripsi'),
            'kode_pengajar'=>$this->post('kode_pengajar'),
            'user_id_pembinaan'=>$this->post('user_id_pembinaan'),
            'user_id'=>$this->post('user_id')
        ];
        if($this->pengajar->updatePengajar($data,$user_id)>0){
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