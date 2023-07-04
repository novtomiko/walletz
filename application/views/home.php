<!-- Begin Page Content -->
<style>

    table {
        border: 1px solid black;
    }

    th {
        border: 1px solid black;
        padding: 10px;
        text-align: center;
    }

    td {
        border: 1px solid black;
        padding: 3px;
        text-align: center;
    }
</style>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 justify-content-x"> <?= $this->session->flashdata('pesan'); ?> </div>
  </div>
  <div class="card mb-3">
    <div>
        <h1>Welcome <?= $name ?>,</h1>
    </div>
    <br>
    <div>
        <h2>Here are your Wallets</h2>
        <a href=<?= base_url('wallets/add') ?>>Add New Wallet</a>
        <?php if (count($wallets) < 1) : ?>
            <p>You don't have any Wallet yet.</p>
        <?php else : ?>
            <table style="width:50%">
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
        <h2>Here are your Incomes & Expenses</h2>
        <a href=<?= base_url('expenses/add') ?>>Add Income or Expense</a>
        <?php if (count($expenses) < 1) : ?>
            <p>You don't have any Expenses yet.</p>
        <?php else : ?>
            <table style="width:50%">
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
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->