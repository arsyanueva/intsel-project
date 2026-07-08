@extends('layouts.admin')

@section('title','Edit Category')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Edit Category</h3>
                <hr>

                <form method="POST" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @include('categories._form', ['button' => 'Update'])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
