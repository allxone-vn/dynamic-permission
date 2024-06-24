    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="<?= base_url('css/style.css') ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>
    <body>
        <div class="container " id="container">
            <div class="form-container sign-up-container" >
            <form action="<?php echo site_url('/RegisterAccount')?>" method="post" onsubmit="return validateForm()">
                <h1>Create Account</h1>
                <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?= site_url('auth/google') ?>" class="social"><i class="fab fa-google-plus-g"></i> </a>
                    </div>
                <span>or use your Username for registration</span>
                <input type="text" placeholder="Username" id="username" name="username" onblur="checkNotEmpty(this)" />
                <input type="password" placeholder="Password" id="password" name="password" onblur="checkNotEmpty(this)" />
                <input type="password" placeholder="Confirm Password" id="confirm-password" onblur="checkPasswordMatch()" />
                <p id="error-message" style="color:red; display:none;">Passwords do not match!</p>
                <button type="submit">Sign Up</button>
            </form>
            </div>
            <div class="form-container sign-in-container">
            <form method="post" action="<?= site_url('/login/auth') ?>">
                    <h1>Sign in</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?= site_url('auth/google') ?>" class="social"><i class="fab fa-google-plus-g"></i> </a>

                    </div>
                    <span>or use your account</span>
                    <input type="text" placeholder="Username" name="user" />
                    <input type="password" placeholder="Password" name=" Pass" />
                    <?php if (isset($error)): ?>
                        <p style="color:red;"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <a href="/forgotpassword">Forgot your password?</a>
                    <button>Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const container = document.getElementById('container');

            signUpButton.addEventListener('click', () => {
                container.classList.add('right-panel-active');
            });

            signInButton.addEventListener('click', () => {
                container.classList.remove('right-panel-active');
            });
            function checkNotEmpty(input) {
                if (input.value.trim() === '') {
                    input.classList.add('error-border');
                } else {
                    input.classList.remove('error-border');
                }
            }
            function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const confirmPasswordInput = document.getElementById('confirm-password');
            const errorMessage = document.getElementById('error-message');
            
                if (confirmPassword.trim() === '') {
                    confirmPasswordInput.classList.add('error-border');
                    errorMessage.style.display = 'none';
                } else if (password !== confirmPassword) {
                    confirmPasswordInput.classList.add('error-border');
                    errorMessage.style.display = 'block';
                } else {
                    confirmPasswordInput.classList.remove('error-border');
                    errorMessage.style.display = 'none';
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