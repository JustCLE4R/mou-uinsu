<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Status Pengajuan MOU</title>

    <!-- CSS FILES -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet" />

    <link href="css/bootstrap2.min.css" rel="stylesheet" />

    <link href="css/bootstrap-icons.css" rel="stylesheet" />

    <link href="css/templatemo-topic-listing.css" rel="stylesheet" />

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body id="top">
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="img/logo.png" width="150px" alt="" />
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
                            <a class="nav-link " href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('mou-submission-store') }}">Pengajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/status">Cek Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/login">Login</a>
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
                        <h1 class="text-white text-center">Cek Status MOU Anda</h1>
                        <h6 class="text-center">
                            Kami mengundang lembaga, instansi, sekolah, industri, dan mitra strategis lainnya untuk
                            membangun kolaborasi yang berdampak.
                        </h6>

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="GET" action="{{ url()->current() }}" class="custom-form mt-4 pt-2 mb-lg-0 mb-5">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bi-search" id="basic-addon1"></span>
                                <input style="margin-bottom: 0px !important; border: none !important;"
                                    name="reference_number" type="text" class="form-control" id="reference_number"
                                    placeholder="Masukkan nomor referensi pengajuan"
                                    value="{{ request('reference_number') }}" required />
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>


                        @if (!empty($submission))
                            @php
                                $steps = [
                                    'pending' => 'Menunggu',
                                    'review' => 'Ditinjau',
                                    'finish' => 'Disetujui/Ditolak',
                                ];
                                $status = $submission->status;
                                $stepKeys = array_keys($steps);
                                $currentStep = $status === 'pending' ? 0 : ($status === 'review' ? 1 : 2);
                            @endphp

                            <style>
                                .step-wrapper-animated {
                                    display: flex;
                                    justify-content: center;
                                    position: relative;
                                    margin-bottom: 3rem;
                                }
                                .text-primary{
                                    color: black !important;
                                }
                                .text-secondary{
                                    color: #13547a !important;
                                }

                                .step-line-animated {
                                    position: absolute;
                                    top: 35%;
                                    left: 0;
                                    height: 3px;
                                    background: linear-gradient(90deg, #6c757d, #dee2e6);
                                    width: 100%;
                                    z-index: 1;
                                }

                                .step-item-animated {
                                    position: relative;
                                    text-align: center;
                                    width: 120px;
                                    z-index: 2;
                                    animation: fadeInUp 0.8s ease-in-out;
                                }

                                .step-circle-animated {
                                    width: 55px;
                                    height: 55px;
                                    margin: auto;
                                    border-radius: 50%;
                                    font-size: 1.2rem;
                                    color: white;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
                                }

                                @keyframes fadeInUp {
                                    from {
                                        opacity: 0;
                                        transform: translateY(15px);
                                    }

                                    to {
                                        opacity: 1;
                                        transform: translateY(0);
                                    }
                                }
                            </style>

                            <div class="mt-5">
                                <h2 class="mb-4 text-center">Status Pengajuan MOU</h2>

                                <div class="step-wrapper-animated">
                                    <div class="step-line-animated"></div>
                                    @foreach ($steps as $key => $label)
                                        @php
                                            $idx = $loop->index;
                                            if ($key === 'finish') {
                                                if ($status === 'approved') {
                                                    $circleClass = 'bg-success';
                                                    $icon = '<i class="bi bi-check-lg text-white"></i>';
                                                    $label = 'Disetujui';
                                                } elseif ($status === 'rejected') {
                                                    $circleClass = 'bg-danger';
                                                    $icon = '<i class="bi bi-x-lg text-white"></i>';
                                                    $label = 'Ditolak';
                                                } else {
                                                    $circleClass =
                                                        $currentStep > $idx
                                                            ? 'bg-success'
                                                            : ($currentStep == $idx
                                                                ? 'bg-primary'
                                                                : 'bg-secondary');
                                                    $icon = $loop->iteration;
                                                }
                                            } else {
                                                $circleClass =
                                                    $currentStep > $idx
                                                        ? 'bg-success'
                                                        : ($currentStep == $idx
                                                            ? 'bg-primary'
                                                            : 'bg-secondary');
                                                $icon =
                                                    $currentStep > $idx
                                                        ? '<i class="bi bi-check-lg text-white"></i>'
                                                        : $loop->iteration;
                                            }
                                        @endphp
                                        <div class="step-item-animated mx-2">
                                            <div class="step-circle-animated {{ $circleClass }}">
                                                {!! $icon !!}
                                            </div>
                                            <div class="mt-2 fw-semibold text-secondary small">{{ $label }}</div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="text-center mt-4">
                                    <h4>
                                        @switch($status)
                                            @case('pending')
                                                <span class="text-warning">Menunggu verifikasi admin.</span>
                                            @break

                                            @case('review')
                                                <span class="text-primary">Pengajuan sedang ditinjau.</span>
                                            @break

                                            @case('approved')
                                                <span class="text-success">Pengajuan telah disetujui.</span>
                                            @break

                                            @case('rejected')
                                                <span class="text-danger">Pengajuan ditolak.</span>
                                            @break

                                            @default
                                                <span class="text-muted">Status tidak diketahui.</span>
                                        @endswitch
                                    </h4>
                                    @if (!empty($submission->status_message))
                                        <div class="alert {{ $status === 'rejected' ? 'alert-danger' : 'alert-info' }} mt-3"
                                            role="alert">
                                            {{ $submission->status_message }}
                                        </div>
                                    @endif
                                </div>
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
                    <a class="navbar-brand mb-2" href="index.html">
                        <img src="img/logo.png" width="150px" alt="">
                    </a>
                    <p class=" small">
                        Pusat Kerja Sama & Hubungan Luar Negeri<br />Universitas Islam
                        Negeri Sumatera Utara
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="site-footer-title mb-3">Navigasi</h6>
                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="#section_1" class="site-footer-link">Beranda</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="#section_2" class="site-footer-link">Pengajuan MOU</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="#section_3" class="site-footer-link">Alur Proses</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="#section_3" class="site-footer-link">Kontak</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Informasi Kontak</h6>
                    <p class=" d-flex mb-1">
                        <i class="bi-telephone me-2"></i>
                        <a href="tel:+620000000000" class="site-footer-link">+62 000-0000-0000</a>
                    </p>
                    <p class=" d-flex">
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
