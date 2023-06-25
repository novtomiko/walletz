<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model
{   
    public function __construct(){
        parent::__construct();
    }

    public function register(){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'), 
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        );
        $this->db->insert('User', $data);
    }
    //login return whole data of user
    public function login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('User', ['email'=>$email])->row_array();

        if($user){
            if(password_verify($password, $user['password'])){
                $data = [
                    'user_id' => $user['user_id'], //this is the primary key of table 'User
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
                return $data;
            } else {
                return false;
            }
        } else {    
            return false;
        }
        
    }
}
?>