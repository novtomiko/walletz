<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WalletModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }
    public function getWallets(){
        $user_id = $this->session->userdata('user_id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('Wallet');
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return [];
        }     
    }
    public function getWalletByID($id){
        $user_id = $this->session->userdata('user_id');
        $this->db->where('user_id', $user_id);
        $this->db->where('wallet_id', $id);
        $query = $this->db->get('Wallet');
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    public function create(){
        
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'wallet_name' => $this->input->post('name'),
            'wallet_amount' => $this->input->post('amount'),
            'wallet_initial' => $this->input->post('amount')
        );
        $this->db->insert('Wallet', $data);
    }
    public function update($id){
        $wallet = $this->getWalletByID($id);
        $data = array(
            'wallet_name' => $this->input->post('name'),
            'wallet_initial' => $this->input->post('amount'),
            'wallet_amount' => $wallet->wallet_amount + ($this->input->post('amount') - $wallet->wallet_initial)
        );
        $this->db->where('wallet_id', $id);
        $this->db->update('Wallet', $data);
    }
    public function updateFromExpense($id, $newWallet){
        $this->db->where('wallet_id', $id);
        $this->db->update('Wallet', $newWallet);
    }
    public function delete($id){
        $this->db->where('wallet_id', $id);
        $this->db->delete('Wallet');
    }
}
?>