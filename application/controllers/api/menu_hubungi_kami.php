<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class menu_hubungi_kami extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('MenuHubKami_model','menuhubkami');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_hub
        $id_hub=$this->get('id_hub_home');
        if($id_hub===null){
            $menuhubkami=$this->menuhubkami->getHome();
        }else {
            $menuhubkami=$this->menuhubkami->getHome($id_hub);
        }
        
        
        if($menuhubkami){
            $this->response([
                'status' => true,
                'data' => $menuhubkami
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_hubak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_hub=$this->delete('id_hub_home');
        //cek harus ada id_hub
        if($id_hub===null){// id_hub ada atau tid_hubak
            $this->response([
                'status' => false,
                'message' => 'id_hub kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_hub menuhubkami
            if($this->menuhubkami->deleteHome($id_hub)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_hub terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_hub tid_hubak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'alamat'=>$this->put('alamat'),
            'telepon'=>$this->put('telepon'),
            'instagram'=>$this->put('instagram'),
            'facebook'=>$this->put('facebook')
        ];
        if($this->menuhubkami->tambahHome($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data menuhubkami baru tertambahkan'
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
        $id_hub=$this->put('id_hub');
        $data=[
            'alamat'=>$this->put('alamat'),
            'telepon'=>$this->put('telepon'),
            'instagram'=>$this->put('instagram'),
            'facebook'=>$this->put('facebook')
        ];
        if($this->menuhubkami->updateHome($data,$id_hub)>0){
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