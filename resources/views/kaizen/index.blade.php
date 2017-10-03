@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Kaizen Programs</div>

                <div class="panel-body">
                @foreach($slots as $key => $value)
                
                
                <table class="table table-responsive">
                    <tr>
                        <th>Description</th>
                        <th>Start</th>
                        <th>End</th>
                    </tr>
                @if($key==0) <h1>Sunday</h1> @endif
                @if($key==1) <h1>Monday</h1> @endif
                @if($key==2) <h1>Tuesday</h1> @endif
                @if($key==3) <h1>Wednesday</h1> @endif
                @if($key==4) <h1>Thursday</h1> @endif
                @if($key==5) <h1>Friday</h1> @endif
                @if($key==6) <h1>Saturday</h1> @endif
                
                @foreach($slots[$key] as $slot)
                <tr style="background-color:{{$slot['type']['color']}}; color:white;">
                    <td>{{ $slot['description'] }}</td>
                    <td>{{ $slot['start_time'] }}</td>
                    <td>{{ $slot['end_time'] }}</td>
                    
                </tr>
                @endforeach

                @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
