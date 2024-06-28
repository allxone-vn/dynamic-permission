@extends('admin')

<link rel="stylesheet" href="{{ asset('css/permission.css') }}">

@section('content')
<div class="text-center mb-4">
    <h2>Permission Management</h2>
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

        <!-- Hiển thị bảng ma trận attribute và quyền CRUD -->
        <form action="{{ route('permissions.update') }}" method="POST" id="permission-form" style="display: none; text-align: center">
            @csrf
            <input type="hidden" name="role_id" id="role_id">
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
                    <tbody>
                        @foreach($attributes as $attribute)
                            <tr>
                                <td>{{ $attribute->attribute }}</td>
                                <td class="text-center"><input type="checkbox" name="crud[{{ $attribute->attribute }}][]" value="create"></td>
                                <td class="text-center"><input type="checkbox" name="crud[{{ $attribute->attribute }}][]" value="read"></td>
                                <td class="text-center"><input type="checkbox" name="crud[{{ $attribute->attribute }}][]" value="update"></td>
                                <td class="text-center"><input type="checkbox" name="crud[{{ $attribute->attribute }}][]" value="delete"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('role').addEventListener('change', function() {
        const roleId = this.value;
        document.getElementById('role_id').value = roleId;
        if (roleId) {
            document.getElementById('permission-form').style.display = 'block';
            document.getElementById('attributes-table').style.display = 'table';
        } else {
            document.getElementById('permission-form').style.display = 'none';
            document.getElementById('attributes-table').style.display = 'none';
        }
    });
</script>
@endsection
