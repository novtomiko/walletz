<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
</head>
<body>
    <h1>Edit your expense</h1>
    <form action="<?= base_url('expenses/save/'.$expense->expense_id)?>" method="post">
        <table>
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" value="<?= $expense->expense_name ?>"></td>
                <td><small><?= form_error('name') ?></small></td>
            </tr>
            <tr>
                <td><label for="amount">Amount:</label></td>
                <td><input type="number" id="amount" step="0.01" name="amount" value="<?= $expense->expense_amount ?>"></td>
                <td><small><?= form_error('amount') ?></small></td>
            </tr>
            <tr>
                <td><label for="date">Date:</label></td>
                <td><input type="date" id="date" name="date" value="<?= $expense->expense_date ?>"></td>
                <td><small><?= form_error('date') ?></small></td>
            </tr>
            <tr>
                <td><label for="category">Category:</label></td>
                <td>
                    <select name="category" id="category">
                        <option value="expense" <?php if($expense->expense_category=="expense") echo 'selected="selected"';?>>Expense</option>
                        <option value="income" <?php if($expense->expense_category=="income") echo 'selected="selected"';?>>Income</option>
                    </select>
                </td>
                <td><small><?= form_error('category') ?></small></td>
            </tr>
            <tr>
                <td><label for="wallet">Wallet:</label></td>
                <td>
                    <select name="wallet" id="wallet">
                        <option disabled selected value>Select a wallet</option>
                        <?php foreach($wallets as $wallet) : ?>
                            <option value="<?= $wallet->wallet_id ?>" <?php if($expense->wallet_id==$wallet->wallet_id) echo 'selected="selected"';?>><?= $wallet->wallet_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><small><?= form_error('wallet') ?></small></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Save"></td>
            </tr>
        </table>
    </form>
</body>
</html>