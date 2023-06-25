<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wallet</title>
</head>
<body>
    <h1>Edit Wallet</h1>
    <form action="<?= base_url('wallets/save/'.$wallet->wallet_id); ?>" method="post">
        <table>
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" value="<?= $wallet->wallet_name ?>"></td>
                <td><small><?= form_error('name') ?></small></td>
            </tr>
            <tr>
                <td><label for="amount">Amount:</label></td>
                <td><input type="number" id="amount" step="0.01" name="amount" value="<?= $wallet->wallet_initial ?>"></td>
                <td><small><?= form_error('amount') ?></small></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Save"></td>
            </tr>
        </table>
    </form>
</body>
</html>