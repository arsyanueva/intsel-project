@extends('layouts.admin')

@section('title','Edit User')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Edit User</h3>
                <hr>

                <form method="POST" action="{{ route('users.update',$user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @include('users._form',[
                        'button'=>'Update'
                    ])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
