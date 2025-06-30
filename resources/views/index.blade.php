<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Kerja Sama MOU – UINSU Medan</title>

    <!-- CSS FILES -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet" />

    <link href="css/bootstrap2.min.css" rel="stylesheet" />

    <link href="css/bootstrap-icons.css" rel="stylesheet" />

    <link href="css/templatemo-topic-listing.css" rel="stylesheet" />
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
                            <a class="nav-link active" href="{{ route('mou-galleries.index') }}">Galeri</a>
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
                        <h1 class="text-white text-center">APLIKASI SI-KERMA UINSU </h1>
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
                        <form method="GET" action="{{ route('mou-submission.status') }}"
                            class="custom-form mt-4 pt-2 mb-lg-0 mb-5">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bi-search" id="basic-addon1"></span>
                                <input style="margin-bottom: 0px !important; border: none !important;"
                                    name="reference_number" type="text" class="form-control" id="reference_number"
                                    placeholder="Masukkan nomor referensi pengajuan untuk cek status anda"
                                    value="{{ request('reference_number') }}" required />
                                <button type="submit" class="btn btn-primary">Cek Status</button>
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

                                .text-primary {
                                    color: black !important;
                                }

                                .text-secondary {
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

        <section class="featured-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-12 mb-4 mb-lg-0">
                        <div class="custom-block bg-white shadow-lg">

                            <div class="d-flex">
                                <div>
                                    <h5 class="mb-2">Tentang Kerja Sama</h5>
                                    <p class="mb-0">
                                        UINSU Medan membuka kesempatan kerja sama dalam bidang
                                        pendidikan, riset, pelatihan, pengabdian masyarakat,
                                        magang, hingga kegiatan sosial & keagamaan.
                                    </p>
                                </div>


                            </div>

                            <img src="img/topics/undraw_Remote_design_team_re_urdx.png"
                                class="custom-block-image img-fluid" alt="Tentang Kerja Sama" />

                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="custom-block custom-block-overlay">
                            <div class="d-flex flex-column h-100">
                                <img src="img/mou1.png" width="80px" class="custom-block-image img-fluid"
                                    alt="Bidang Kerja Sama" />

                                <div class="custom-block-overlay-text d-flex">
                                    <div>
                                        <h5 class="text-white mb-2">Bidang Kerja Sama</h5>

                                        <p class="text-white">
                                            📚 Pendidikan dan Pelatihan<br />🔬 Penelitian dan Riset
                                            Bersama<br />🏢 Magang dan Penyaluran SDM<br />📈
                                            Peningkatan Kompetensi<br />🎓 Kegiatan Sosial,
                                            Keagamaan & Event
                                        </p>

                                        <a href="{{ route('mou-submission') }}"
                                            class="btn custom-btn mt-2 mt-lg-3">Ajukan MOU</a>
                                    </div>


                                </div>

                                <div class="social-share d-flex">

                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-instagram"></a>
                                        </li>
                                    </ul>

                                    <a href="#" class="custom-icon bi-bookmark ms-auto"></a>
                                </div>

                                <div class="section-overlay"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="explore-section section-padding" id="section_2">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="mb-4">Bidang Kerja Sama</h2>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pendidikan-tab" data-bs-toggle="tab"
                                data-bs-target="#pendidikan-tab-pane" type="button" role="tab"
                                aria-controls="pendidikan-tab-pane" aria-selected="true">
                                Pendidikan
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="penelitian-tab" data-bs-toggle="tab"
                                data-bs-target="#penelitian-tab-pane" type="button" role="tab"
                                aria-controls="penelitian-tab-pane" aria-selected="false">
                                Penelitian
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="magang-tab" data-bs-toggle="tab"
                                data-bs-target="#magang-tab-pane" type="button" role="tab"
                                aria-controls="magang-tab-pane" aria-selected="false">
                                Magang
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kompetensi-tab" data-bs-toggle="tab"
                                data-bs-target="#kompetensi-tab-pane" type="button" role="tab"
                                aria-controls="kompetensi-tab-pane" aria-selected="false">
                                Kompetensi
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sosial-tab" data-bs-toggle="tab"
                                data-bs-target="#sosial-tab-pane" type="button" role="tab"
                                aria-controls="sosial-tab-pane" aria-selected="false">
                                Sosial & Keagamaan
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="myTabContent">
                            <!-- Pendidikan -->
                            <div class="tab-pane fade show active" id="pendidikan-tab-pane" role="tabpanel"
                                aria-labelledby="pendidikan-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Pelatihan Guru</h5>
                                                        <p class="mb-0">
                                                            Program peningkatan kapasitas guru di berbagai
                                                            jenjang pendidikan.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-design rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_Graduation_re_gthn.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Pengembangan Kurikulum</h5>
                                                        <p class="mb-0">
                                                            Kolaborasi menyusun kurikulum sesuai kebutuhan
                                                            zaman.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-design rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_Educator_re_ju47.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Pelatihan Mahasiswa</h5>
                                                        <p class="mb-0">
                                                            Workshop & pelatihan keterampilan untuk
                                                            mahasiswa.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-design rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_Finance_re_gnv2.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Penelitian -->
                            <div class="tab-pane fade" id="penelitian-tab-pane" role="tabpanel"
                                aria-labelledby="penelitian-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Riset Sosial</h5>
                                                        <p class="mb-0">
                                                            Penelitian kolaboratif di bidang sosial dan
                                                            kemasyarakatan.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-education rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_professor_d7zn.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Riset Teknologi</h5>
                                                        <p class="mb-0">
                                                            Pengembangan inovasi dan teknologi bersama
                                                            mitra.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-education rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_reading-book_qe4h.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Publikasi Ilmiah</h5>
                                                        <p class="mb-0">
                                                            Menerbitkan hasil riset bersama di jurnal
                                                            terakreditasi.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-education rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_Redesign_feedback_re_jvm0.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Magang -->
                            <div class="tab-pane fade" id="magang-tab-pane" role="tabpanel"
                                aria-labelledby="magang-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Program Magang</h5>
                                                        <p class="mb-0">
                                                            Mahasiswa ditempatkan langsung di perusahaan
                                                            mitra.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-finance rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_work-chat_hc3y.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Rekrutmen SDM</h5>
                                                        <p class="mb-0">
                                                            Mitra dapat merekrut lulusan terbaik dari UINSU.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-finance rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_scrum-board_uqku.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Kunjungan Industri</h5>
                                                        <p class="mb-0">
                                                            Kegiatan observasi langsung untuk menambah
                                                            wawasan mahasiswa.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-finance rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/colleagues-working-cozy-office-medium-shot.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kompetensi -->
                            <div class="tab-pane fade" id="kompetensi-tab-pane" role="tabpanel"
                                aria-labelledby="kompetensi-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Pelatihan Soft Skill</h5>
                                                        <p class="mb-0">
                                                            Program pengembangan komunikasi, kerja tim, dan
                                                            kepemimpinan.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-advertising rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_working-remotely_ivtz.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Sertifikasi</h5>
                                                        <p class="mb-0">
                                                            Mitra memberikan sertifikasi profesional pada
                                                            peserta pelatihan.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-advertising rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_online_ad_re_ol62.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Workshop Bersama</h5>
                                                        <p class="mb-0">
                                                            Pelatihan kolaboratif antara UINSU dan mitra
                                                            strategis.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-advertising rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_working-together_r43a.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sosial & Keagamaan -->
                            <div class="tab-pane fade" id="sosial-tab-pane" role="tabpanel"
                                aria-labelledby="sosial-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Bakti Sosial</h5>
                                                        <p class="mb-0">
                                                            Kegiatan pengabdian masyarakat bersama mitra dan
                                                            mahasiswa.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-music rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_Podcast_audience_re_4i5q.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Event Keagamaan</h5>
                                                        <p class="mb-0">
                                                            Kerja sama dalam penyelenggaraan ceramah,
                                                            tabligh akbar, dll.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-music rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_workspace_s6wf.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                                        <div class="custom-block bg-white shadow-lg">
                                            <a href="#">
                                                <div class="d-flex">
                                                    <div>
                                                        <h5 class="mb-2">Kegiatan Dakwah</h5>
                                                        <p class="mb-0">
                                                            Misi dakwah dan penyuluhan keagamaan ke
                                                            masyarakat luas.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-music rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_viral_tweet_gndb.png"
                                                    class="custom-block-image img-fluid" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="timeline-section section-padding" id="section_3">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="text-white mb-4">Alur Pengajuan Kerja Sama</h2>
                    </div>

                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="timeline-container">
                            <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                <div class="list-progress">
                                    <div class="inner"></div>
                                </div>

                                <li>
                                    <h4 class="text-white mb-3">Isi Formulir Pengajuan MOU</h4>
                                    <p class="text-white">
                                        Lembaga atau instansi mengisi formulir pengajuan kerja
                                        sama secara online dengan melampirkan dokumen pendukung
                                        seperti proposal, profil lembaga, dan draft MOU/MOA.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-journal-text"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">
                                        Verifikasi Dokumen oleh UINSU
                                    </h4>
                                    <p class="text-white">
                                        Tim dari Pusat Kerja Sama dan Hubungan Luar Negeri UINSU
                                        akan memverifikasi kelengkapan dan kesesuaian dokumen yang
                                        diajukan oleh mitra.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-file-earmark-check"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">
                                        Koordinasi dan Penandatanganan MOU
                                    </h4>
                                    <p class="text-white">
                                        Setelah dokumen disetujui, pihak UINSU dan mitra akan
                                        melakukan koordinasi lebih lanjut hingga ke tahap
                                        penandatanganan MOU/MOA sesuai kesepakatan bersama.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-pencil-square"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <p class="text-white">
                            Ingin mengajukan kerja sama?
                            <a href="{{ route('mou-submission') }}" class="btn custom-btn custom-border-btn ms-3">Isi
                                Formulir MOU</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

         <section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h3 class="mb-4">Kerja Sama yang Sedang Berlangsung</h3>
                    </div>

                    <div id="submissionCards" class="col-lg-12 col-12 mt-3 mx-auto">
                        <!-- Kartu akan diisi lewat jQuery -->
                    </div>

                    <div class="col-lg-12 col-12">
                        <nav>
                            <ul id="pagination" class="pagination justify-content-center mb-0"></ul>
                        </nav>
                    </div>
                </div>

            </div>
        </section>

        <section class="faq-section section-padding" id="section_4">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12">
                        <h2 class="mb-4">Syarat & Ketentuan</h2>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-lg-5 col-12">
                        <img src="img/faq_graphic.jpg" class="img-fluid" alt="FAQs">
                    </div>

                    <div class="col-lg-6 col-12 m-auto">
                        <div class="accordion" id="accordionExample">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Syarat dan Ketentuan Pengajuan
                                    </button>
                                </h2>

                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>
                                                <strong>Data dan Dokumen:</strong>
                                                Semua data dan dokumen yang diunggah harus benar, valid, dan dapat
                                                dipertanggungjawabkan. Pemalsuan data dapat menyebabkan penolakan
                                                pengajuan.
                                            </li>
                                            <li>
                                                <strong>Kelengkapan Dokumen:</strong>
                                                Pastikan seluruh dokumen pendukung (Surat Permohonan, Proposal, Profil
                                                Lembaga, Draft MOU/MOA, Akta Pendirian, NIB/TDP/SIUP, Izin Operasional)
                                                telah diunggah sesuai format yang diminta.
                                            </li>
                                            <li>
                                                <strong>Proses Verifikasi:</strong>
                                                Pengajuan akan diverifikasi oleh tim terkait. Proses verifikasi dapat
                                                memerlukan waktu sesuai kelengkapan dan validitas dokumen.
                                            </li>
                                            <li>
                                                <strong>Komunikasi:</strong>
                                                Pemohon wajib memastikan kontak yang dicantumkan aktif untuk keperluan
                                                komunikasi selama proses pengajuan.
                                            </li>
                                            <li>
                                                <strong>Persetujuan:</strong>
                                                Dengan mengajukan formulir, pemohon menyetujui bahwa data yang diberikan
                                                dapat digunakan untuk keperluan administrasi dan komunikasi terkait
                                                kerja sama.
                                            </li>
                                            <li>
                                                <strong>Penolakan atau Pembatalan:</strong>
                                                Pengajuan dapat ditolak atau dibatalkan jika ditemukan pelanggaran
                                                terhadap syarat dan ketentuan ini.
                                            </li>
                                            <li>
                                                <strong>Perubahan Syarat:</strong>
                                                Pihak kampus berhak mengubah syarat dan ketentuan sewaktu-waktu tanpa
                                                pemberitahuan terlebih dahulu.
                                            </li>
                                        </ol>
                                        <p class="mt-4">
                                            Jika ada pertanyaan lebih lanjut, silakan hubungi
                                            <a href="mailto:humas@uinsu.ac.id">humas@uinsu.ac.id</a>.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian bawah tetap bisa Anda tambahkan untuk FAQ lain jika diinginkan -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Pertanyaan Umum (FAQ)
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Jika Anda mengalami kendala teknis saat mengisi formulir atau mengunggah
                                        dokumen, silakan refresh halaman atau hubungi admin teknis.
                                    </div>
                                </div>
                            </div>

                        </div>
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
                        <a href="tel:0616615683" class="site-footer-link">(061) 6615683 – 6622925</a>
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
    <script>
        $(document).ready(function() {
            const submissions = {!! json_encode($submissions) !!};
            console.log(submissions);
            const perPage = 5;
            let currentPage = 1;
            const typeImages = {
                'SMK': 'undraw_Educator_re_ju47.png',
                'SMA': 'undraw_Finance_re_gnv2.png',
                'Perguruan Tinggi': 'undraw_professor_d7zn.png',
                'Vendor': 'undraw_work-chat_hc3y.png',
                'Brand': 'undraw_scrum-board_uqku.png',
                'Pemerintah': 'undraw_working-remotely_ivtz.png',
                'Lainnya': 'undraw_working-together_r43a.png'
            };

           function renderCards(page = 1) {
    const start = (page - 1) * perPage;
    const end = start + perPage;
    const sliced = submissions.slice(start, end);

    let html = '';
    sliced.forEach((item, index) => {
        // ambil gambar sesuai tipe institusi
        const imgFile = typeImages[item.institution_type] || typeImages['Lainnya'];
        const imgSrc = `img/topics/${imgFile}`;

        // tombol dokumen & galeri
        let fileButton = '';

        if (item.final_agreement_file) {
            fileButton += `
                <div class="col-12 col-md-auto">
                    <a href="/storage/${item.final_agreement_file}" target="_blank" class="btn custom-btn w-100" style="background-color: #5eabd6 !important;">
                        <i class="bi bi-file-earmark-text me-1"></i> Lihat Perjanjian
                    </a>
                </div>
            `;
        } else if (item.final_mou_file) {
            fileButton += `
                <div class="col-12 col-md-auto">
                    <a href="/storage/${item.final_mou_file}" target="_blank" class="btn custom-btn w-100">
                        <i class="bi bi-file-earmark-text me-1"></i> Lihat MOU
                    </a>
                </div>
            `;
        }

        if (item.gallery_available) {
            fileButton += `
                <div class="col-12 col-md-auto">
                    <a href="/gallery/${item.id}" class="btn custom-btn w-100" style="background-color: #254d70 !important;">
                        <i class="bi bi-images me-1"></i> Lihat Galeri
                    </a>
                </div>
            `;
        }

        html += `
            <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
                <div class="d-flex">
                    <img src="${imgSrc}" class="custom-block-image img-fluid" alt="${item.institution_type}">

                    <div class="custom-block-topics-listing-info d-flex w-100">
                        <div>
                            <h5 class="mb-2">${item.institution_name}</h5>
                            <p class="mb-0"><strong>${item.cooperation_title}</strong> - ${item.institution_type}</p>
                            <p class="mb-0">${item.cooperation_description}</p>

                            <div class="row g-2 mt-3">
                                <div class="col-12 col-md-auto">
                                    <a href="#" class="btn custom-btn w-100">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        ${formatDate(item.start_date)} - ${formatDate(item.end_date)}
                                    </a>
                                </div>
                                ${fileButton}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    $('#submissionCards').html(html);
}


            function renderPagination() {
                const totalPages = Math.ceil(submissions.length / perPage);
                let paginationHtml = '';

                // Prev Button
                paginationHtml += `
    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
      <a class="page-link" href="#" data-page="${currentPage - 1}" aria-label="Previous">
        <span aria-hidden="true">&laquo; Prev</span>
      </a>
    </li>
  `;

                // Page Numbers
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml += `
      <li class="page-item ${i === currentPage ? 'active' : ''}">
        <a class="page-link" href="#" data-page="${i}">${i}</a>
      </li>
    `;
                }

                // Next Button
                paginationHtml += `
    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
      <a class="page-link" href="#" data-page="${currentPage + 1}" aria-label="Next">
        <span aria-hidden="true">Next &raquo;</span>
      </a>
    </li>
  `;

                $('#pagination').html(paginationHtml);

                // Page click event
                $('#pagination .page-link').on('click', function(e) {
                    e.preventDefault();
                    const selectedPage = parseInt($(this).data('page'));
                    if (!isNaN(selectedPage) && selectedPage >= 1 && selectedPage <= totalPages) {
                        currentPage = selectedPage;
                        renderCards(currentPage);
                        renderPagination();
                    }
                });
            }


            function formatDate(dateString) {
                const options = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }

            renderCards();
            renderPagination();
        });
    </script>

</body>

</html>
