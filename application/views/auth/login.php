<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <!-- login page using table-->
    <h2>Login</h2>
    <?= $this->session->flashdata('msg'); ?>
    <form method="post" action=<?= base_url('login'); ?>>
        <table>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="text" id="email" name="email" value="<?= set_value('email');?>"></td>
                <td><small><?= form_error('email') ?></small></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password" ></td>
                <td><small><?= form_error('password') ?></small></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login"></td>
            </tr>
        </table>
    </form>
</body>
</html>