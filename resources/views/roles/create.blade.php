@extends('admin')

@section('content')
<div >
    <h3>Create Role</h3>
    <a href="{{ route('admin.role.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('roles/roleForm')
        </div>
@endsection
