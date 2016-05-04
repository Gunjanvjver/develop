<?php

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}

class User_model extends CI_Model {
    
    function add_user($data) { 
       
        $this->db->trans_start();
        $this->db->insert('users', $data);        
        $this->db->trans_complete();
       
        if ($this->db->trans_status() === FALSE)
            {
                return false;
            }else{
                $user_id = $this->db->insert_id();
                return $user_id;
            }
    }
    
    function user_existence($email,$mobile){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("email= '$email' OR mobile = '$mobile'", NULL, FALSE);      
        $query = $this->db->get();        
        if ( $query->num_rows() > 0 ) {
            return false;
        }else{
            return true;
        }
        
    }
    
}
