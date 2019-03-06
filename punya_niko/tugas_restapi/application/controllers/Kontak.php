<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }
        $this->response($kontak, 200);
    }

    public function index_post(){
        $data = array(
                'nama' => $this->post('nama'),
                'nomor'=> $this->post('nomor')
        );

        $insert = $this->db->insert('telepon',$data);

        if ($insert) {
                $this->response($data,200);
        }else {
                $this->response(array('pesan' => 'error coy bahaha'));
        }
    }

    public function index_put(){
        $id = $this->put('id');
        $data = array(
                'id' => $this->put('id'),
                'nama' => $this->post('nama'),
                'nomor' => $this->post('nomor')
        );

        $this->db->where('id',$id);
        $update = $this->db->update('telepon',$data);

        if ($update){
                $this->response($data,200);
        }else{
                $this->response(array('pesan' => 'hoho gagal anda ganti data'));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('telepon');
        if ($delete) {
            $this->response(array('status' => 'sukses ngapusnya neh'));
        } else {
            $this->response(array('pesan' => 'gagall kau bahaha'));
        }
    }
}
?>
