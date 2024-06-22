<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, <?= $username ?>!</h2>
    <p>You have successfully logged in.</p>
    <a href="<?= site_url('logout') ?>">Logout</a>
</body>
</html>
