@extends('layouts.admin')

@section('title','Create User')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Create User</h3>
                <hr>

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    @include('users._form', ['button' => 'Save'])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
