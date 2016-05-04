<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Adminbase.php';

class Request extends AdminBase {

    public $data;

    function __construct() {
        parent::__construct();       
        $this->load_views();
        $this->load->database();
        $this->load->model('user_model');
    }

    function index() {
        $this->load->view('index', $this->data);
    }
    
    function Adduser() {     
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');        
        $mobile = $this->input->post('mobile');
        if(!empty($name) && !empty($email) && !empty($password) && !empty($mobile)){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                       echo $emailErr = "Invalid email format !"; 
                       return false;
                   }
                if(!preg_match('/^\d{10}$/',$mobile)){
                       echo 'Phone number invalid !';
                       return false;
                   }
                $check_user_existence = $this->user_model->user_existence($email,$mobile);
                if($check_user_existence == true){
                        $data = array(   
                           'name' => $name,
                           'email' => $email,    
                           'password' => md5($password),
                           'mobile' => $mobile
                       );        
                       $user_id = $this->user_model->add_user($data);
                       if($user_id !== false){
                           $this->load->library('session');
                           $session_data = array(
                                'username'  => $name,
                                'email'     => $email,
                                'logged_in' => TRUE,
                                'user_id' => $user_id
                                );
                           $this->session->set_userdata($session_data);
                           echo "User created successfully";
                           return true;
                        }else{
                           echo "Something went wrong !";
                           return false;
                        }
            }else{
                echo "User already exists";
                return false;
            }
        }else{
            echo "Invalid input";
            return false;
        }
        
    }
}
        


	
