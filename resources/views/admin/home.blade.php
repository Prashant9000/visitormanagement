@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br>
                    <a class="btn btn-success" href="{{ route('user_index')}}"> User</a>
                    <a class="btn btn-success" href="{{ route('userInfoIndex')}}"> User Details</a>
                    <a class="btn btn-success" href="{{ route('visitorsLogIndex')}}"> Visitors Log</a>
                    <a class="btn btn-success" href="{{ route('visitorsNotesIndex')}}"> Visitors Note</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
