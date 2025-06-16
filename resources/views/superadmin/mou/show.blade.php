@extends('layouts.main')

@section('content')
<section class="section-padding" style="margin-top: 12vh;">
  <div class="section-header text-center">
    <h2 class="section-title">Preview Pengajuan MOU</h2>
    <div class="shape"></div>
  </div>
  <div class="row justify-content-center p-3">
    <div class="col-lg-10">
      <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
          <h4 class="mb-0">Detail Pengajuan</h4>
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahStatusModal">
            <i class="bi bi-pencil-square"></i> Ubah Status
          </button>
        </div>
        <div class="card-body bg-light text-dark">
          <!-- Informasi Mitra -->
          <h5>Informasi Mitra</h5>
          <div class="row mb-2">
            <div class="col-md-6"><b>Nama Lembaga:</b> {{ $submission->institution_name }}</div>
            <div class="col-md-6"><b>Jenis Institusi:</b> {{ $submission->institution_type }}</div>
            <div class="col-md-12"><b>Alamat:</b> {{ $submission->institution_address }}</div>
            <div class="col-md-6"><b>Website:</b><a href="{{ $submission->institution_website }}" target="_blank"> {{ $submission->institution_website ?? '-' }}</a></div>
          </div>
          <!-- Kontak PIC -->
          <hr>
          <h5 class="mt-3">Kontak Penanggung Jawab</h5>
          <div class="row mb-2">
            <div class="col-md-6"><b>Nama PIC:</b> {{ $submission->pic_name }}</div>
            <div class="col-md-6"><b>Jabatan:</b> {{ $submission->pic_position }}</div>
            <div class="col-md-6"><b>No. Telepon:</b> {{ $submission->pic_phone }}</div>
            <div class="col-md-6"><b>Email:</b> {{ $submission->pic_email }}</div>
          </div>
          <!-- Dokumen -->
          <hr>
          <h5 class="mt-3">Dokumen Pendukung</h5>
          <div class="row mb-3 g-3">
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
            @foreach($docs as $doc)
              <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body text-center">
                    <div class="mb-2">
                      <i class="bi bi-file-earmark-pdf" style="font-size:2rem;color:#d9534f"></i>
                    </div>
                    <div class="fw-bold mb-2">{{ $doc['label'] }}</div>
                    @if($doc['file'])
                      <a href="{{ asset('storage/'.$doc['file']) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100 mb-1">
                        <i class="bi bi-eye"></i> Lihat Dokumen
                      </a>
                      <a href="{{ asset('storage/'.$doc['file']) }}" download class="btn btn-outline-success btn-sm w-100">
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
          <h5 class="mt-3">Detail Kerja Sama</h5>
          <div class="row mb-2">
            <div class="col-md-6"><b>Judul:</b> {{ $submission->cooperation_title }}</div>
            <div class="col-md-6"><b>Unit Tujuan:</b> {{ $submission->target_unit }}</div>
            <div class="col-md-12"><b>Deskripsi:</b> {{ $submission->cooperation_description }}</div>
            <div class="col-md-12"><b>Ruang Lingkup:</b>
              @foreach($submission->cooperation_scope as $scope)
                <span class="badge bg-info text-dark">{{ $scope }}</span>
              @endforeach
            </div>
            <div class="col-md-12"><b>Rencana Kegiatan:</b> {{ $submission->planned_activities }}</div>
            <div class="col-md-3"><b>Tanggal Mulai:</b> {{ $submission->start_date }}</div>
            <div class="col-md-3"><b>Tanggal Selesai:</b> {{ $submission->end_date }}</div>
          </div>
          <!-- Informasi Tambahan -->
          <hr>
          <h5 class="mt-3">Informasi Tambahan</h5>
          <div class="row mb-2">
            <div class="col-md-6"><b>Lokasi TTD:</b> {{ $submission->signing_location }}</div>
            <div class="col-md-6"><b>Permintaan Khusus:</b> {{ $submission->special_request }}</div>
            <div class="col-md-12"><b>Catatan Tambahan:</b> {{ $submission->additional_notes }}</div>
          </div>
          <!-- Status -->
          <hr>
          <h5 class="mt-3">Status Pengajuan</h5>
          <div class="row mb-2">
            <div class="col-md-4"><b>Status:</b> 
              <span class="badge 
                @if($submission->status == 'pending') bg-warning 
                @elseif($submission->status == 'review') bg-info 
                @elseif($submission->status == 'approved') bg-success 
                @elseif($submission->status == 'rejected') bg-danger 
                @endif
              ">{{ ucfirst($submission->status) }}</span>
            </div>
            <div class="col-md-4"><b>Pesan Status:</b> {{ $submission->status_message ?? '-' }}</div>
            <div class="col-md-4"><b>Ref:</b> {{ $submission->reference_number }}</div>
          </div>
        </div>
      </div>
      
      <!-- Modal Ubah Status -->
      <div class="modal fade" id="ubahStatusModal" tabindex="-1" aria-labelledby="ubahStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{ route('superadmin.mou.update', $submission->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PATCH')
            <div class="modal-header bg-secondary text-white">
              <h5 class="modal-title" id="ubahStatusModalLabel">Ubah Status Pengajuan</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                  <option value="pending" {{ $submission->status == 'pending' ? 'selected' : '' }}>Pending</option>
                  <option value="review" {{ $submission->status == 'review' ? 'selected' : '' }}>Review</option>
                  <option value="approved" {{ $submission->status == 'approved' ? 'selected' : '' }}>Approved</option>
                  <option value="rejected" {{ $submission->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="status_message" class="form-label">Pesan Status</label>
                <input type="text" name="status_message" id="status_message" class="form-control" value="{{ $submission->status_message }}">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Update Status</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
@endpush