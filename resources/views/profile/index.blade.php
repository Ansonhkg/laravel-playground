@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>My Profile</b></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif
                    </br>

                    <div class="card col-md-6 col-md-offset-3">
                        <div class="card-body">
                            <p class="card-text text-center">{{ Auth::user()->name }}</p>
                        </div>
                        <img class="img-thumbnail" src="{{ $profile_pic }}" alt="{{ $profile_pic }}">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update-profile-pic') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" name="image"/>
                                <button type="submit" class="btn btn-success">Upload</button>
                            </form>
                            <p class="card-text text-center">{{  Auth::user()->email }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
