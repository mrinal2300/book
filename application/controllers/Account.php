<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

    public function index(){

        redirect('account/login');
    }

	public function login(){

        $this->load->library('form_validation');

        $this->load->view('account/login');
    }


    public function do_login(){


        $this->load->library('form_validation');


        $this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE){
            
            $this->load->view('account/login');
        } else {

            $username =  $this->input->post('username');

            echo $username;

            
            $this->load->view('account/created');
        
        }



        
          

        
    }


     public function username_check($str){
        
                if ($str == 'test')
                {
                        $this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }




}
