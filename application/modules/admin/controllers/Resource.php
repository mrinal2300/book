<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller {

    public function __construct(){

        parent::__construct();

        // if(!$this->session->userdata('user_id')){
        //     redirect('account/login');
        // }

    }

    public function index(){

        $query = $this->db->get('resources');

        $data['resources'] = $query->result();

        
        $this->load->template('resource/list', $data);
    }


    public function view(){

        $id = $this->uri->segment(4);

        $query = $this->db->get_where('resources', array('id' => $id));

        $data['resource'] = $query->row();

        
        $this->load->template('resource/single', $data);
    }


}