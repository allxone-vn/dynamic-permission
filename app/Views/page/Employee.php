<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/Employee.css') ?>">
</head>
<body>
<div class="Employee-container">
    <h1>Employee</h1>
    <a href="<?= site_url('/createEmployee') ?>"><button class="create">Create Employee</button></a>
    <form action="" method="post">
    <table>
        <tbody>
            <tr>
                <th>Username</th>
                <th>Field</th>
                <th>Birthdate</th>
                <th>Role</th>
                <th>Phone Number</th>
                <th>Department</th>
                <th>Start Date</th>
                <th>Salary</th>
                <th>Allowance</th>
                <th class="action">Action</th>
            </tr>
            <?php foreach ($profiles as $profile): ?>
                <tr>
                <td><?= $profile['username'] ?></td>
                <td><?= $profile['full_name'] ?></td>
                <td><?= $profile['birthdate'] ?></td>
                <td><?= $profile['role_name'] ?></td>
                <td><?= $profile['phone_number'] ?></td>
                <td><?= $profile['department_name'] ?></td>
                <td><?= $profile['start_date'] ?></td>
                <td><?= $profile['salary'] ?></td>
                <td><?= $profile['allowance'] ?></td>
                <td><i class="fa-regular fa-pen-to-square"></i> <a href=""><button class="sua">Edit</button></a> <br>
                <i class="fa-solid fa-square-xmark" style="color: #c71818;"></i>
                <form action="<?= site_url('/createE/delete') ?>" method="post" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?= esc($profile['UserID']) ?>">
                        <button type="submit" class="xoa">Delete</button>
                    </form>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
