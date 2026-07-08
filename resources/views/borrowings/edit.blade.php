@extends('layouts.admin')

@section('title','Edit Borrowing')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Edit Borrowing</h3>
                <hr>

                <form method="POST" action="{{ route('borrowings.update', $borrowing) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @include('borrowings._form', ['button' => 'Update'])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
