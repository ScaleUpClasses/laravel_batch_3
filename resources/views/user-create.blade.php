<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>User Create</h2>
  <a href="{{ route('user.list') }}" class="btn btn-primary btn-sm">User List</a>
  <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm">Create Admin</a>
  <form action="{{ url('user/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{old('name')}}">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{old('email')}}">
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="pwd">Mo No:</label>
        <input type="number" class="form-control" id="pwd" placeholder="Enter Mo No" name="mo_no">
        @error('mo_no')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="pwd">Image</label>
        <input type="file" class="form-control"  name="image">
    </div>

    <div class="form-group">
        <label for="pwd">Hobby: </label>
        <input type="checkbox" name="hobby[]" value="reading">Reading
        <input type="checkbox" name="hobby[]" value="playing">Playing
        <input type="checkbox" name="hobby[]" value="travelling">Travelling
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
