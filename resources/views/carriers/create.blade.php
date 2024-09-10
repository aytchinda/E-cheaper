@extends('admin')

@section('content')
<div >
    <h3>Create Carrier</h3>
    <a href="{{ route('admin.carrier.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('carriers/carrierForm')
        </div>
@endsection
