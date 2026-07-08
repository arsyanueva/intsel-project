@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Create Product</h3>
                <hr>

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    @include('products._form', ['button' => 'Save'])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
