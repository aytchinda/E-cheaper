@extends('admin')

@section('content')
    <div >
        <h3>Edit Carrier</h3>
        <a href="{{ route('admin.carrier.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('carriers/carrierForm', ['carrier' => $carrier])
    </div>
@endsection