@extends('admin')

@section('content')
    <div >
        <h3>Edit Method</h3>
        <a href="{{ route('admin.method.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('methods/methodForm', ['method' => $method])
    </div>
@endsection