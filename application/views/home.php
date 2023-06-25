<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            background-color: #f2f2f2;
        }

        h1 {
            display: inline-block;
        }

        div {
            align-items: center;
            justify-content: center;
        }

        #logout {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            float: right;
            margin-top: 30px;
        }

        table {
            border: 1px solid black;
        }

        th {
            border: 1px solid black;
            padding: 10px;
        }

        td {
            border: 1px solid black;
            padding: 3px;
        }
    </style>
</head>

<body>
    <div>
        <h1>Welcome, <?= $name ?></h1>
        <a id="logout" href="<?= base_url('logout') ?>">Logout</a>
    </div>
    <br>
    <div>
        <h2>Here are your wallets</h2>
        <a href=<?= base_url('wallets/add') ?>>Add wallet</a>
        <?php if (count($wallets) < 1) : ?>
            <p>You don't have any wallets yet.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Balance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wallets as $wallet) : ?>
                        <tr>
                            <td><?php echo $wallet->wallet_name; ?></td>
                            <td><?php echo $wallet->wallet_amount; ?></td>
                            <td>
                                <a href="<?php echo base_url('wallets/edit/' . $wallet->wallet_id); ?>">Edit</a>
                                <a href="<?php echo base_url('wallets/delete/' . $wallet->wallet_id); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <br>
    <div>
        <h2>Here are your expenses</h2>
        <a href=<?= base_url('expenses/add') ?>>Add expense</a>
        <?php if (count($expenses) < 1) : ?>
            <p>You don't have any expenses yet.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Wallet</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($expenses as $expense) : ?>
                        <tr>
                            <td><?php echo $expense->expense_name; ?></td>
                            <td><?php echo $expense->expense_category; ?></td>
                            <td><?php echo $expense->expense_amount; ?></td>
                            <td><?php echo $expense->wallet_name; ?></td>
                            <td>
                                <a href="<?php echo base_url('expenses/edit/' . $expense->expense_id); ?>">Edit</a>
                                <a href="<?php echo base_url('expenses/delete/' . $expense->expense_id); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>