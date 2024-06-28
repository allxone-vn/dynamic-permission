<!-- app/Views/user_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
</head>
<body>
    <h1>User Data</h1>
    <?php if (!empty($userData) && is_array($userData)) : ?>
        <table border="1">
            <thead>
                <tr>
                    <?php foreach (array_keys($userData[0]) as $column) : ?>
                        <th><?= esc($column) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userData as $user) : ?>
                    <tr>
                        <?php foreach ($user as $value) : ?>
                            <td><?= esc($value) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No user data found.</p>
    <?php endif; ?>
</body>
</html>
