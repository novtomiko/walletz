<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 justify-content-x"> <?= $this->session->flashdata('pesan'); ?> </div>
        </div> 
        <div class="card mb-3">
        <h1>Add expense or income</h1>
        <form action="<?= base_url('expenses/add')?>" method="post">
            <table>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" class="form-control form-control-user" id="name" name="name" value="<?= set_value('name') ?>"></td>
                    <td><small><?= form_error('name') ?></small></td>
                </tr>
                <tr>
                    <td><label for="amount">Amount:</label></td>
                    <td><input type="number" class="form-control form-control-user" id="amount" step="0.01" name="amount" value="<?= set_value('amount') ?>"></td>
                    <td><small><?= form_error('amount') ?></small></td>
                </tr>
                <tr>
                    <td><label for="date">Date:</label></td>
                    <td><input type="date" class="form-control form-control-user" id="date" name="date" value="<?= set_value('date') ?>"></td>
                    <td><small><?= form_error('date') ?></small></td>
                </tr>
                <tr>
                    <td><label for="category">Category:</label></td>
                    <td>
                        <select class="form-control form-control-user" name="category" id="category">
                            <option value="expense">Expense</option>
                            <option value="income">Income</option>
                        </select>
                    </td>
                    <td><small><?= form_error('category') ?></small></td>
                </tr>
                <tr>
                    <td><label for="wallet">Wallet:</label></td>
                    <td>
                        <select class="form-control form-control-user" name="wallet" id="wallet">
                            <option disabled selected value>Select a wallet</option>
                            <?php foreach($wallets as $wallet) : ?>
                                <option value="<?= $wallet->wallet_id ?>"><?= $wallet->wallet_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><small><?= form_error('wallet') ?></small></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Add"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>