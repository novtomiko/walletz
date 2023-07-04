<?php
defined('BASEPATH') OR exit('No direct scrip access allowed');
class UserController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }    
    public function login(){
        if($this->session->userdata('email')){
            redirect(base_url('home'));
        }
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password','Password', 'required|min_length[3]|max_length[20]');
        if($this->form_validation->run() == TRUE){
            $data = $this->UserModel->login();
            if($data){
                $this->session->set_userdata($data);
                redirect(base_url('home'));
            }
            else{
                $this->session->set_flashdata('msg', 'Invalid email or password');
                redirect(base_url('login'));
            }
        }
        else{
            $data['judul'] = 'Login';
            $data['user'] = '';
            $this->load->view('templates/aute_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/aute_footer');
        }
    }

    public function register(){
        if($this->session->userdata('email')){
            redirect(base_url('home'));
        }
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[20]|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[User.email]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        if($this->form_validation->run() == TRUE){
            $this->UserModel->register();
            redirect(base_url('login'));
        }
        else{
            $this->load->view('auth/register');
        }
    }

    public function logout(){
        $this->session->unset_userdata(['name', 'email']);
        $this->session->set_flashdata('msg', 'You have been logged out');
        redirect(base_url('login'));
    }

}
?>
