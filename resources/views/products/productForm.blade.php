@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

<div class="row">
    <div class="col-md-8">
        <form
            action="{{ isset($product) ? route('admin.product.update', ['product' => $product->id]) : route('admin.product.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" placeholder="Name ..." name="name"
                    value="{{ old('name', isset($product) ? $product->name : '') }}" class="form-control" id="name"
                    aria-describedby="nameHelp" required />
                @error('name')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" placeholder="Description ..." name="description"
                    value="{{ old('description', isset($product) ? $product->description : '') }}" class="form-control"
                    id="description" aria-describedby="descriptionHelp" required />
                @error('description')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categories" class="form-label">Categories</label>
                <select class="form-control" name="categories[]" id="categories" multiple>
                    <option disabled>Select product category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (in_array($category->id, old('categories', isset($product) ? $product->categories->pluck('id')->toArray() : []))) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('categories')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="moreDescrciption" class="form-label">More Description</label>
                <input type="text" placeholder="More Description ..." name="moreDescrciption"
                    value="{{ old('moreDescrciption', isset($product) ? $product->moreDescrciption : '') }}"
                    class="form-control" id="moreDescrciption" aria-describedby="moreDescrciptionHelp" required />
                @error('moreDescrciption')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="additionalInfos" class="form-label">Additional Infos</label>
                <textarea name="additionalInfos" class="form-control" id="additionalInfos" aria-describedby="additionalInfosHelp">{{ old('additionalInfos', isset($product) ? $product->additionalInfos : '') }}</textarea>
                @error('additionalInfos')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" placeholder="Stock ..." name="stock"
                    value="{{ old('stock', isset($product) ? $product->stock : '') }}" class="form-control"
                    id="stock" aria-describedby="stockHelp" required />
                @error('stock')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="soldePrice" class="form-label">Solde Price</label>
                <input type="text" placeholder="Solde Price ..." name="soldePrice"
                    value="{{ old('soldePrice', isset($product) ? $product->soldePrice : '') }}" class="form-control"
                    id="soldePrice" aria-describedby="soldePriceHelp" required />
                @error('soldePrice')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="regularPrice" class="form-label">Regular Price</label>
                <input type="text" placeholder="Regular Price ..." name="regularPrice"
                    value="{{ old('regularPrice', isset($product) ? $product->regularPrice : '') }}"
                    class="form-control" id="regularPrice" aria-describedby="regularPriceHelp" required />
                @error('regularPrice')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-success btn-file my-1" onclick="triggerFileInput('imageUrls')">
                    Add files : (ImageUrls)
                </button>
                <input type="file" name="imageUrls[]" class="form-control imageUpload visually-hidden" id="imageUrls"
                    aria-describedby="imageUrlsHelp" multiple />
                <div class="form-group hstack gap-3" id="preview_imageUrls" style="max-width: 100%;"></div>
                @error('imageUrls')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" placeholder="Brand ..." name="brand"
                    value="{{ old('brand', isset($product) ? $product->brand : '') }}" class="form-control"
                    id="brand" aria-describedby="brandHelp" required />
                @error('brand')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 d-flex gap-2">
                <label for="isAvailable" class="form-label">Is Available</label>
                <div class="form-check form-switch">
                    <input name="isAvailable" id="isAvailable" value="1"
                        {{ old('isAvailable', isset($product) && $product->isAvailable ? 'checked' : '') }}
                        class="form-check-input" type="checkbox" role="switch" />
                </div>
                @error('isAvailable')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 d-flex gap-2">
                <label for="isBestSeller" class="form-label">Is Best Seller</label>
                <div class="form-check form-switch">
                    <input name="isBestSeller" id="isBestSeller" value="1"
                        {{ old('isBestSeller', isset($product) && $product->isBestSeller ? 'checked' : '') }}
                        class="form-check-input" type="checkbox" role="switch" />
                </div>
                @error('isBestSeller')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 d-flex gap-2">
                <label for="isNewArrival" class="form-label">Is New Arrival</label>
                <div class="form-check form-switch">
                    <input name="isNewArrival" id="isNewArrival" value="1"
                        {{ old('isNewArrival', isset($product) && $product->isNewArrival ? 'checked' : '') }}
                        class="form-check-input" type="checkbox" role="switch" />
                </div>
                @error('isNewArrival')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 d-flex gap-2">
                <label for="isFeatured" class="form-label">Is Featured</label>
                <div class="form-check form-switch">
                    <input name="isFeatured" id="isFeatured" value="1"
                        {{ old('isFeatured', isset($product) && $product->isFeatured ? 'checked' : '') }}
                        class="form-check-input" type="checkbox" role="switch" />
                </div>
                @error('isFeatured')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 d-flex gap-2">
                <label for="isSpecialOffer" class="form-label">Is Special Offer</label>
                <div class="form-check form-switch">
                    <input name="isSpecialOffer" id="isSpecialOffer" value="1"
                        {{ old('isSpecialOffer', isset($product) && $product->isSpecialOffer ? 'checked' : '') }}
                        class="form-check-input" type="checkbox" role="switch" />
                </div>
                @error('isSpecialOffer')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="{{ route('admin.product.index') }}" class="btn btn-danger mt-1">Cancel</a>
            <button class="btn btn-primary mt-1"> {{ isset($product) ? 'Update' : 'Create' }}</button>
        </form>
    </div>

    <div class="col-md-4">
        <a class="btn btn-danger mt-1" href="{{ route('admin.product.index') }}">
            Cancel
        </a>
        <button class="btn btn-primary mt-1"> {{ isset($product) ? 'Update' : 'Create' }}</button>
    </div>
</div>

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <script>
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach((textarea) => {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
        });

        $(document).ready(function() {
            $('select').select2();
        });

        function triggerFileInput(fieldId) {
            const fileInput = document.getElementById(fieldId);
            if (fileInput) {
                fileInput.click();
            }
        }

        const imageUploads = document.querySelectorAll('.imageUpload');
        imageUploads.forEach(function(imageUpload) {
            imageUpload.addEventListener('change', function(event) {
                event.preventDefault();
                const files = this.files;
                if (files && files.length > 0) {
                    const previewContainer = document.getElementById('preview_' + this.id);
                    previewContainer.innerHTML = '';

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        if (file) {
                            const reader = new FileReader();
                            const img = document.createElement('img');

                            reader.onload = function(event) {
                                img.src = event.target.result;
                                img.alt = "Prévisualisation de l'image";
                                img.style.maxWidth = '100px';
                                img.style.display = 'block';
                            };

                            reader.readAsDataURL(file);
                            previewContainer.appendChild(img);
                        }
                    }
                }
            });
        });
    </script>
@endsection
