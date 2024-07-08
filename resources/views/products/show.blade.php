@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div>
        <h3>Show Product</h3>

        <a href="{{ route('admin.product.index') }}" class="btn btn-success my-1">Home</a>

        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $product->slug }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <th>More Description</th>
                        <td>{{ $product->moreDescrciption }}</td>
                    </tr>
                    <tr>
                        <th>Additional Infos</th>
                        <td>{!! $product->additionalInfos !!}</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th>Solde Price</th>
                        <td>{{ $product->soldePrice }}</td>
                    </tr>
                    <tr>
                        <th>Regular Price</th>
                        <td>{{ $product->regularPrice }}</td>
                    </tr>
                    <tr>
                        <th>Image URLs</th>
                        <td>
                            <div class="form-group d-flex" id="preview_imageUrl" style="max-width: 100%;">
                                @php
                                    $imageUrls = is_array($product->imageUrls) ? $product->imageUrls : json_decode($product->imageUrls, true);
                                @endphp
                                @if (is_array($imageUrls) && !empty($imageUrls))
                                    @foreach ($imageUrls as $url)
                                        <img src="{{ Str::startsWith($url, 'http') ? $url : Storage::url($url) }}" alt="Prévisualisation de l'image" style="max-width: 100px; display: block;" />
                                    @endforeach
                                @else
                                    <p>No images available</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td>{{ $product->brand }}</td>
                    </tr>
                    <tr>
                        <th>Is Available</th>
                        <td>
                            <div class="form-check form-switch">
                                <input name="isAvailable" disabled id="isAvailable" value="1" {{ $product->isAvailable ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Is Best Seller</th>
                        <td>
                            <div class="form-check form-switch">
                                <input name="isBestSeller" disabled id="isBestSeller" value="1" {{ $product->isBestSeller ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Is New Arrival</th>
                        <td>
                            <div class="form-check form-switch">
                                <input name="isNewArrival" disabled id="isNewArrival" value="1" {{ $product->isNewArrival ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Is Featured</th>
                        <td>
                            <div class="form-check form-switch">
                                <input name="isFeatured" disabled id="isFeatured" value="1" {{ $product->isFeatured ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Is Special Offer</th>
                        <td>
                            <div class="form-check form-switch">
                                <input name="isSpecialOffer" disabled id="isSpecialOffer" value="1" {{ $product->isSpecialOffer ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
        </div>
    </div>
@endsection
