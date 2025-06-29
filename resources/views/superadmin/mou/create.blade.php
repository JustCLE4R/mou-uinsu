@extends('layouts.main')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <link href="/css/bootstrap2.min.css" rel="stylesheet" />

    <link href="/css/bootstrap-icons.css" rel="stylesheet" />

    <link href="/css/form.css" rel="stylesheet" />

    <div class="col-lg-12">
        <div class="containers" style="height: 1302px !important;">
            <h5>Form Pengajuan MOU</h5>

            <form method="POST" action="{{ route('superadmin.mou.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- STEP 1 -->
                <div class="form first">
                    <h6 class="mt-4">Informasi Mitra</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="institution_name" class="form-label">Nama
                                Lembaga/Instansi</label>
                            <input type="text" class="form-control @error('institution_name') is-invalid @enderror"
                                id="institution_name" name="institution_name" value="{{ old('institution_name') }}"
                                required>
                            @error('institution_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="institution_type" class="form-label">Jenis Institusi</label>
                            <select class="form-select @error('institution_type') is-invalid @enderror"
                                id="institution_type" name="institution_type" required>
                                <option value="" selected disabled>Pilih jenis institusi...</option>
                                @foreach (['SMK', 'SMA', 'Perguruan Tinggi', 'Vendor', 'Brand', 'Pemerintah', 'Lainnya'] as $type)
                                    <option value="{{ $type }}"
                                        {{ old('institution_type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
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
                            <input type="url" class="form-control @error('institution_website') is-invalid @enderror"
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
                                <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                <input type="{{ $field == 'pic_email' ? 'email' : 'text' }}"
                                    class="form-control @error($field) is-invalid @enderror" id="{{ $field }}"
                                    name="{{ $field }}" value="{{ old($field) }}" required>
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
                                <input type="file" class="form-control @error($name) is-invalid @enderror"
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
                            <input type="text" class="form-control @error('cooperation_title') is-invalid @enderror"
                                id="cooperation_title" name="cooperation_title" value="{{ old('cooperation_title') }}"
                                required>
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
                                            type="checkbox" name="cooperation_scope[]" value="{{ $scope }}"
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
                            <input type="text" class="form-control @error('target_unit') is-invalid @enderror"
                                id="target_unit" name="target_unit" value="{{ old('target_unit') }}" required>
                            @error('target_unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date" value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
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
                                <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                <textarea class="form-control @error($field) is-invalid @enderror" id="{{ $field }}"
                                    name="{{ $field }}" rows="2">{{ old($field) }}</textarea>
                                @error($field)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>


                    <div class="form-check mb-4">
                        <input class="form-check-input @error('agree') is-invalid @enderror" type="checkbox"
                            value="1" id="agree" name="agree" {{ old('agree') ? 'checked' : '' }} required>
                        <label class="form-check-label" for="agree">
                            Saya menyetujui semua <a href="{{ route('snk') }}" target="_blank">syarat dan ketentuan</a>
                            pengajuan kerja sama ini.
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
    <!-- JAVASCRIPT FILES -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery.sticky.js"></script>
    <script src="/js/custom.js"></script>
@endsection
