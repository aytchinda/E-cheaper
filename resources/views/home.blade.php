@extends('base')

@section('content')

@include('cheaper/components/banner')

<div class="container-fluid" >
    <div >
        <table class="table ">
            <tbody>
                @foreach($products->chunk(3) as $chunk)
                    <tr>
                        @foreach($chunk as $product)
                            @php
                                // Supprimer les guillemets autour de l'URL de l'image
                                $imageUrl = trim($product->imageUrls, '["]');
                            @endphp
                            <td class="col-md-3">
                                <div class="card mb-4">
                                    <img src="{{ asset('storage/' . $imageUrl) }}" class="card-img-top" alt="{{ $product->name }}" width="400" height="300">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p class="card-text"><strong>Prix :</strong> ${{ $product->regularPrice }}</p>
                                    </div>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
