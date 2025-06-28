@extends('layouts.main')
@section('content')
<section class="section-padding py-5" style="margin-top: 10vh;">
    <div class="container">
        <h1>MOU Galleries {{ $submission->institution_name }}</h1>
        <a href="{{ route('superadmin.mou.index') }}" class="btn btn-secondary mb-4">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar MOU
        </a>
        <a href="{{ route('superadmin.mou.gallery.create', $submission->id) }}" class="btn btn-primary mb-4">
            <i class="bi bi-plus"></i> Upload Gallery
        </a>
        @if ($mouGalleries->isEmpty())
            <p>Tidak ada foto galeri untuk pengajuan ini.</p>
        @else
            <div class="row g-3">
                @foreach ($mouGalleries as $gallery)
                    <div class="col-md-4 col-sm-6">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                 class="img-fluid rounded shadow-sm w-100" 
                                 alt="Gallery Image" 
                                 style="object-fit: cover; height: 250px; cursor: pointer;"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal{{ $gallery->id }}">
                            @if($gallery->caption || $gallery->created_at)
                                <div class="mt-0 mb-3 p-2 bg-white rounded shadow-sm">
                                    @if($gallery->caption)
                                        <p class="mb-1 text-dark">{{ $gallery->caption }}</p>
                                    @endif
                                    <small class="text-muted">Diunggah: {{ $gallery->created_at->format('d M Y H:i') }}</small>
                                </div>
                            @endif
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="imageModal{{ $gallery->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Gallery Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                             class="img-fluid" 
                                             alt="Gallery Image">
                                        @if($gallery->caption)
                                            <p class="mt-3 mb-0">{{ $gallery->caption }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
@endpush