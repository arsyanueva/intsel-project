@extends('layouts.admin')

@section('title','Create Borrowing')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Create Borrowing</h3>
                <hr>

                <form method="POST" action="{{ route('borrowings.store') }}">
                    @csrf

                    @include('borrowings._form', ['button' => 'Save'])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
