<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ExpenseModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->model('WalletModel');
    }
    public function getExpenses(){
        $user_id = $this->session->userdata('user_id');
        $this->db->select('expense_id, expense_name, expense_amount, expense_date, expense_category, wallet_name');
        $this->db->join('Wallet', 'Wallet.wallet_id = Expense.wallet_id');
        $this->db->where('Expense.user_id', $user_id);
        $this->db->order_by('expense_date', 'desc');
        $query = $this->db->get('Expense');
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return [];
        }     
    }
    public function getExpenseByID($id){
        $user_id = $this->session->userdata('user_id');
        $this->db->where('user_id', $user_id);
        $this->db->where('expense_id', $id);
        $query = $this->db->get('Expense');
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }
    public function getExpensesByWallet($id){
        $user_id = $this->session->userdata('user_id');
        $this->db->select('expense_id, expense_name, expense_amount, expense_date, expense_category, wallet_name');
        $this->db->join('Wallet', 'Wallet.wallet_id = Expense.wallet_id');
        $this->db->where('Expense.user_id', $user_id);
        $this->db->where('Expense.wallet_id', $id);
        $this->db->order_by('expense_date', 'desc');
        $query = $this->db->get('Expense');
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return [];
        }     
    }
    public function getExpensesByCategory($category){
        $user_id = $this->session->userdata('user_id');
        $this->db->select('expense_id, expense_name, expense_amount, expense_date, expense_category, wallet_name');
        $this->db->join('Wallet', 'Wallet.wallet_id = Expense.wallet_id');
        $this->db->where('Expense.user_id', $user_id);
        $this->db->where('Expense.expense_category', $category);
        $this->db->order_by('expense_date', 'desc');
        $query = $this->db->get('Expense');
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return [];
        }     
    }
    public function create(){
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'expense_name' => $this->input->post('name'),
            'expense_amount' => $this->input->post('amount'),
            'expense_date' => $this->input->post('date'),
            'expense_category' => $this->input->post('category'),
            'wallet_id' => $this->input->post('wallet')
        );
        if($data['expense_category'] == 'income'){
            $wallet = $this->WalletModel->getWalletByID($data['wallet_id']);
            $wallet->wallet_amount += $data['expense_amount'];
            $this->WalletModel->updateFromExpense($data['wallet_id'], $wallet);
        }else if($data['expense_category'] == 'expense'){
            $wallet = $this->WalletModel->getWalletByID($data['wallet_id']);
            $wallet->wallet_amount -= $data['expense_amount'];
            $this->WalletModel->updateFromExpense($data['wallet_id'], $wallet);
        }
        $this->db->insert('Expense', $data);
    }
    public function update($id){
        $expense = $this->getExpenseByID($id);
        $data = array(
            'expense_name' => $this->input->post('name'),
            'expense_amount' => $this->input->post('amount'),
            'expense_date' => $this->input->post('date'),
            'expense_category' => $this->input->post('category'),
            'wallet_id' => $this->input->post('wallet')
        );
        //if amount change
        if($data['expense_amount'] != $expense->expense_amount){
            //handleChangeAmount
            $expense = $this->handleChangeAmount($expense, $data['expense_amount']);
        }
        //if category change
        if($data['expense_category'] != $expense->expense_category){
            //handleChangeCategory
            $expense = $this->handleChangeCategory($expense, $data['expense_category']);
        }
        //if wallet change
        if($data['wallet_id'] != $expense->wallet_id){
            //handleChangeWallet
            $this->handleChangeWallet($expense, $data['wallet_id']);
        }
        $this->db->where('expense_id', $id);
        $this->db->update('Expense', $data);
    }
    public function delete($id){
        $expense = $this->getExpenseByID($id);
        if($expense->expense_category == 'income'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount -= $expense->expense_amount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }else if($expense->expense_category == 'expense'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount += $expense->expense_amount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }
        $this->db->where('expense_id', $id);
        $this->db->delete('Expense');
    }

    private function handleChangeAmount($expense, $newAmount){
        if($expense->expense_category == 'income'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount -= $expense->expense_amount;
            $wallet->wallet_amount += $newAmount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }else if($expense->expense_category == 'expense'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount += $expense->expense_amount;
            $wallet->wallet_amount -= $newAmount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }
        $expense->expense_amount = $newAmount;
        return $expense;
    }

    private function handleChangeCategory($expense, $newCategory){
        if($expense->expense_category == 'income'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount -= $expense->expense_amount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }else if($expense->expense_category == 'expense'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount += $expense->expense_amount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }
        if($newCategory == 'income'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount += $expense->expense_amount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }else if($newCategory == 'expense'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount -= $expense->expense_amount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }
        $expense->expense_category = $newCategory;
        return $expense;
    }

    private function handleChangeWallet($expense, $newWallet){
        if($expense->expense_category == 'income'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount -= $expense->expense_amount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }else if($expense->expense_category == 'expense'){
            $wallet = $this->WalletModel->getWalletByID($expense->wallet_id);
            $wallet->wallet_amount += $expense->expense_amount;
            $this->WalletModel->updateFromExpense($expense->wallet_id, $wallet);
        }
        if($expense->expense_category == 'income'){
            $wallet = $this->WalletModel->getWalletByID($newWallet);
            $wallet->wallet_amount += $expense->expense_amount;
            $this->WalletModel->updateFromExpense($newWallet, $wallet);
        }else if($expense->expense_category == 'expense'){
            $wallet = $this->WalletModel->getWalletByID($newWallet);
            $wallet->wallet_amount -= $expense->expense_amount;
            $this->WalletModel->updateFromExpense($newWallet, $wallet);
        }
    }


}
?>