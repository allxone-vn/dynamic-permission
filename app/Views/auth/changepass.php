<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
        <?php $session = session(); ?>
                <form action="<?php echo site_url('/change-password') ?>" method="post" onsubmit="return validateForm()">
                <h1>Change Password</h1>
                <input type="password" placeholder="Current Password" id="current-password" name="current-password" onblur="checkNotEmpty(this)" />
                <input type="password" placeholder="New Password" id="new-password" name="new-password" onblur="checkNotEmpty(this)" />
                <input type="password" placeholder="Confirm New Password" id="confirm-new-password" name = 'confirm-password' onblur="checkPasswordMatch()" />
                <p id="error-message" style="color:red; display:none;">Passwords do not match!</p>
                <button type="submit">Change Password</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function checkNotEmpty(input) {
            if (input.value.trim() === '') {
                input.classList.add('error-border');
            } else {
                input.classList.remove('error-border');
            }
        }
        <?php if (session()->getFlashdata('error')): ?>
            // Hiển thị thông báo lỗi bằng SweetAlert nếu có lỗi trong session
            Swal.fire({
                icon: 'error',
                text: '<?= session()->getFlashdata('error') ?>'
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            // Hiển thị thông báo thành công bằng SweetAlert nếu có thành công trong session
            Swal.fire({
                icon: 'success',
                text: '<?= session()->getFlashdata('success') ?>'
            });
        <?php endif; ?>
    </script>
</body>
</html>
