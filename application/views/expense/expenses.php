<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses</title>
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
    <h1>Expenses</h1>
    <?php if(count($expenses) < 1) : ?>
        <p>You don't have any expenses yet.</p>
        <a href=<?= base_url('expenses/add')?>>Add expense</a>
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
                <?php foreach($expenses as $expense) : ?>
                    <tr>
                        <td><?php echo $expense->expense_name; ?></td>
                        <td><?php echo $expense->expense_category; ?></td>
                        <td><?php echo $expense->expense_amount; ?></td>
                        <td><?php echo $expense->wallet_name; ?></td>
                        <td>
                            <a href="<?php echo base_url('expenses/edit/'.$expense->expense_id); ?>">Edit</a>
                            <a href="<?php echo base_url('expenses/delete/'.$expense->expense_id); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>