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
        $this->load->model('MenuPengumuman_model','menupengumuman');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_pengumuman
        $id_pengumuman=$this->get('id_pengumuman_home');
        if($id_pengumuman===null){
            $menupengumuman=$this->menupengumuman->getHome();
        }else {
            $menupengumuman=$this->menupengumuman->getHome($id_pengumuman);
        }
        
        
        if($menupengumuman){
            $this->response([
                'status' => true,
                'data' => $menupengumuman
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_pengumumanak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_pengumuman=$this->delete('id_pengumuman_home');
        //cek harus ada id_pengumuman
        if($id_pengumuman===null){// id_pengumuman ada atau tid_pengumumanak
            $this->response([
                'status' => false,
                'message' => 'id_pengumuman kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_pengumuman menupengumuman
            if($this->menupengumuman->deleteHome($id_pengumuman)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_pengumuman terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_pengumuman tid_pengumumanak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'judul_pengumuman'=>$this->put('judul_pengumuman'),
            'detail_pengumuman'=>$this->put('detail_pengumuman'),
            'gambar_pengumuman'=>$this->put('gambar_pengumuman')
        ];
        if($this->menupengumuman->tambahHome($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data menupengumuman baru tertambahkan'
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
        $id_pengumuman=$this->put('id_pengumuman');
        $data=[
            'judul_pengumuman'=>$this->put('judul_pengumuman'),
            'detail_pengumuman'=>$this->put('detail_pengumuman'),
            'gambar_pengumuman'=>$this->put('gambar_pengumuman')
        ];
        if($this->menupengumuman->updateHome($data,$id_pengumuman)>0){
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