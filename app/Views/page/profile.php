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
        <h1>Profile</h1>

        <div class="profile-item">
            <label for="full_name">Full name</label>
            <input type="text" id="full_name" value="<?= $profile['full_name'] ?>" readonly>
            <p class="note">Enter your name, so people you know can recognize you. No "&lt;" or "&gt;"</p>
        </div>

        <div class="profile-item">
            <label for="birthdate">Birthdate</label>
            <input type="date" id="birthdate" value="<?= $profile['birthdate'] ?>" readonly>
        </div>

        <div class="profile-item">
            <label for="gender">Gender</label>
            <input type="text" id="gender" value="<?= $profile['gender'] ?>" readonly>
        </div>

        <div class="profile-item">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" value="<?= $profile['phone_number'] ?>" readonly>
        </div>
        <div class="profile-item">
            <label for="department_id">Department </label>
            <input type="text" id="department" value="<?= $profile['department_name'] ?>" readonly>
        </div>

        <div class="profile-item">
            <label for="address">Address</label>
            <textarea id="address" rows="3" readonly><?= $profile['address'] ?></textarea>
        </div>

        <div class="profile-item">
            <label for="marital_status">Marital Status</label>
            <input type="text" id="marital_status" value="<?= $profile['marital_status'] ?>" readonly>
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


    
    </div>
</body>
</html>