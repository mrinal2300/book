<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

    public function index(){

        redirect('account/login');
    }


    public function dashboard(){

        if(!$this->session->userdata('user_id')){
             redirect('account/login');
        }

        $this->load->template('account/dashboard');
    }

	public function login(){


        if($this->session->userdata('user_id')){
             redirect('account/dashboard');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|callback_validate_user');

        if ($this->form_validation->run() == FALSE){
            $this->load->template('account/login');
        } else {
            
            redirect('account/dashboard');
        }
        
    }


    public function register(){


        if($this->session->userdata('user_id')){
             redirect('account/dashboard');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('fullname', 'Full name', 'required|trim|alpha');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email address', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE){
            $this->load->template('account/register');
        } else {

            $Full_name = $this->input->post('fullname');
            $register_username = $this->input->post('username');
            $email = $this->input->post('email');
            $register_password = md5($this->input->post('password'));

            $insert = array('username' => $register_username,
                            'name' => $Full_name,
                            'email' => $email,
                            'password' => $register_password,
                            'created_at' => date('Y-m-d H:i:s'));

            $this->db->insert('users', $insert);

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
