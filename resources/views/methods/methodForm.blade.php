    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
    <div class="col-md-8">
        <form action="{{ isset($method) ? route('admin.method.update', ['method' => $method->id]) : route('admin.method.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($method))
            @method('PUT')
        @endif    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text"  placeholder="Name ..."  name="name" value="{{ old('name', isset($method) ? $method->name : '') }}" class="form-control" id="name" aria-describedby="nameHelp" required/>

        @error('name')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text"  placeholder="Description ..."  name="description" value="{{ old('description', isset($method) ? $method->description : '') }}" class="form-control" id="description" aria-describedby="descriptionHelp" required/>

        @error('description')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="moreDescription" class="form-label">MoreDescription</label>
        <textarea name="moreDescription" class="form-control" id="moreDescription" aria-describedby="moreDescriptionHelp">{{ old('moreDescription', isset($method) ? $method->moreDescription : '') }}</textarea>

        @error('moreDescription')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <button type="button" class="btn btn-success btn-file my-1" onclick="triggerFileInput('imageUrl')">
            Add file :  (ImageUrl)
        </button>
        <input type="file" name="imageUrl" value="{{ old('imageUrl', isset($method) ? $method->imageUrl : '') }}" class="visually-hidden form-control imageUpload" id="imageUrl" aria-describedby="imageUrlHelp"/>

        <div class="form-group d-flex" id="preview_imageUrl" style="max-width: 100%;">
        </div>
        @error('imageUrl')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="test_public_key" class="form-label">Test_public_key</label>
        <input type="text"  placeholder="Test_public_key ..."  name="test_public_key" value="{{ old('test_public_key', isset($method) ? $method->test_public_key : '') }}" class="form-control" id="test_public_key" aria-describedby="test_public_keyHelp" required/>

        @error('test_public_key')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="test_private_key" class="form-label">Test_private_key</label>
        <input type="text"  placeholder="Test_private_key ..."  name="test_private_key" value="{{ old('test_private_key', isset($method) ? $method->test_private_key : '') }}" class="form-control" id="test_private_key" aria-describedby="test_private_keyHelp" required/>

        @error('test_private_key')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="prod_public_key" class="form-label">Prod_public_key</label>
        <input type="text"  placeholder="Prod_public_key ..."  name="prod_public_key" value="{{ old('prod_public_key', isset($method) ? $method->prod_public_key : '') }}" class="form-control" id="prod_public_key" aria-describedby="prod_public_keyHelp" required/>

        @error('prod_public_key')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="pro_private_key" class="form-label">Pro_private_key</label>
        <input type="text"  placeholder="Pro_private_key ..."  name="pro_private_key" value="{{ old('pro_private_key', isset($method) ? $method->pro_private_key : '') }}" class="form-control" id="pro_private_key" aria-describedby="pro_private_keyHelp" required/>

        @error('pro_private_key')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <a href="{{ route('admin.method.index') }}" class="btn btn-danger mt-1">
        Cancel
    </a>
    <button class="btn btn-primary mt-1"> {{ isset($method) ? 'Update' : 'Create' }}</button>
 </form>
    </div>
    <div class="col-md-4">
    <a  class="btn btn-danger mt-1" href="{{ route('admin.method.index') }}">
    Cancel
</a>
<button class="btn btn-primary mt-1"> {{ isset($method) ? 'Update' : 'Create' }}</button>
    </div>
    </div>

    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
                event.preventDefault()
                const files = this.files; // Récupérer tous les fichiers sélectionnés
                console.log(files)
                if (files && files.length > 0) {
                    const previewContainer = document.getElementById('preview_' + this.id);
                    previewContainer.innerHTML = ''; // Effacer le contenu précédent

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        if (file) {
                            const reader = new FileReader();
                            const img = document.createElement('img'); // Créer un élément img pour chaque image

                            reader.onload = function(event) {
                                img.src = event.target.result;
                                img.alt = "Prévisualisation de l'image"
                                img.style.maxWidth = '100px';
                                img.style.display = 'block';
                            }

                            reader.readAsDataURL(file);
                            previewContainer.appendChild(img); // Ajouter l'image à la prévisualisation
                            console.log({img})
                            console.log({previewContainer})
                        }
                    }
                    console.log({previewContainer})
                }
            });
        });
    </script>
    @endsection