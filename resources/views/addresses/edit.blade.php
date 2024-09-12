@extends('admin')

@section('content')
    <div >
        <h3>Edit Address</h3>
        <a href="{{ route('admin.address.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('addresses/addressForm', ['address' => $address])
    </div>
@endsection