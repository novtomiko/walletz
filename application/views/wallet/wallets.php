<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wallets</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 justify-content-x"> <?= $this->session->flashdata('pesan'); ?> </div>
        </div>
        <div class="card mb-3 style="width: 100%; height: 100%"">
        <h1>Here are your Wallet Details</h1>
        <?php if(count($wallets) < 1) : ?>
            <p>You don't have any wallets yet.</p>
            <a href=<?= base_url('wallets/add')?>>Add wallet</a>
        <?php else : ?>
            <?php $total_expenses = 0;?>
            <?php $total_incomes = 0;?>
            <?php foreach($totalExpenses as $totalExpenses) : ?>
                <?php $total_expenses = (int)$totalExpenses->expense_amount + (int)$total_expenses;?>
            <?php endforeach; ?>
            <?php foreach($totalIncomes as $totalIncomes) : ?>
                <?php $total_incomes = (int)$totalIncomes->expense_amount + (int)$total_incomes;?>
            <?php endforeach; ?>
            <?php foreach($wallets as $wallet) : ?>
                <h4><?php echo $wallet->wallet_name; ?></h4>
                       <canvas id='<?php echo $wallet->wallet_name;?>' style="width:100%;max-width:600px"></canvas>
                        <script>
                        var xValues = ["Incomes", "Expenses","Balance"];
                        var yValues = [<?php echo $total_incomes?>, <?php echo $total_expenses?>,<?php echo $wallet->wallet_amount?>];
                        var barColors = [
                        "#b91d47",
                        "#00aba9",
                        "#2b5797",
                        ];

                        new Chart('<?php echo $wallet->wallet_name;?>', {
                        type: "doughnut",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                            }]
                        },
                        options: {
                            title: {
                            display: true,
                            text: "Wallet Details"
                            }
                        }
                        });
                        </script>
                    <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>