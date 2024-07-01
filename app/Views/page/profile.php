<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">
</head>
<body>
    <div class="profile-container">
        <form action="<?= site_url('/profile/updateProfile') ?>" method="Post">
            <h1>Profile</h1>
            
            <div class="profile-item">
                <label for="full_name">Full name</label>
                <input type="text" id="full_name" name="full_name" value="<?= $profile['full_name'] ?>">
                <p class="note">Enter your name, so people you know can recognize you. No "&lt;" or "&gt;"</p>
            </div>

            <div class="profile-item">
                <label for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" value="<?= $profile['birthdate'] ?>">
            </div>

            <div class="profile-item">
                <label for="gender">Gender</label>
                <input type="text" id="gender" name="gender" value="<?= $profile['gender'] ?>">
            </div>

            <div class="profile-item">
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="<?= $profile['phone_number'] ?>">
            </div>

            <div class="profile-item">
                <label for="department_id">Department </label>
                <input type="text" id="department" value="<?= $profile['department_name'] ?>" readonly>
            </div>

            <div class="profile-item">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3"><?= $profile['address'] ?></textarea>
            </div>

            <div class="profile-item">
                <label for="marital_status">Marital Status</label>
                <input type="text" id="marital_status" name="marital_status" value="<?= $profile['marital_status'] ?>">
            </div>

            <div class="profile-item">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" value="<?= $profile['start_date'] ?>" readonly>
            </div>

            <div class="profile-item">
                <label for="salary">Salary</label>
                <input type="text" id="salary" value="<?= $profile['salary'] ?>" readonly>
            </div>

            <div class="profile-item">
                <label for="allowance">Allowance</label>
                <input type="text" id="allowance" value="<?= $profile['allowance'] ?>" readonly>
            </div>

            <div class="profile-item">
                <button type="submit" class="create">Update profile</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
<!-- Display SweetAlert notifications -->
<?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            text: '<?= esc(session()->getFlashdata('error')) ?>'
        });
    </script>
<?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                text: '<?= esc(session()->getFlashdata('success')) ?>'
            });
        </script>
    <?php endif; ?>
</body>
</html>
