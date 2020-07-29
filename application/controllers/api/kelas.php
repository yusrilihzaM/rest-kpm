<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class kelas extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('Kelas_model','kelas');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_kelas
        $id_kelas=$this->get('id_kelas');
        if($id_kelas===null){
            $kelas=$this->kelas->getKelas();
        }else {
            $kelas=$this->kelas->getKelas($id_kelas);
        }
        
        
        if($kelas){
            $this->response([
                'status' => true,
                'data' => $kelas
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_kelasak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_kelas=$this->delete('id_kelas');
        //cek harus ada id_kelas
        if($id_kelas===null){// id_kelas ada atau tid_kelasak
            $this->response([
                'status' => false,
                'message' => 'id_kelas kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_kelas Kelas
            if($this->kelas->deleteKelas($id_kelas)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_kelas terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_kelas tid_kelasak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'id_kelas'=>$this->post('id_kelas'),
            'deskripsi'=>$this->post('deskripsi'),
            'kode_kelas'=>$this->post('kode_kelas'),
            'id_kelas_pembinaan'=>$this->post('id_kelas_pembinaan'),
            'user_id'=>$this->post('user_id')
        ];
        if($this->kelas->tambahKelas($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data Kelas baru tertambahkan'
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
        $id_kelas=$this->put('id_kelas');
        $data=[
            'id_kelas'=>$this->post('id_kelas'),
            'deskripsi'=>$this->post('deskripsi'),
            'kode_kelas'=>$this->post('kode_kelas'),
            'id_kelas_pembinaan'=>$this->post('id_kelas_pembinaan'),
            'user_id'=>$this->post('user_id')
        ];
        if($this->kelas->updateKelas($data,$id_kelas)>0){
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