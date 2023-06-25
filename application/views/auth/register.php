<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <!-- register page using table-->
    <h2>Register</h2>
    <form method="post" action=<?= base_url('register'); ?>>
        <table>
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" value="<?= set_value('name');?>"></td>
                <td><small><?= form_error('name') ?> </small></td>
            </tr>
            
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
                <td><label for="confirm_password">Confirm Password:</label></td>
                <td><input type="password" id="confirm_password" name="confirm_password"></td>
                <td><small><?= form_error('confirm_password') ?></small></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Register"></td>
            </tr>
        </table>
    </form>
</body>
</html>