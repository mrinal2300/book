<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

    public function index(){

        redirect('account/login');
    }


    public function dashboard(){

        if(!$this->session->userdata('user_id')){
             redirect('account/login');
        }

        $this->load->view('account/dashboard');
    }

	public function login(){


        if($this->session->userdata('user_id')){
             redirect('account/dashboard');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_validate_user');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('account/login');
        } else {
            redirect('account/dashboard');
        }
        
    }


    public function register(){


        if($this->session->userdata('user_id')){
             redirect('account/dashboard');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Full name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email address', 'required');
        $this->form_validation->set_rules('password', 'Password', 'requireds');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('account/register');
        } else {
            redirect('account/dashboard');
        }
        
    }


   

     public function validate_user(){

        $username = $this->input->post('username');
        $password = $this->input->post('password');


        $query = $this->db->get_where('users', array('username' => $username), 1);

        $user = $query->row();

        if($query->num_rows() == 0 || $user->password !== md5($password)){
            $this->form_validation->set_message('validate_user', 'Username or password not correct.');
            return FALSE;
        }


        $this->session->set_userdata(array(
            'user_id' => $user->id,
            'username' => $user->username));

        return TRUE;
        
    }

    public function logout(){

        $this->session->sess_destroy();

         redirect('account/login');
        
    }




}
