<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Welcome extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {        
       $id = $this->get('id');
        if ($id == '') {
        	http://localhost/ci-3-restfull-api/
            $kontak = $this->db->get('provinces')->result();
        } else {
        	//http://localhost/ci-3-restfull-api/index.php/welcome?id=11
            $this->db->where('id', $id);
            $kontak = $this->db->get('provinces')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $data = array('name'=> $this->post('nama'));
        $insert = $this->db->insert('provinces', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(                    
                    'name' => $this->put('nama'));              
        $this->db->where('id', $id);
        $update = $this->db->update('provinces', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('provinces');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}