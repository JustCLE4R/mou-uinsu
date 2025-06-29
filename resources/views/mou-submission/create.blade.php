<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Pengajuan</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <link href="css/bootstrap2.min.css" rel="stylesheet" />

    <link href="css/bootstrap-icons.css" rel="stylesheet" />

    <link href="css/templatemo-topic-listing.css" rel="stylesheet" />
    <link href="css/form.css" rel="stylesheet" />

</head>

<body class="topics-listing-page" id="top">
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
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
                        <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                    </div>
                </div>
            </div>
        </nav>

        <header class="site-header d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Beranda</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    Pengajuan MOU
                                </li>
                            </ol>
                        </nav>

                        <h2 class="text-white">Pengajuan MOU</h2>

                    </div>
                    <div class="col-lg-12">
                        <div class="containers">
                            {{-- pritn all errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h5>Form Pengajuan MOU</h5>

                            <form method="POST" action="{{ route('mou-submission-store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- STEP 1 -->
                                <div class="form first">
                                    <h6 class="mt-4">Informasi Mitra</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="institution_name" class="form-label">Nama
                                                Lembaga/Instansi</label>
                                            <input type="text"
                                                class="form-control @error('institution_name') is-invalid @enderror"
                                                id="institution_name" name="institution_name"
                                                value="{{ old('institution_name') }}" required>
                                            @error('institution_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="institution_type" class="form-label">Jenis Institusi</label>
                                            <select class="form-select @error('institution_type') is-invalid @enderror"
                                                id="institution_type" name="institution_type" required>
                                                <option selected disabled>Pilih jenis institusi...</option>
                                                @foreach (['SMK', 'SMA', 'Perguruan Tinggi', 'Vendor', 'Brand', 'Pemerintah', 'Lainnya'] as $type)
                                                    <option value="{{ $type }}"
                                                        {{ old('institution_type') == $type ? 'selected' : '' }}>
                                                        {{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @error('institution_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="institution_address" class="form-label">Alamat Lengkap</label>
                                            <textarea class="form-control @error('institution_address') is-invalid @enderror" id="institution_address"
                                                name="institution_address" rows="2" required>{{ old('institution_address') }}</textarea>
                                            @error('institution_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="institution_website" class="form-label">Website
                                                (Opsional)</label>
                                            <input type="url"
                                                class="form-control @error('institution_website') is-invalid @enderror"
                                                id="institution_website" name="institution_website"
                                                value="{{ old('institution_website') }}">
                                            @error('institution_website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <h6 class="mt-4">Kontak Penanggung Jawab</h6>
                                    <div class="row">
                                        @foreach ([['pic_name', 'Nama PIC'], ['pic_position', 'Jabatan'], ['pic_phone', 'No. Telepon / HP'], ['pic_email', 'Email']] as [$field, $label])
                                            <div class="col-md-6 mb-3">
                                                <label for="{{ $field }}"
                                                    class="form-label">{{ $label }}</label>
                                                <input type="{{ $field == 'pic_email' ? 'email' : 'text' }}"
                                                    class="form-control @error($field) is-invalid @enderror"
                                                    id="{{ $field }}" name="{{ $field }}"
                                                    value="{{ old($field) }}" required>
                                                @error($field)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>

                                    <h6 class="mt-4">Dokumen Pendukung</h6>
                                    <div class="row">
                                        @php
                                            $documents = [
                                                'letter_file' => 'Surat Permohonan',
                                                'proposal_file' => 'Proposal Kerja Sama',
                                                'profile_file' => 'Profil Lembaga',
                                                'draft_mou_file' => 'Draft MOU/MOA',
                                                'legal_doc_akta' => 'Akta Pendirian',
                                                'legal_doc_nib' => 'NIB / TDP / SIUP',
                                                'legal_doc_operasional' => 'Izin Operasional',
                                            ];
                                        @endphp
                                        @foreach ($documents as $name => $label)
                                            <div
                                                class="col-md-{{ in_array($name, ['legal_doc_akta', 'legal_doc_nib', 'legal_doc_operasional']) ? '4' : '6' }} mb-3">
                                                <label class="form-label">{{ $label }}</label>
                                                <input type="file"
                                                    class="form-control @error($name) is-invalid @enderror"
                                                    name="{{ $name }}" accept=".pdf,.doc,.docx">
                                                @error($name)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" class="btn btn-primary nextBtn">
                                            Selanjutnya <i class="bi bi-chevron-right ms-1"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- STEP 2 -->
                                <div class="form second">
                                    <h6 class="mt-4">Detail Pengajuan MOU</h6>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="cooperation_title" class="form-label">Judul Kerja Sama</label>
                                            <input type="text"
                                                class="form-control @error('cooperation_title') is-invalid @enderror"
                                                id="cooperation_title" name="cooperation_title"
                                                value="{{ old('cooperation_title') }}" required>
                                            @error('cooperation_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="cooperation_description" class="form-label">Deskripsi
                                                Tujuan</label>
                                            <textarea class="form-control @error('cooperation_description') is-invalid @enderror" id="cooperation_description"
                                                name="cooperation_description" rows="2" required>{{ old('cooperation_description') }}</textarea>
                                            @error('cooperation_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Ruang Lingkup</label>
                                            <div>
                                                @foreach (['Pendidikan', 'Penelitian', 'Magang', 'Sponsor'] as $scope)
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('cooperation_scope') is-invalid @enderror"
                                                            type="checkbox" name="cooperation_scope[]"
                                                            value="{{ $scope }}"
                                                            id="scope_{{ $loop->index }}"
                                                            {{ is_array(old('cooperation_scope')) && in_array($scope, old('cooperation_scope')) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="scope_{{ $loop->index }}">{{ $scope }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('cooperation_scope')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="planned_activities" class="form-label">Rencana
                                                Kegiatan</label>
                                            <textarea class="form-control @error('planned_activities') is-invalid @enderror" id="planned_activities"
                                                name="planned_activities" rows="2" required>{{ old('planned_activities') }}</textarea>
                                            @error('planned_activities')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="target_unit" class="form-label">Unit Tujuan di Kampus</label>
                                            <input type="text"
                                                class="form-control @error('target_unit') is-invalid @enderror"
                                                id="target_unit" name="target_unit" value="{{ old('target_unit') }}"
                                                required>
                                            @error('target_unit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                                            <input type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                id="start_date" name="start_date" value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                                            <input type="date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                id="end_date" name="end_date" value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <h6 class="mt-4">Informasi Tambahan</h6>
                                    <div class="row">
                                        @foreach ([['signing_location', 'Lokasi Penandatanganan'], ['special_request', 'Permintaan Khusus'], ['additional_notes', 'Catatan Tambahan']] as [$field, $label])
                                            <div class="col-md-12 mb-3">
                                                <label for="{{ $field }}"
                                                    class="form-label">{{ $label }}</label>
                                                <textarea class="form-control @error($field) is-invalid @enderror" id="{{ $field }}"
                                                    name="{{ $field }}" rows="2">{{ old($field) }}</textarea>
                                                @error($field)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>


                                    <div class="form-check mb-4">
                                        <input class="form-check-input @error('agree') is-invalid @enderror"
                                            type="checkbox" value="1" id="agree" name="agree"
                                            {{ old('agree') ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="agree">
                                            Saya menyetujui semua <a href="{{ route('snk') }}"
                                                target="_blank">syarat dan ketentuan</a> pengajuan kerja sama ini.
                                        </label>
                                        @error('agree')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between w-ful">
                                        <button type="button" class="btn btn-secondary backBtn">
                                            <i class="bi bi-chevron-right"></i> Kembali
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-send-check"></i> Ajukan MOU
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </header>


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
    <script src="js/custom.js"></script>
</body>

</html>
