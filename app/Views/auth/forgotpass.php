<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <div class="form-content ">
            <form action="<?php echo site_url('/forgotpassword') ?>" method="post" onsubmit="return validateEmail()">
                <h1>Forgot Password</h1>
                <p>Please enter your email address to request a password reset.</p>
                <input type="email" placeholder="Email" id="email" name="email" onblur="checkNotEmpty(this)" />
                <p id="error-message" style="color:red; display:none;">Please enter a valid email address!</p>
                <button type="submit">Submit</button>
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

        function validateEmail() {
            const email = document.getElementById('email').value;
            const errorMessage = document.getElementById('error-message');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email.trim() === '' || !emailPattern.test(email)) {
                errorMessage.style.display = 'block';
                return false;
            } else {
                errorMessage.style.display = 'none';
                return true;
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
