<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <br><br>
            <div class="list-group list-group-flush">
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-light">Home</a>
                <a href="" class="list-group-item list-group-item-action bg-light">Edit Profile</a>
                <a href="" class="list-group-item list-group-item-action bg-light">Settings</a>
                <a href="{{ route('change.password') }}" class="list-group-item list-group-item-action bg-light">Change password</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="list-group-item list-group-item-action bg-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid mt-4">
                <h1 class="text-center">Welcome, {{ $user->username }}</h1>

                @if ($profile)
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th>Full Name</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Marital Status</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $profile->full_name }}</td>
                                <td>{{ $profile->date_of_birth }}</td>
                                <td>{{ $profile->gender }}</td>
                                <td>{{ $profile->address }}</td>
                                <td>{{ $profile->phone_number }}</td>        
                                <td>{{ $profile->marital_status }}</td>
                                <td>{{ $profile->salary }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-warning text-center mt-4">No profile information available.</div>
                @endif
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>
