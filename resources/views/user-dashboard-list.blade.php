@extends('layouts.app')
@push('links')
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@section('contents')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Users <small>list</small></h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
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
                                                        <td>{{ $user->city->name }}</td>
                                                        <td>
                                                            <a href="{{ url('user/edit?id='.$user->id) }}" class="btn btn-Primary">Edit</a>
                                                            <a href="{{ url('user/delete/'.$user->id) }}" class="btn btn-danger">Delete</a>
                                                            <button class="delete-user btn btn-danger">Delete Ajax</button>
                                                        </td>
                                                    </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
@endpush
