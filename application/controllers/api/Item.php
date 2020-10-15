<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Item extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_item');

    }

    //Menampilkan data kontak
   public function index_get() {
           
                $item=$this->m_item->get_all_item();
                $this->response($item, REST_Controller::HTTP_OK); 
        
            if ($item) {
                    $this->response([
                            'status' => TRUE,
                            'data' => $item
                    ], REST_Controller::HTTP_OK);
            }else {
                $this->response([
                             'status' => FALSE,
                             'message' => 'Kode Tidak Ada'
                    ], REST_Controller::HTTP_NOT_FOUND);
            }
             
        }

    public function search_get(){
        $search=$this->get('search');
        if (empty($search)) {
            $item=$this->m_item->get_all_item();
            $this->response($item, REST_Controller::HTTP_OK);
            
        }else{
             $item=$this->m_item->get_search($search);
            $this->response($item, REST_Controller::HTTP_OK);
        }
        if ($item) {
            $this->response([
                            'status' => TRUE,
                            'data' => $item
                    ], REST_Controller::HTTP_OK);
            }else {
                $this->response([
                             'status' => FALSE,
                             'message' => 'Kode atau nama Tidak Ada'
                    ], REST_Controller::HTTP_NOT_FOUND);
            }

    }

    public function simpan_post(){
        $nama=$this->post('nama');
        $cek=$this->m_item->cek_nama($nama);
        // print_r($cek);
        // die();
        if ($cek>0) {
            $this->response([
                             'status' => FALSE,
                             'message' => 'Nama tidak boleh sama'
                    ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            $kode=$this->m_item->get_kode();
            $data=[
            'kode'=>$kode,
            'nama'=>$this->post('nama'),
            'desk'=>$this->post('deskripsi')
        ];

         if ($this->m_item->simpan($data)>0) {
                        $this->response([
                            'status' => TRUE,
                            'message'=>'berhasil tersimpan Tersimpan'
                    ], REST_Controller::HTTP_CREATED);
        }else {
                        $this->response([
                             'status' => FALSE,
                             'message' => 'Gagal Menambahakan'
                    ], REST_Controller::HTTP_BAD_REQUEST);
    }

        }
        
}

public function hapus_delete(){
     $kode =$this->delete('kode');
        if ($kode == null)
        {
            $this->response([
                             'status' => FALSE,
                             'message' => 'kode Tidak Boleh Kosong'
                    ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }else {
            if ($this->m_item->hapus($kode)>0) {
                //hapus
                $this->response([
                            'status' => TRUE,
                            'kode' => $kode,
                            'message'=>' Terhapus'
                    ], REST_Controller::HTTP_OK);
            }else {
                $this->response([
                             'status' => FALSE,
                             'message' => 'kode tidak ada'
                    ], REST_Controller::HTTP_NO_CONTENT);
            }
        }

}

public function update_put(){
     $kode=$this->put('kode');
     $cek=$this->m_item->cek_item($kode);
     $kode=$kode;
     $nama=$cek->nama;
     $desk=$cek->desk;
     //  print_r($desk);
     // die();
     $nama2=$this->put('nama');
     $desk2=$this->put('deskripsi');
    
     if ($nama2==NULL and $desk2==NULL) {
        $this->response([
                             'status' => FALSE,
                             'message' => 'nama atau deskripsi tidak boleh kosong'
                    ], REST_Controller::HTTP_BAD_REQUEST);
    }elseif ($desk2==NULL) {
    $data=[
            'kode'=>$kode,
            'nama'=>$this->put('nama'),
            'desk'=>$desk
        ];
     
        if ($this->m_item->update($data, $kode)>0) {
                        $this->response([
                            'status' => TRUE,
                            'message'=>'Item Terupdate'
                    ], REST_Controller::HTTP_NO_CONTENT);
        }else {
                        $this->response([
                             'status' => FALSE,
                             'message' => 'Gagal Mengupdate Item'
                    ], REST_Controller::HTTP_BAD_REQUEST);
            }
}elseif ($nama2==NULL) {
      $data=[
            'kode'=>$kode,
            'nama'=>$nama,
            'desk'=>$this->put('deskripsi')
        ];
     
        if ($this->m_item->update($data, $kode)>0) {
                        $this->response([
                            'status' => TRUE,
                            'message'=>'Item Terupdate'
                    ], REST_Controller::HTTP_NO_CONTENT);
        }else {
                        $this->response([
                             'status' => FALSE,
                             'message' => 'Gagal Mengupdate Item'
                    ], REST_Controller::HTTP_BAD_REQUEST);
        }
}else{
    $data=[
            'kode'=>$kode,
            'nama'=>$this->put('nama'),
            'desk'=>$this->put('deskripsi')
        ];
     
        if ($this->m_item->update($data, $kode)>0) {
                        $this->response([
                            'status' => TRUE,
                            'message'=>'Item Terupdate'
                    ], REST_Controller::HTTP_NO_CONTENT);
        }else {
                        $this->response([
                             'status' => FALSE,
                             'message' => 'Gagal Mengupdate Item'
                    ], REST_Controller::HTTP_BAD_REQUEST);
}


}
}
}