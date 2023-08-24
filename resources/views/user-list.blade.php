<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <h1>Welcome To User List Page</h1>
    <a class="btn btn-success" href="{{ route('logout') }}">Logout</a>
    <a class="btn btn-success" href="{{ route('user.create') }}">User Create</a>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-create-modal">User Create Ajax</button>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Email</td>
                <td>Gender</td>
                <td>Mo No.</td>
                <td>Image</td>
                <td>Hobby</td>
                <td>City</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
           @foreach ($users as $user)
                {{-- @php
                    $city_id = $user->city_id;
                    $city = DB::table('cities')->where('id',$city_id)->first();
                @endphp --}}
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->mo_no }}</td>
                    <td>
                        <img src="{{ asset('uploads/'.$user->image) }}" height="100">
                    </td>
                    <td>{{ $user->hobby }}</td>
                    {{-- <td>{{ $user->city_name }}</td> --}}
                    <td>{{ $user->city->name }}</td> Relation Ship
                    <td>
                        <a href="{{ url('user/edit?id='.$user->id) }}" class="btn btn-Primary">Edit</a>
                        <a href="{{ url('user/delete/'.$user->id) }}" class="btn btn-danger">Delete</a>
                        <button class="delete-user btn btn-danger">Delete Ajax</button>
                    </td>
                </tr>
           @endforeach
        </tbody>
    </table>

    <!-- The Modal -->
    <div class="modal" id="user-create-modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">User Create</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('user/store') }}" method="POST" id="user-create-form">
                        @csrf
                        <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mo No:</label>
                            <input type="number" class="form-control" id="pwd" placeholder="Enter Mo No" name="mo_no">
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary form-submit-button">Submit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.delete-user', function() {

            var u_id = $(this).data('u_id');
            var $this = $(this);
            $.ajax({
                type: "GET",
                url: "{{ route('user.delete.ajax') }}",
                data: {u_id: u_id},
                success: function(res) {
                    $this.parents('tr').hide();
                }
            })
        })

        $(document).on('click', '.form-submit-button', function() {
            var formData = $('#user-create-form').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('user.store') }}",
                data: formData,
                success: function(res){
                    console.log(res.user.na);
                }
            })

        })
    </script>
</body>

</html>
