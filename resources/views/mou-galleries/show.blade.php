<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Galeri MOU - {{ $submission->institution_name }}</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet" />
    <link href="/css/bootstrap2.min.css" rel="stylesheet" />
    <link href="/css/bootstrap-icons.css" rel="stylesheet" />
    <link href="/css/templatemo-topic-listing.css" rel="stylesheet" />
</head>

<body id="top">
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/img/logo.png" width="150px" alt="" />
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse justify-content-center navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto" style="padding-right: 109px">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mou-submission-store') }}">Pengajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/status">Cek Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                    </ul>

                    <div class="d-none d-lg-block">
                        <a href="/login" class="navbar-icon bi-person smoothscroll"></a>
                    </div>
                </div>
            </div>
        </nav>

        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-12 mx-auto">
                        <h1 class="text-white text-center">Galeri MOU</h1>
                        <h6 class="text-center text-white">
                            {{ $submission->institution_name }} - {{ $submission->cooperation_title }}
                        </h6>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a href="/" class="btn btn-outline-primary mb-4">
                            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                        </a>

                        @if ($submission->mouGalleries->isEmpty())
                            <div class="text-center py-5">
                                <h4>Tidak ada foto galeri untuk pengajuan ini.</h4>
                                <p class="text-muted">Belum ada dokumentasi yang dipublikasikan.</p>
                            </div>
                        @else
                            <div class="row g-4">
                                @foreach ($submission->mouGalleries as $gallery)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="custom-block bg-white shadow-lg h-100">
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                                 class="custom-block-image img-fluid w-100" 
                                                 alt="Gallery Image" 
                                                 style="object-fit: cover; height: 220px; cursor: pointer;"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#imageModal{{ $gallery->id }}">
                                            
                                            <div class="custom-block-info">
                                                @if($gallery->caption)
                                                    <h6 class="mb-2">{{ $gallery->caption }}</h6>
                                                @endif
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar"></i> 
                                                    Diunggah: {{ $gallery->created_at->format('d M Y H:i') }}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="imageModal{{ $gallery->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            @if($gallery->caption)
                                                                {{ $gallery->caption }}
                                                            @else
                                                                Foto Galeri
                                                            @endif
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                                             class="img-fluid rounded" 
                                                             alt="Gallery Image">
                                                        @if($gallery->caption)
                                                            <p class="mt-3 mb-0 text-muted">{{ $gallery->caption }}</p>
                                                        @endif
                                                        <small class="d-block mt-2 text-muted">
                                                            Diunggah: {{ $gallery->created_at->format('d M Y H:i') }}
                                                        </small>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 mb-4 pb-2">
                    <a class="navbar-brand mb-2" href="/">
                        <img src="/img/logo.png" width="150px" alt="">
                    </a>
                    <p class="small">
                        Pusat Kerja Sama & Hubungan Luar Negeri<br />Universitas Islam
                        Negeri Sumatera Utara
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="site-footer-title mb-3">Navigasi</h6>
                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="/" class="site-footer-link">Beranda</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="{{ route('mou-submission-store') }}" class="site-footer-link">Pengajuan MOU</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="/status" class="site-footer-link">Cek Status</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Informasi Kontak</h6>
                    <p class="d-flex mb-1">
                        <i class="bi-telephone me-2"></i>
                        <a href="tel:0616615683" class="site-footer-link">(061) 6615683 – 6622925</a>
                    </p>
                    <p class="d-flex">
                        <i class="bi-envelope me-2"></i>
                        <a href="mailto:humas@uinsu.ac.id" class="site-footer-link">humas@uinsu.ac.id</a>
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                    <p class="copyright-text mt-lg-5 mt-4">
                        © 2025 UINSU Medan<br />
                        Pusat Kerja Sama & Hubungan Luar Negeri<br /><br />
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery.sticky.js"></script>
    <script src="/js/click-scroll.js"></script>
    <script src="/js/custom.js"></script>
</body>
</html>