@extends('layouts.freeadds_layout')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

@section('content')
<!-- <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet"> -->


<container style="display:flex; justify-content:center; width:100%; margin-top:120px;">


    <div style="display: flex; margin: auto; flex-direction: column;" class="card_container">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit profile</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('profile.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">
                        <strong>User Name:</strong>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="category name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>User email:</strong>
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control" placeholder="category name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
        </form>
    </div>
    </div>
</container>
@endsection