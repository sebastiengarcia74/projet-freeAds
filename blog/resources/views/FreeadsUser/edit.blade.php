@extends('layouts.freeadds_layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<h4 style="position: fixed; z-index: 999; left: 20px; top: 8px; color: white;">EDIT USER</h4>

<body>
    <div style="width: 60%; height: 86vh; display:flex; justify-content:center; margin-top:100px; flex-direction: column; border: none;" class="container">

        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Name:</strong>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="User name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Email:</strong>
                        <input type="email" name="email" class="form-control" placeholder="User Email" value="{{ $user->email }}">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User password:</strong>
                        <input type="password" name="password" class="form-control" placeholder="User Password" value="">
                        @error('password')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Phone number:</strong>
                        <input type="text" name="phone_number" class="form-control" placeholder="User Phone number" value="{{ $user->phone_number }}">
                        @error('nphone_umber')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="justify-content: space-between; display: flex;">
                    <a class="btn btn-primary" href="{{ route('users.index') }}" enctype="multipart/form-data">Back</a>
                    <button style="margin: 10px;" type="submit" class="btn btn-primary ml-3" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>