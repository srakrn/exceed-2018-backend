@extends('bootstrap')

@section('jumbotron')
<h1>Server Statistics</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <h1>Database Statistics</h1>
        <table class="table">
            <tr>
                <td width="40%">Newest record ID</td>
                <td width="60%">{{ $last_record->id }}</td>
            </tr>
            <tr>
                <td>Newest record made by</td>
                <td>{{ $last_record->key_2 }}</td>
            </tr>
            <tr>
                <td>Newest record created at</td>
                <td>{{ $last_record->created_at }}</td>
            </tr>
        </table>
        <h1>Server Information</h1>
        <table class="table">
            <tr>
                <td width="40%">Server address</td>
                <td width="60%">{{ $_SERVER['REMOTE_ADDR'] }}</td>
            </tr>
            <tr>
                <td>Server host</td>
                <td>{{ $_SERVER['HTTP_HOST'] }}</td>
            </tr>
            <tr>
                <td>Configured URL</td>
                <td>{{ env('APP_URL', false) }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection