<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">
    <title>Create Employee</title>
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="profile-container">
        <h1>Create Employee</h1>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p style="color:red;"><em><?= esc($error) ?></em></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <!-- Form to create an employee -->
        <form action="<?= site_url('/addEmployee') ?>" method="post">
            <div class="profile-item">
                <label for="fullname">Full name</label>
                <input type="text" id="fullname" name="full_name" value="<?= old('fullname') ?>">
                <p class="note">Enter your name, so people you know can recognize you. No "&lt;" or "&gt;"</p>
            </div>
            <div class="profile-item">
                <label for="username">Username</label>
                <input type="text" id="username" name="Username" value="<?= old('username') ?>">
            </div>
            <div class="profile-item">
                <label for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" value="<?= old('birthdate') ?>">
            </div>
            <div class="profile-item">
                <label for="gender">Gender</label>
            </div>
            <div class="radio">
                <input type="radio" name="gender" >Male
                <input type="radio" name="gender" >Female
            </div>
            <div class="profile-item">
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="">Select a role</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['role_id'] ?>" <?= old('role') == $role['role_id'] ? 'selected' : '' ?>><?= $role['role_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="profile-item">
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="<?= old('phone_number') ?>">
            </div>
            <div class="profile-item">
                <label for="department_id">Department</label>
                <select name="department_id" id="department_id">
                    <option value="">Select a department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?= $department['id'] ?>" <?= old('department_id') == $department['id'] ? 'selected' : '' ?>><?= $department['department_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="profile-item">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3"><?= old('address') ?></textarea>
            </div>
            <div class="profile-item">
                <label for="marital_status">Marital Status</label>
                <input type="text" id="marital_status" name="marital_status" value="<?= old('marital_status') ?>">
            </div>
            <div class="profile-item">
                <button type="submit" class="create">Create Employee</button>
            </div>
        </form>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Display SweetAlert notifications -->

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
