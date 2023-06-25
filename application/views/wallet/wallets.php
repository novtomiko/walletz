<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wallets</title>
    <style>
        table{
            border: 1px solid black;
        }
        th{
            border: 1px solid black;
            padding: 10px;
        }
        td{
            border: 1px solid black;
            padding: 3px;
        }
    </style>
</head>
<body>
    <h1>Here are your wallets</h1>
    <?php if(count($wallets) < 1) : ?>
        <p>You don't have any wallets yet.</p>
        <a href=<?= base_url('wallets/add')?>>Add wallet</a>
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
                <?php foreach($wallets as $wallet) : ?>
                    <tr>
                        <td><?php echo $wallet->wallet_name; ?></td>
                        <td><?php echo $wallet->wallet_amount; ?></td>
                        <td>
                            <a href="<?php echo base_url('wallets/edit/'.$wallet->wallet_id); ?>">Edit</a>
                            <a href="<?php echo base_url('wallets/delete/'.$wallet->wallet_id); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>