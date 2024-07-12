@extends('admin')

@section('content')
<div >
    <h3>Create Shopcollection</h3>
    <a href="{{ route('admin.shopcollection.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('shopcollections/shopcollectionForm')
        </div>
@endsection
