    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
        <div class="col-md-8">
            <form
                action="{{ isset($page) ? route('admin.page.update', ['page' => $page->id]) : route('admin.page.store') }}"
                method="POST">
                @csrf
                @if (isset($page))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" placeholder="Title ..." name="title"
                        value="{{ old('title', isset($page) ? $page->title : '') }}" class="form-control" id="title"
                        aria-describedby="titleHelp" required />

                    @error('title')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control" id="content" aria-describedby="contentHelp">{{ old('content', isset($page) ? $page->content : '') }}</textarea>

                    @error('content')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 d-flex gap-2">
                    <label for="isHead" class="form-label">IsHead</label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="isHead" value="0">
                        <input name="isHead" id="isHead" value="1" data-bs-toggle="toggle"  {{ old('isHead', isset($page) && $page->isHead ? 'checked' : '') }} class="form-check-input" type="checkbox" role="switch" />
                    </div>
                    @error('isHead')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 d-flex gap-2">
                    <label for="isFoot" class="form-label">IsFoot</label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="isFoot" value="0">
                        <input name="isFoot" id="isFoot" value="1" data-bs-toggle="toggle"  {{ old('isFoot', isset($page) && $page->isFoot ? 'checked' : '') }} class="form-check-input" type="checkbox" role="switch" />
                    </div>
                    @error('isFoot')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <a href="{{ route('admin.page.index') }}" class="btn btn-danger mt-1">
                    Cancel
                </a>
                <button class="btn btn-primary mt-1"> {{ isset($page) ? 'Update' : 'Create' }}</button>
            </form>
        </div>
        <div class="col-md-4">
            <a class="btn btn-danger mt-1" href="{{ route('admin.page.index') }}">
                Cancel
            </a>
            <button class="btn btn-primary mt-1"> {{ isset($page) ? 'Update' : 'Create' }}</button>
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
                                const img = document.createElement(
                                    'img'); // Créer un élément img pour chaque image

                                reader.onload = function(event) {
                                    img.src = event.target.result;
                                    img.alt = "Prévisualisation de l'image"
                                    img.style.maxWidth = '100px';
                                    img.style.display = 'block';
                                }

                                reader.readAsDataURL(file);
                                previewContainer.appendChild(img); // Ajouter l'image à la prévisualisation
                                console.log({
                                    img
                                })
                                console.log({
                                    previewContainer
                                })
                            }
                        }
                        console.log({
                            previewContainer
                        })
                    }
                });
            });
        </script>
    @endsection
