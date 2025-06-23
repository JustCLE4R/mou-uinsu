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
                            <a class="nav-link click-scroll" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('mou-submission-store') }}">Pengajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="/login">Login</a>
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
                        <h1 class="text-white text-center">
                            UINSU Medan Membuka Peluang Kerja Sama (MOU)
                        </h1>

                        <h6 class="text-center">
                            Kami mengundang lembaga, instansi, sekolah, industri, dan mitra
                            strategis lainnya untuk membangun kolaborasi yang berdampak.
                        </h6>

                        <form method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bi-search" id="basic-addon1"></span>

                                <input name="keyword" type="search" class="form-control" id="keyword"
                                    placeholder="Cari informasi kerja sama, bidang, mitra..." aria-label="Search" />

                                <button type="submit" class="form-control">Cari</button>
                            </div>
                        </form>
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
                                            <a href="#" class="social-icon-link bi-linkedin"></a>
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
                                                        <h5 class="mb-2">Pelatihan Mahasiswa</h5>
                                                        <p class="mb-0">
                                                            Workshop & pelatihan keterampilan untuk
                                                            mahasiswa.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-design rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_Graduation_re_gthn.png"
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
                                                <img src="img/topics/undraw_Finance_re_gnv2.png"
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
                                                <img src="img/topics/undraw_Finance_re_gnv2.png"
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
                                                <img src="img/topics/undraw_Finance_re_gnv2.png"
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
                                                <img src="img/topics/colleagues-working-cozy-office-medium-shot.png"
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
                                                <img src="img/topics/colleagues-working-cozy-office-medium-shot.png"
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
                                                <img src="img/topics/undraw_online_ad_re_ol62.png"
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
                                                        <h5 class="mb-2">Kegiatan Dakwah</h5>
                                                        <p class="mb-0">
                                                            Misi dakwah dan penyuluhan keagamaan ke
                                                            masyarakat luas.
                                                        </p>
                                                    </div>
                                                    <span class="badge bg-music rounded-pill ms-auto">✅</span>
                                                </div>
                                                <img src="img/topics/undraw_Podcast_audience_re_4i5q.png"
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
                        <a href="mailto:kerjasama@uinsu.ac.id" class="site-footer-link">kerjasama@uinsu.ac.id</a>
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
