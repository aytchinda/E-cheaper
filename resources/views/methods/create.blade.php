@extends('admin')

@section('content')
<div >
    <h3>Create Method</h3>
    <a href="{{ route('admin.method.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('methods/methodForm')
        </div>
@endsection
