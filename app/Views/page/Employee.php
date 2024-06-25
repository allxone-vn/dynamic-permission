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
                <th class="action"></th>
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
                <td><i class="fa-regular fa-pen-to-square"></i><button class="sua">Edit</button> <br>
                <i class="fa-solid fa-square-xmark" style="color: #c71818;"></i><button class="xoa">Delete</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </form>
</div>
</body>
</html>
