@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@if (session('failure'))
    <div class="alert alert-danger">
        {{ session('failure') }}
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