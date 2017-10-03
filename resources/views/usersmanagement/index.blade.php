@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users Management</div>

                <div class="panel-body" style="word-break:break-word"></div>
                <table class="table">
                    <thead>
                    Hi, {{ Auth::user()->name }}
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Actions</th>
                        </tr>

                        @foreach($users as $user)
                        <tbody>
                            <td scope="row">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)

                                @if($role->slug == 'admin')
                                    <span class="label label-danger">{{ $role->name }}</span>
                                @else
                                    <span class="label label-default">{{ $role->name }}</span>
                                @endif
                                @endforeach

                            </td>
                            <td>
                                @if(!$user->hasRole('admin'))
                                <form method="POST" action="{{ route('assignRole') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button>Assign Admin Role</button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('revokeRole') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button>Revoke Admin Role</button>
                                </form>
                                @endif
                            </td>
                        </tbody>
                        @endforeach
                    </thead>
                </table>

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
