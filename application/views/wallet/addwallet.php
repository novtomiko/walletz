<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Wallet</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 justify-content-x"> <?= $this->session->flashdata('pesan'); ?> </div>
        </div>
        <div class="card mb-3">
        <h1>Add New Wallet</h1>
        <form action="<?= base_url('wallets/add'); ?>" method="post">
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
                    <td></td>
                    <td><input type="submit" value="Add"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>