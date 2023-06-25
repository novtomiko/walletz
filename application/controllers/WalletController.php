<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WalletController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('WalletModel');
        if(!$this->session->userdata('email')){
            redirect(base_url('login'));
        }
    }    
    public function index(){
        $data['wallets'] = $this->WalletModel->getWallets();
        $this->load->view('wallet/wallets', $data);
    }
    public function add(){
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[20]|trim');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        if($this->form_validation->run() == TRUE){
            $this->WalletModel->create();
            redirect(base_url('home'));
        }
        else{
            $this->load->view('wallet/addwallet');
        }
    }
    public function edit($id){
        $data['wallet'] = $this->WalletModel->getWalletByID($id);
        if (!$data['wallet']) {
            redirect(base_url('home'));
        }
        $this->load->view('wallet/editwallet', $data);
    }
    public function save($id){
        $data['wallet'] = $this->WalletModel->getWalletByID($id);
        if (!$data['wallet']) {
            redirect(base_url('home'));
        }
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[20]|trim');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        if($this->form_validation->run() == TRUE){
            $this->WalletModel->update($id);
            redirect(base_url('home'));
        }
        else{
            $this->edit($id);
        }
    }
    public function delete($id){
        $this->WalletModel->delete($id);
        redirect(base_url('home'));
    }
}
?>