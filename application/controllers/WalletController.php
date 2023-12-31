<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WalletController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('WalletModel');
        $this->load->model('ExpenseModel');
        if(!$this->session->userdata('email')){
            redirect(base_url('login'));
        }
    }    
    public function index(){
        $data['wallets'] = $this->WalletModel->getWallets();
        $data['expenses'] = $this->ExpenseModel->getExpenses();
        $data['totalExpenses'] = $this->ExpenseModel->getTotalExpenses();
        $data['totalIncomes'] = $this->ExpenseModel->getTotalIncomes();
        $data["judul"] = "My Account";
        $data["user"] = $this->UserModel
            ->cekData(["email" => $this->session->userdata("email")])
            ->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view('wallet/wallets', $data);
        $this->load->view("templates/footer");
        
    }
    public function add(){
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[20]|trim');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        if($this->form_validation->run() == TRUE){
            $this->WalletModel->create();
            redirect(base_url('home'));
        }
        else{
            $data["judul"] = "Walletz Dasboard";
            $data["user"] = $this->UserModel
                ->cekData(["email" => $this->session->userdata("email")])
                ->row_array();
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view('wallet/addwallet');
            $this->load->view("templates/footer");
            
        }
    }
    public function edit($id){
        $data['wallet'] = $this->WalletModel->getWalletByID($id);
        if (!$data['wallet']) {
            redirect(base_url('home'));
        }
        $data["judul"] = "Walletz Dasboard";
        $data["user"] = $this->UserModel
            ->cekData(["email" => $this->session->userdata("email")])
            ->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view('wallet/editwallet', $data);
        $this->load->view("templates/footer");
       
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