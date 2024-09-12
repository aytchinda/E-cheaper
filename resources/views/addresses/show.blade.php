@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Address</h3>

        <a href="{{ route('admin.address.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Name</th> 
        <td>{{ $address->name }}</td>
</tr>
    <tr>
        <th>ClientName</th> 
        <td>{{ $address->clientName }}</td>
</tr>
    <tr>
        <th>Street</th> 
        <td>{{ $address->street }}</td>
</tr>
    <tr>
        <th>CodePostal</th> 
        <td>{{ $address->codePostal }}</td>
</tr>
    <tr>
        <th>City</th> 
        <td>{{ $address->city }}</td>
</tr>
    <tr>
        <th>State</th> 
        <td>{{ $address->state }}</td>
</tr>
    <tr>
        <th>NoreDetails</th> 
        <td>{{ $address->noreDetails }}</td>
</tr>
    <tr>
        <th>AddressType</th> 
        <td>{{ $address->addressType }}</td>
</tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.address.edit', ['id' => $address->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection