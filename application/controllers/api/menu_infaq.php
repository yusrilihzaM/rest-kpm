<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Menu_infaq extends Rest_Controller 
{
    //model harus diload pada constructor
    public function __construct(){
        parent::__construct();
        $this->load->model('MenuInfoInfaq_model','menuinfaq');
    }
    // minta data pake get cuma menampilkan
    public function index_get()
    {
        //cek get apakah ada id_info_infaq
        $id_info_infaq=$this->get('id_info_infaq');
        if($id_info_infaq===null){
            $menuinfaq=$this->menuinfaq->getMenuInfoInfaq();
        }else {
            $menuinfaq=$this->menuinfaq->getMenuInfoInfaq($id_info_infaq);
        }
        
        
        if($menuinfaq){
            $this->response([
                'status' => true,
                'data' => $menuinfaq
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'data tid_info_infaqak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //menghapus data
    public function index_delete()
    {
        $id_info_infaq=$this->delete('id_info_infaq');
        //cek harus ada id_info_infaq
        if($id_info_infaq===null){// id_info_infaq ada atau tid_info_infaqak
            $this->response([
                'status' => false,
                'message' => 'id_info_infaq kosong '
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {// cek id_info_infaq menuinfaq
            if($this->menuinfaq->deleteMenuInfoInfaq($id_info_infaq)> 0){
                $this->response([
                    'status' => true,
                    'message' => 'id_info_infaq terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else {
                $this->response([
                    'status' => false,
                    'message' => 'id_info_infaq tid_info_infaqak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // menambah data baru
    public function index_post(){
        // data yang isinya kolom-kolam dalam tabel
        $data=[
            'id_info_infaq'=>$this->put('id_info_infaq'),
            'info_infaq'=>$this->put('info_infaq')
        ];
        if($this->menuinfaq->tambahMenuInfoInfaq($data)>0){
            $this->response([
                'status' => true,
                'message' => 'data menuinfaq baru tertambahkan'
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
        $id_info_infaq=$this->put('id_info_infaq');
        $data=[
            'id_info_infaq'=>$this->put('id_info_infaq'),
            'info_infaq'=>$this->put('info_infaq')
        ];
        if($this->menuinfaq->updateMenuInfoInfaq($data,$id_info_infaq)>0){
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