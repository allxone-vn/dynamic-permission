<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission Management</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/permission.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="permission">
        <div class="table-select">
            <label for="Role">Role:</label>
            <select id="roleSelect">
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="table-select">
            <label for="tableSelect">Select a table:</label>
            <select id="tableSelect">
                <?php foreach ($tables as $table): ?>
                    <option value="<?= $table ?>"><?= $table ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="check-all-container">
            <h3>Permissions</h3>
            <div class="check-all-wrapper">
                <label><input type="checkbox" id="checkAll"> Check-All</label>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Permission Name</th>
                    <th><label><input type="checkbox" id="checkAllCreate"> Create</label></th>
                    <th><label><input type="checkbox" id="checkAllRead"> Read</label></th>
                    <th><label><input type="checkbox" id="checkAllUpdate"> Update</label></th>
                    <th><label><input type="checkbox" id="checkAllDelete"> Delete</label></th>
                </tr>
            </thead>
            <tbody id="permissionTable">
                <!-- Permissions will be populated here -->
            </tbody>
        </table>
        <button id="updatePermissionsBtn" class="update-btn">Update</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            populatePermissions();

            function populatePermissions(roleId) {
                var tableName = $('#tableSelect').val();

                $.ajax({
                    url: '<?= base_url('permissions/getTableColumnNames') ?>?tableName=' + tableName,
                    type: 'GET',
                    success: function(data) {
                        var tableBody = $('#permissionTable');
                        tableBody.empty();
                        console.log('Received data:', data);
                        $.each(data, function(index, columnName) {
                            var row = $('<tr>');
                            row.append('<td><span class="permissionName">' + columnName + '</span></td>');
                            row.append('<td><input type="checkbox" class="create-permission" value="1"></td>');
                            row.append('<td><input type="checkbox" class="read-permission" value="1"></td>');
                            row.append('<td><input type="checkbox" class="update-permission" value="1"></td>');
                            row.append('<td><input type="checkbox" class="delete-permission" value="1"></td>');
                            tableBody.append(row);
                            // if (index === 0) {
                            //     row.append('<td class="text-center delete-checkbox-cell" rowspan="' + data.length + '"><input type="checkbox" class="delete-checkbox" name="crud[delete]" value="1"></td>');
                            // }
                            // tableBody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to load permissions!'
                        });
                    }
                });
            }

            $('#tableSelect').change(function() {
                populatePermissions(); // Call the function to load data for the newly selected table
            });

            $('#roleSelect').change(function() {
                var roleId = $(this).val();
                if (roleId) {
                    populatePermissions(roleId);
                } else {
                    $('#permissionTable').empty();
                }
            });

            $('#checkAll').change(function() {
                var isChecked = $(this).is(':checked');
                $('.create-permission, .read-permission, .update-permission,.delete-permission').prop('checked', isChecked);
            });
            $('#checkAllCreate').change(function() {
                var isChecked = $(this).is(':checked');
                $('.create-permission').prop('checked', isChecked);
            });
            $('#checkAllRead').change(function() {
                var isChecked = $(this).is(':checked');
                $('.read-permission').prop('checked', isChecked);
            });
            $('#checkAllUpdate').change(function() {
                var isChecked = $(this).is(':checked');
                $('.update-permission').prop('checked', isChecked);
            });
            $('#checkAllDelete').change(function() {
                var isChecked = $(this).is(':checked');
                $('.delete-permission').prop('checked', isChecked);
            });
            $('#updatePermissionsBtn').click(function() {
                var roleId = $('#roleSelect').val();
                var permissions = [];

                $('#permissionTable tr').each(function() {
                    var columnName = $(this).find('.permissionName').text();
                    var create = $(this).find('.create-permission').is(':checked') ? 1 : 0;
                    var read = $(this).find('.read-permission').is(':checked') ? 1 : 0;
                    var update = $(this).find('.update-permission').is(':checked') ? 1 : 0;
                    var deletee = $(this).find('.delete-permission').is(':checked') ? 1 : 0;
                    var permissionValue = '' + create + read + update + deletee;

                    permissions.push({
                        role_id: roleId,
                        column_name: columnName,
                        permission_value: permissionValue
                    });
                });
                console.log('Update successful:', permissions);
                $.ajax({
                url: '<?= base_url('permissions/updatePermissions') ?>',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(permissions),
                success: function(response) {
                    // Xử lý phản hồi từ server nếu cần
                    console.log('Update successful:', response);
                    // Hiển thị thông báo thành công cho người dùng
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Permissions updated successfully.'
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    // Hiển thị thông báo lỗi cho người dùng
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to update permissions!'
                    });
                }

            });

            });
        });
    </script>
</body>
</html>
