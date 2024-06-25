<link rel="stylesheet" type="text/css" href="<?= base_url('css/changepass.css') ?>">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="<?= base_url('css/index.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="form-content-change">
        <?php $session = session(); ?>
        <form action="<?php echo site_url('/change-password') ?>" method="post" onsubmit="return validateForm()">
            <h1>Change Password</h1>
            <h5>Current Password</h5>
            <input type="password" placeholder="Current Password" id="current-password" name="current-password" onblur="checkNotEmpty(this)" />
            <h5>New Password</h5>
            <input type="password" placeholder="New Password" id="new-password" name="new-password" onblur="checkNotEmpty(this)" />
            <h5>Confirm New Password</h5>
            <input type="password" placeholder="Confirm New Password" id="confirm-new-password" name="confirm-password" onblur="checkPasswordMatch()" />
            <p id="error-message">Passwords do not match!</p>
            <button type="submit">Change Password</button>
        </form>
    </div>

    <script>
        function checkNotEmpty(input) {
            if (input.value.trim() === '') {
                input.classList.add('error-border');
            } else {
                input.classList.remove('error-border');
            }
        }

        function checkPasswordMatch() {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-new-password').value;
            const errorMessage = document.getElementById('error-message');

            if (newPassword !== confirmPassword) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        }

        <?php if ($session->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                text: '<?= $session->getFlashdata('error') ?>'
            });
        <?php endif; ?>

        <?php if ($session->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                text: '<?= $session->getFlashdata('success') ?>'
            });
        <?php endif; ?>
    </script>
</body>
</html>
