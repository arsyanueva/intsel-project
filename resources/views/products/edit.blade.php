@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Edit Product</h3>
                <hr>

                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @include('products._form', ['button' => 'Update'])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
