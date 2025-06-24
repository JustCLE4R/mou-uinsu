@extends('layouts.main')

@section('content')
    <section class="section-padding py-5" style="margin-top: 10vh;">
        <div class="container">

            <div class="section-header text-center mb-5">
                <h2 class="section-title">Preview Pengajuan MOU</h2>
                <div class="shape mx-auto" style="width: 60px; height: 4px; background: #0d6efd; border-radius: 2px;"></div>
            </div>

            <div class="row justify-content-center">

                <div class="col-lg-10">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3 mb-md-0">
                        <a href="/superadmin/mou" class="text-primary wow fadeInRight" ata-wow-delay="0.3s"><i
                                class="bi bi-chevron-double-left"></i> Kembali</a>
                    </div>

                    <div class="card shadow overflow-hidden" style="  background-color: #ffffff !important;;">

                        <div
                            class="card-header text-dark  d-flex flex-wrap justify-content-between align-items-center py-3">
                            <h4 style="font-size: 1.5rem" class="mb-0">Detail Pengajuan</h4>
                            <button type="button" class="btn btn-warning text-light btn-sm mt-2 mt-md-0"
                                data-bs-toggle="modal" data-bs-target="#ubahStatusModal">
                                <i class="bi bi-pencil-square me-1"></i> Ubah Status
                            </button>
                        </div>

                        <div class="card-body bg-light">
                            <!-- Informasi Mitra -->
                            <h5 class="fw-semibold">Informasi Mitra</h5>
                            <div class="row mb-3 g-3">
                                <div class="col-md-6"><strong>Nama Lembaga:</strong> {{ $submission->institution_name }}
                                </div>
                                <div class="col-md-6"><strong>Jenis Institusi:</strong> {{ $submission->institution_type }}
                                </div>
                                <div class="col-md-12"><strong>Alamat:</strong> {{ $submission->institution_address }}</div>
                                <div class="col-md-6"><strong>Website:</strong> <a
                                        href="{{ $submission->institution_website }}"
                                        target="_blank">{{ $submission->institution_website ?? '-' }}</a></div>
                            </div>

                            <!-- Kontak PIC -->
                            <hr>
                            <h5 class="fw-semibold">Kontak Penanggung Jawab</h5>
                            <div class="row mb-3 g-3">
                                <div class="col-md-6"><strong>Nama PIC:</strong> {{ $submission->pic_name }}</div>
                                <div class="col-md-6"><strong>Jabatan:</strong> {{ $submission->pic_position }}</div>
                                <div class="col-md-6"><strong>No. Telepon:</strong> {{ $submission->pic_phone }}</div>
                                <div class="col-md-6"><strong>Email:</strong> {{ $submission->pic_email }}</div>
                            </div>

                            <!-- Dokumen Pendukung -->
                            <hr>
                            <h5 class="fw-semibold">Dokumen Pendukung</h5>
                            <div class="row g-3">
                                @php
                                    $docs = [
                                        ['label' => 'Surat Permohonan', 'file' => $submission->letter_file],
                                        ['label' => 'Proposal', 'file' => $submission->proposal_file],
                                        ['label' => 'Profil Lembaga', 'file' => $submission->profile_file],
                                        ['label' => 'Draft MOU', 'file' => $submission->draft_mou_file],
                                        ['label' => 'Akta Pendirian', 'file' => $submission->legal_doc_akta],
                                        ['label' => 'NIB/TDP/SIUP', 'file' => $submission->legal_doc_nib],
                                        ['label' => 'Izin Operasional', 'file' => $submission->legal_doc_operasional],
                                    ];
                                @endphp
                                @foreach ($docs as $doc)
                                    <div class="col-sm-6 col-md-4 my-2">
                                        <div class="card border-0 shadow h-100"
                                            style="
                                                  background-color: #ffffff !important;
                                                  transition: transform 0.3s ease, box-shadow 0.3s ease;
                                                  border-radius: 12px;
                                                  cursor: pointer;
                                                "
                                            onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.1)'"
                                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.05)'">
                                            <div class="card-body text-center">
                                                <div class="mb-2">
                                                    <i class="bi bi-file-earmark-pdf"
                                                        style="font-size:2rem; color:#d9534f;"></i>
                                                </div>
                                                <h6 class="fw-bold">{{ $doc['label'] }}</h6>
                                                @if ($doc['file'])
                                                    <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank"
                                                        class="btn btn-primary rounded btn-sm w-100 mb-1">
                                                        <i class="bi bi-eye"></i> Lihat
                                                    </a>
                                                    <a href="{{ asset('storage/' . $doc['file']) }}" download
                                                        class="btn btn-success rounded btn-sm w-100">
                                                        <i class="bi bi-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-secondary">Tidak Disertakan</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <!-- Informasi Kerja Sama -->
                            <hr>
                            <h5 class="fw-semibold">Detail Kerja Sama</h5>
                            <div class="row mb-3 g-3">
                                <div class="col-md-6"><strong>Judul:</strong> {{ $submission->cooperation_title }}</div>
                                <div class="col-md-6"><strong>Unit Tujuan:</strong> {{ $submission->target_unit }}</div>
                                <div class="col-md-12"><strong>Deskripsi:</strong>
                                    {{ $submission->cooperation_description }}</div>
                                <div class="col-md-12"><strong>Ruang Lingkup:</strong>
                                    @php $scopes = json_decode($submission->cooperation_scope, true) ?? []; @endphp
                                    @foreach ($scopes as $scope)
                                        <span class="badge bg-info text-light me-1">{{ $scope }}</span>
                                    @endforeach
                                </div>
                                <div class="col-md-12"><strong>Rencana Kegiatan:</strong>
                                    {{ $submission->planned_activities }}</div>
                                <div class="col-md-3"><strong>Tanggal Mulai:</strong> {{ $submission->start_date }}</div>
                                <div class="col-md-3"><strong>Tanggal Selesai:</strong> {{ $submission->end_date }}</div>
                            </div>

                            <!-- Informasi Tambahan -->
                            <hr>
                            <h5 class="fw-semibold">Informasi Tambahan</h5>
                            <div class="row mb-3 g-3">
                                <div class="col-md-6"><strong>Lokasi TTD:</strong> {{ $submission->signing_location }}
                                </div>
                                <div class="col-md-6"><strong>Permintaan Khusus:</strong>
                                    {{ $submission->special_request }}</div>
                                <div class="col-md-12"><strong>Catatan Tambahan:</strong>
                                    {{ $submission->additional_notes }}</div>
                            </div>

                            <!-- Status Pengajuan -->
                            <hr>
                            <h5 class="fw-semibold">Status Pengajuan</h5>
                            <div class="row mb-3 g-3">
                                <div class="col-md-4">
                                    <strong>Status:</strong>
                                    <span
                                        class="badge  text-light
                  @if ($submission->status == 'pending') bg-warning
                  @elseif($submission->status == 'review') bg-info
                  @elseif($submission->status == 'approved') bg-success
                  @elseif($submission->status == 'rejected') bg-danger @endif
                ">{{ ucfirst($submission->status) }}</span>
                                </div>
                                <div class="col-md-4"><strong>Pesan Status:</strong>
                                    {{ $submission->status_message ?? '-' }}</div>
                                <div class="col-md-4"><strong>Ref:</strong> {{ $submission->reference_number }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Ubah Status -->
                    <div class="modal fade" id="ubahStatusModal" tabindex="-1" aria-labelledby="ubahStatusModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="{{ route('superadmin.mou.update', $submission->id) }}" method="POST"
                                class="modal-content  shadow-sm border-0">
                                @csrf
                                @method('PATCH')

                                <div class="modal-header bg-light border-bottom-0  px-4 pt-4">
                                    <h5 class="modal-title fw-semibold text-dark" id="ubahStatusModalLabel">
                                        <i class="bi bi-pencil-square me-2 text-primary"></i> Ubah Status Pengajuan
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>

                                <div class="modal-body px-4">
                                    <div class="mb-3">
                                        <label for="status" class="form-label fw-medium">Status</label>
                                        <select name="status" id="status" class="  form-select-lg mb-3" required>
                                            <option value="pending"
                                                {{ $submission->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="review"
                                                {{ $submission->status == 'review' ? 'selected' : '' }}>
                                                Review</option>
                                            <option value="approved"
                                                {{ $submission->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected"
                                                {{ $submission->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status_message" class="form-label fw-medium">Pesan Status</label>
                                        <input type="text" name="status_message" id="status_message"
                                            class="form-control" placeholder="Tulis catatan atau alasan perubahan..."
                                            value="{{ $submission->status_message }}">
                                    </div>
                                </div>

                                <div class="modal-footer bg-light border-top-0 px-4 pb-4">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-arrow-left-circle me-1"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
@endpush
