<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ExpenseController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('ExpenseModel');
        $this->load->model('WalletModel');
        if (!$this->session->userdata('user_id')) {
            redirect(base_url('login'));
        }
    }
    public function index(){
        $data['expenses'] = $this->ExpenseModel->getExpenses();
        $this->load->view('expense/expenses', $data);
    }
    public function add(){
        $data['wallets'] = $this->WalletModel->getWallets();
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('wallet', 'Wallet', 'required');
        if ($this->form_validation->run() == TRUE) {
            $this->ExpenseModel->create();
            redirect(base_url('home'));
        }else {
            $data["judul"] = "Walletz Dasboard";
            $data["user"] = $this->UserModel
                ->cekData(["email" => $this->session->userdata("email")])
                ->row_array();
            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view('expense/addexpense', $data);
            $this->load->view("templates/footer");
        }
    }
    public function edit($id){
        $data['expense'] = $this->ExpenseModel->getExpenseByID($id);
        $data['wallets'] = $this->WalletModel->getWallets();
        $data["judul"] = "Walletz Dasboard";
        $data["user"] = $this->UserModel
            ->cekData(["email" => $this->session->userdata("email")])
            ->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data);
        $this->load->view('expense/editexpense', $data);
        $this->load->view("templates/footer");
    }
    public function save($id){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('wallet', 'Wallet', 'required');
        if ($this->form_validation->run() == TRUE){
            $this->ExpenseModel->update($id);
            redirect(base_url('home'));
        }else{
            $this->edit($id);
        }
    }
    public function delete($id){
        $this->ExpenseModel->delete($id);
        redirect(base_url('home'));
    }
}
?>