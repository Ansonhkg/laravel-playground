@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>

                <div class="panel-body">
                    @component('components.message')
                    @endcomponent

                    <form method="POST" action="{{route('updatepassword')}}">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="inputActualPassword" class="col-sm-2">Old Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="old" placeholder="Old Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputNewPassword" class="col-sm-2">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="New Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputConfirmPassword" class="col-sm-2">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Details</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
