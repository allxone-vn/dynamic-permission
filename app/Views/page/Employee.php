<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <style>
        /* Inline styles for the table */
        .Employee-container h1{
            text-align: center;
        }
        .Employee-container table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .Employee-container th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .Employee-container th {
            background-color: #f2f2f2;
            color: blue;
        }
    </style>
</head>
<body>
<div class="Employee-container">
    <h1>Employee</h1>
    <table>
        <tbody>
            <tr>
                <th>Username</th>
                <th>Field</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Department</th>
                <th>Start Date</th>
                <th>Salary</th>
                <th>Allowance</th>
            </tr>
            <?php foreach ($profiles as $profile): ?>
                <tr>
                <td><?= $profile['username'] ?></td>
                <td><?= $profile['full_name'] ?></td>
                <td><?= $profile['birthdate'] ?></td>
                <td><?= $profile['gender'] ?></td>
                <td><?= $profile['phone_number'] ?></td>
                <td><?= $profile['department_name'] ?></td>
                <td><?= $profile['start_date'] ?></td>
                <td><?= $profile['salary'] ?></td>
                <td><?= $profile['allowance'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
