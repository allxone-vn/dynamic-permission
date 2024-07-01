<!-- app/Views/user_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/rolePer.css') ?>">
</head>
<body>
    <h1> PERMISSION</h1>
    <?php
$session = session();
$role_id = $session->get('role_id');

if (in_array($role_id, [1, 2])): ?>
    <a href="<?= site_url('/createEmployee') ?>"><button class="create">Create Employee</button></a>
<?php endif; ?>
    <?php if (!empty($userData) && is_array($userData)) : ?>
        <table>
            <thead>
                <tr>
                <th>STT</th>
                    <?php foreach (array_keys($userData[0]) as $column) : ?>
                        <th><?= esc($column) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
            <?php $index = 1; ?>
                <?php foreach ($userData as $user) : ?>
                    <tr>
                    <td><?= $index ?></td>
                        <?php foreach ($user as $value) : ?>
                            <td><?= esc($value) ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php $index++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No user data found.</p>
    <?php endif; ?>
</body>
</html>
