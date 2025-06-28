@extends('layouts.main')

@push('styles')
<style>
  .preview-wrapper:hover .remove-btn {
    opacity: 1;
  }
  .remove-btn {
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
  }
</style>
@endpush

@section('content')
<section class="section-padding py-5" style="margin-top: 10vh;">
    <div class="container">
        <h1>Upload Gallery</h1>
        <div class="card shadow-sm"
        style="
            background-color: #ffffff !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            cursor: pointer;
            "
        >
            <div class="card-body">
                <form action="{{ route('superadmin.mou.gallery.store', $submission->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="image_path" class="form-label">Foto <span class="text-danger">*</span></label>
                        <input type="file" name="image_path[]" id="image_path" class="form-control @error('image_path') is-invalid @enderror" accept="image/*" multiple required>
                        <div id="preview-container" class="mt-3"></div>
                        @error('image_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="caption" class="form-label">Caption (Opsional)</label>
                        <input type="text" name="caption" id="caption" class="form-control @error('caption') is-invalid @enderror" maxlength="255" placeholder="Deskripsi singkat foto">
                        @error('caption')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-upload"></i> Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
  document.getElementById('image_path').addEventListener('change', function(e) {
  const previewContainer = document.getElementById('preview-container');
  previewContainer.innerHTML = '';

  Array.from(e.target.files).forEach((file, index) => {
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const previewDiv = document.createElement('div');
        previewDiv.className = 'position-relative d-inline-block m-3 preview-wrapper'; // ⬅️ MARGIN moved here

        previewDiv.innerHTML = `
          <img src="${e.target.result}" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
          <button type="button" class="btn btn-danger btn-sm position-absolute  remove-btn" 
                  onclick="removePreview(this, ${index})"
                  style="top: 0; right: 0; transform: translate(50%, -50%); z-index: 10;">
            <i class="bi bi-x"></i>
          </button>
        `;
        previewContainer.appendChild(previewDiv);
      };
      reader.readAsDataURL(file);
    }
  });
});

  function removePreview(button, index) {
    const fileInput = document.getElementById('image_path');
    const dt = new DataTransfer();
    
    Array.from(fileInput.files).forEach((file, i) => {
      if (i !== index) {
        dt.items.add(file);
      }
    });
    
    fileInput.files = dt.files;
    button.parentElement.remove();
  }
</script>
@endpush