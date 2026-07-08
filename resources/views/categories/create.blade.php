@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Create Category</h3>
                <hr>

                <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                    @csrf

                    @include('categories._form', ['button' => 'Save'])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
