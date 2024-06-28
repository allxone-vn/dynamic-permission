<!-- app/Views/user_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <style>
       
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        p {
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>User Data</h1>
    <?php if (!empty($userData) && is_array($userData)) : ?>
        <table>
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
