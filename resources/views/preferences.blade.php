@extends('bootstrap')

@section('jumbotron')
<h1>Preferences</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
    <form method="POST" action="/preferences/save">
        @csrf
        @foreach ($preferences as $p)
            <div class="form-group row">
                <label for="{{ $p->id }}" class="col-sm-2 col-form-label">{{ $p->id }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="{{ $p->id }}" id="{{ $p->id }}" value="{{ $p->value }}">
                </div>
            </div>
        @endforeach
        <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </form>
    </div>
</div>
@endsection