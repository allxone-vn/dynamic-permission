@extends('admin')

<link rel="stylesheet" href="{{ asset('css/permission.css') }}">

@section('content')
<div class="text-center mb-4">
    <h2>Permission Management</h2>

    <!-- Form để cập nhật permissions -->
    <form action="{{ route('update-table-permissions') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary" style="float: left; margin-left: 0px">Update Table Permissions</button>
    </form>

    @if (session('success'))
        <div style="float: right" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="float: right" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>

<div class="container mt-5"> 
    <!-- Chọn role -->
    <div class="form-group">
        <label for="role" class="font-weight-bold">Select Role:</label>
        <select id="role" class="form-control">
            <option value="">--Select Role--</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Chọn table -->
    <div class="form-group" id="table-selection" style="display: none;">
        <label for="table" class="font-weight-bold">Select Table:</label>
        <select id="table" class="form-control" name="table_name">
            <option value="">--Select Table--</option>
            @foreach($tables as $table)
                <option value="{{ $table }}" {{ $selectedTable == $table ? 'selected' : '' }}>{{ $table }}</option>
            @endforeach
        </select>
    </div>

    <!-- Hiển thị bảng ma trận attribute và quyền CRUD -->
    <form action="{{ route('permissions.update') }}" method="POST" id="permission-form" style="display: none; text-align: center">
        @csrf
        <input type="hidden" name="role_id" id="role_id">
        <input type="hidden" name="table_name" id="table_name" value="{{ $selectedTable }}">
        <div class="table-responsive">
            <table class="table table-bordered mt-3" id="attributes-table" style="display: none;">
                <thead class="thead-dark">
                    <tr>
                        <th>Attribute</th>
                        <th>Create</th>
                        <th>Read</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="attributes-body">
                    @foreach($attributes as $index => $attribute)
                        <tr>
                            <td>{{ $attribute->attribute }}</td>
                            <td class="text-center"><input type="checkbox" class="crud-checkbox create-checkbox" name="crud[{{ $attribute->attribute }}][]" value="create"></td>
                            <td class="text-center"><input type="checkbox" class="crud-checkbox read-checkbox" name="crud[{{ $attribute->attribute }}][]" value="read"></td>
                            <td class="text-center"><input type="checkbox" class="crud-checkbox update-checkbox" name="crud[{{ $attribute->attribute }}][]" value="update"></td>
                            @if ($loop->first)
                                <td class="text-center delete-checkbox-cell" rowspan="{{ count($attributes) }}"><input type="checkbox" class="delete-checkbox" name="crud[delete]" value="delete"></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="form-group mt-1 checkall-container">
            <input type="checkbox" id="check-all-crud" class="checkall_box" title="Check all">
            <label for="check-all-crud">Check all</label>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('role').addEventListener('change', function() {
        const roleId = this.value;
        document.getElementById('role_id').value = roleId;
        if (roleId) {
            document.getElementById('table-selection').style.display = 'block';
        } else {
            document.getElementById('table-selection').style.display = 'none';
            document.getElementById('permission-form').style.display = 'none';
            document.getElementById('attributes-table').style.display = 'none';
        }
    });

    document.getElementById('table').addEventListener('change', function() {
        const tableName = this.value;
        document.getElementById('table_name').value = tableName;
        if (tableName) {
            fetchAttributes(tableName);
        } else {
            document.getElementById('permission-form').style.display = 'none';
            document.getElementById('attributes-table').style.display = 'none';
        }
    });

    function fetchAttributes(tableName) {
        fetch(`{{ url('get-attributes') }}?table_name=${tableName}`)
            .then(response => response.json())
            .then(data => {
                const attributesBody = document.getElementById('attributes-body');
                attributesBody.innerHTML = '';

                data.forEach((attribute, index) => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td>${attribute.attribute}</td>
                        <td class="text-center"><input type="checkbox" class="crud-checkbox create-checkbox" name="crud[${attribute.attribute}][]" value="create"></td>
                        <td class="text-center"><input type="checkbox" class="crud-checkbox read-checkbox" name="crud[${attribute.attribute}][]" value="read"></td>
                        <td class="text-center"><input type="checkbox" class="crud-checkbox update-checkbox" name="crud[${attribute.attribute}][]" value="update"></td>
                        ${index === 0 ? '<td class="text-center delete-checkbox-cell" rowspan="' + data.length + '"><input type="checkbox" class="delete-checkbox" name="crud[delete]" value="delete"></td>' : ''}
                    `;

                    attributesBody.appendChild(row);
                });

                document.getElementById('permission-form').style.display = 'block';
                document.getElementById('attributes-table').style.display = 'table';
            });
    }

    // Function to handle "Check All" feature
    document.getElementById('check-all-crud').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.crud-checkbox, .delete-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endsection
