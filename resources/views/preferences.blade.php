@extends('bootstrap')

@section('jumbotron')
<h1>Preferences</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
    <form>
        @foreach ($preferences as $p)
            <div class="form-group row">
                <label for="{{ $p->id }}" class="col-sm-2 col-form-label">{{ $p->id }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="{{ $p->id }}" id="{{ $p->id }}" value="{{ $p->value }}">
                </div>
            </div>
        @endforeach
    </form>
    </div>
</div>
@endsection