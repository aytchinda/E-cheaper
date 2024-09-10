@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Carrier</h3>

        <a href="{{ route('admin.carrier.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Name</th> 
        <td>{{ $carrier->name }}</td>
</tr>
    <tr>
        <th>Description</th> 
        <td>{{ $carrier->description }}</td>
</tr>
    <tr>
        <th>ImageUrl</strong></th>
        <td>
            <div class="form-group d-flex" id="preview_imageUrl" style="max-width: 100%;">
                <img src="{{ Str::startsWith($carrier->imageUrl, 'http') ? $carrier->imageUrl : Storage::url($carrier->imageUrl) }}"
                     alt="Prévisualisation de l'image"
                     style="max-width: 100px; display: block;">
            </div>
        </td>
     </tr>
    <tr>
        <th>Price</th> 
        <td>{{ $carrier->price }}</td>
</tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.carrier.edit', ['id' => $carrier->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection