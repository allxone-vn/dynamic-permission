<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/roleCreate.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    function toggleCheckboxes(row) {
        const readCheckbox = row.querySelector('input[name="read_permissions[]"]');
        const updateCheckbox = row.querySelector('input[name="update_permissions[]"]');
        const deleteCheckbox = row.querySelector('input[name="delete_permissions[]"]');

        function updateState() {
            if (readCheckbox.checked) {
                updateCheckbox.disabled = false;
                deleteCheckbox.disabled = false;
            } else {
                updateCheckbox.checked = false;
                deleteCheckbox.checked = false;
                updateCheckbox.disabled = true;
                deleteCheckbox.disabled = true;
            }
            updateHiddenField(row);
        }

        readCheckbox.addEventListener('change', updateState);
        updateState();
    }

    function updateHiddenField(row) {
        const createCheckbox = row.querySelector('input[name="create_permissions[]"]');
        const readCheckbox = row.querySelector('input[name="read_permissions[]"]');
        const updateCheckbox = row.querySelector('input[name="update_permissions[]"]');
        const deleteCheckbox = row.querySelector('input[name="delete_permissions[]"]');
        const hiddenField = row.querySelector('input[name="permission_values[]"]');
        const fieldName = row.querySelector('td:first-child').innerText.trim();

        let createValue = createCheckbox.checked ? '1' : '0';
        let readValue = readCheckbox.checked ? '1' : '0';
        let updateValue = updateCheckbox.checked ? '1' : '0';
        let deleteValue = deleteCheckbox.checked ? '1' : '0';

        hiddenField.value = `[${fieldName}] ${createValue}${readValue}${updateValue}${deleteValue}`;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('tr.permission-row').forEach(row => {
            toggleCheckboxes(row);
            row.addEventListener('change', () => updateHiddenField(row));
        });
    });
</script>

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

</head>
<body>
    <h1>Create Role</h1>
    <div class="crole">
        <form action="<?= site_url('/addRole') ?>" method="POST">
            <div class="role-input">
                <span>Role name</span>
                <input type="text" name="role_name" id="role_name" required>
            </div>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Create</th>
                    <th>Read</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <tr class="permission-row" data-field="FullName">
                    <td>full_name</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
                <tr class="permission-row" data-field="Birthdate">
                    <td>birthdate</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
                <tr class="permission-row" data-field="Gender">
                    <td>gender</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
                <tr class="permission-row" data-field="PhoneNumber">
                    <td>phone_number</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
                <tr class="permission-row" data-field="Address">
                    <td>address</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
                <tr class="permission-row" data-field="MaritalStatus">
                    <td>marital_status</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
                <tr class="permission-row" data-field="StartDate">
                    <td>start_date</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
                <tr class="permission-row" data-field="Salary">
                    <td>salary</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
                <tr class="permission-row" data-field="Allowance">
                    <td>allowance</td>
                    <td><input type="checkbox" name="create_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="read_permissions[]" value="1"></td>
                    <td><input type="checkbox" name="update_permissions[]" value="1" disabled></td>
                    <td><input type="checkbox" name="delete_permissions[]" value="1" disabled></td>
                    <input type="hidden" name="permission_values[]" value="">
                </tr>
            </table>
            <div class="form-actions">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
