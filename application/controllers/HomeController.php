<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HomeController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('WalletModel');
        $this->load->model('ExpenseModel');
        if (!$this->session->userdata('email')) {
            redirect(base_url('login'));
        }
    }
    public function index(){
        $data['name'] = $this->session->userdata('name');
        $data['wallets'] = $this->WalletModel->getWallets();
        $data['expenses'] = $this->ExpenseModel->getExpenses();
        $data["judul"] = "Walletz Dasboard";
        $data["user"] = $this->UserModel
            ->cekData(["email" => $this->session->userdata("email")])
            ->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar", $data);
        $this->load->view("templates/topbar", $data); 
        $this->load->view('home', $data);
        $this->load->view("templates/footer");
    }
}
?>