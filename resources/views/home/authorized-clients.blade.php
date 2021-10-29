@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               <passport-authorized-clients></passport-authorized-clients>
            </div>
        </div>
    </div>
</div>
@endsection
