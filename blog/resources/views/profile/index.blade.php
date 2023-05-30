@extends('layouts.freeadds_layout')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

@section('content')
<!-- <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet"> -->


<container style="display:flex; justify-content:center; width:100%; margin-top:120px;">

    <div style="position: fixed; left: 20px; top: 100px; z-index: 999;" class="admin_menu">

        <div class="border">Name: {{$user->name}}</div>
        <div class="border">email: {{$user->email}}</div>
        <div class="border">Role: @if ($user->admin == 1) admin @else Standard user @endif</div>
        <div class="border">id: {{session('user')->id}}</div>

        <div><a class="waves-effect waves-light btn" href="{{ route('profile.edit',session('user')->id) }}">Edit profile</a></div>


    </div>

    <div style="display: flex; margin: auto; flex-direction: column;" class="card_container">
        <div><a class="waves-effect waves-light btn" href="{{ route('profile.createprod') }}">Add product</a></div>
        @foreach($products as $product)
        @if(session('user')->id == $product->created_by )
        <div style="margin: auto; margin-bottom: 20px; width: 100%;" class="row">
            <div style="width:100%;" class="col s12 m6">
                <div class="card">
                    <div class="card-image">
                        <img style="width:100%; height:auto;" src="{{ URL::asset($product->image_path) }}">
                        <span class="card-title">{{ $product->name }}</span>
                        <a style="position: absolute; right: 24px; bottom: -29px;" class="btn-floating halfway-fab waves-effect waves-light red"><i style="width: inherit; display: inline-block; text-align: center; color: #fff; font-size: 2.3rem; line-height: 34px;" class="material-icons">+</i></a>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 24px;" class="details_card">
                        <div>
                            <div style="padding: 5px 0;" class="card-content">
                                <p>@foreach($categorynames as $category_name)
                                    @if($category_name->id == $product->category_id)
                                    <strong style="font-size: 25px;">{{ $category_name['name'] }}</strong>
                                    @endif
                                    @endforeach
                                </p>
                            </div>
                            <div style="padding: 5px 0;" class="card-content">
                                <p>{{ $product->description }}</p>

                                <form style="display: flex; justify-content: space-between;" action="{{ route('profile.destroyprod', $product->id) }}" method="Post">
                                    <a style="margin:0 5;" class="waves-effect waves-light btn" href="{{ route('profile.editprod',$product->id) }}"> Edit </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="waves-effect waves-light btn">Delete</button>
                                </form>
                            </div>
                        </div>
                        <div>
                            <div style="padding: 5px 0;" class="card-content">
                                <p><strong style="font-size: 25px; display: flex; justify-content: flex-end;">{{ $product->price }} €</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach

    </div>
</container>
@endsection