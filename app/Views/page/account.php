<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/account.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="connect">
        <div class="text">
            <h2>Service sign-in</h2> 
            <p>Connect a service for sign-in.</p>
            <p><strong>Connected Accounts</strong></p>
            <p>Select a service to sign in with.</p>
        </div>
        <div class="nut">
            <?php if ($user['google_id'] != 0): ?>
                <a href="<?= base_url('account/disconnectGoogle') ?>" class="button google">
                    <i class="fa-brands fa-google-plus" style="color: #c64813;"></i>
                    Disconnect Google
                </a>
            <?php else: ?>
                <a href="<?= site_url('auth/google') ?>" class="button google">
                    <i class="fa-brands fa-google-plus" style="color: #c64813;"></i>
                    Connect Google
                </a>
            <?php endif; ?>
            <a href="#" class="button github">
            <i class="fa-brands fa-github"></i>    
            Disconnect Github</a><br>
        </div>
    </div>
</body>
</html>
