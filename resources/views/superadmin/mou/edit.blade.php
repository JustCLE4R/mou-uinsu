@extends('layouts.main')

@section('content')
<section class="section-padding" style="margin-top: 9vh;">
  <div class="section-header text-center">
    <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">Edit MOU - {{ $submission->institution_name }}</h2>
    <div class="shape wow fadeInDown" data-wow-delay="0.3s"></div>
  </div>

  <div class="row justify-content-center mt-3 wow fadeInDown">
    <div class="col-6">
      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {!! session('success') !!}
      </div>
      @endif
      @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
      </div>
      @endif
    </div>
  </div>

  <div class="container border rounded shadow p-4" style="width:90%;">
    <a href="{{ route('superadmin.mou.index') }}" class="text-primary wow fadeInRight mb-5" data-wow-delay="0.3s">
      <i class="bi bi-chevron-double-left"></i> Kembali
    </a>

    <form action="{{ route('superadmin.mou.update', $submission->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      
      <!-- Final Documents Section -->
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Dokumen Final MOU</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="final_agreement_file" class="form-label">Final Agreement File</label>
              @if($submission->final_agreement_file)
                <div class="mb-2">
                  <a href="{{ asset('storage/'.$submission->final_agreement_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-eye"></i> Lihat File Saat Ini
                  </a>
                </div>
              @endif
              <input type="file" name="final_agreement_file" id="final_agreement_file" class="form-control @error('final_agreement_file') is-invalid @enderror" accept=".pdf,.doc,.docx">
              @error('final_agreement_file')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="final_mou_file" class="form-label">Final MOU File</label>
              @if($submission->final_mou_file)
                <div class="mb-2">
                  <a href="{{ asset('storage/'.$submission->final_mou_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-eye"></i> Lihat File Saat Ini
                  </a>
                </div>
              @endif
              <input type="file" name="final_mou_file" id="final_mou_file" class="form-control @error('final_mou_file') is-invalid @enderror" accept=".pdf,.doc,.docx">
              @error('final_mou_file')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>

      <!-- Informasi Mitra -->
      <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0">Informasi Mitra</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="institution_name" class="form-label">Nama Institusi <span class="text-danger">*</span></label>
              <input type="text" name="institution_name" id="institution_name" class="form-control @error('institution_name') is-invalid @enderror" value="{{ old('institution_name', $submission->institution_name) }}" required>
              @error('institution_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="institution_type" class="form-label">Tipe Institusi <span class="text-danger">*</span></label>
              <select name="institution_type" id="institution_type" class="form-select @error('institution_type') is-invalid @enderror" required>
                <option value="">Pilih Tipe</option>
                @foreach(['SMK', 'SMA', 'Perguruan Tinggi', 'Vendor', 'Brand', 'Pemerintah', 'Lainnya'] as $type)
                  <option value="{{ $type }}" {{ old('institution_type', $submission->institution_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
              </select>
              @error('institution_type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <label for="institution_address" class="form-label">Alamat Institusi <span class="text-danger">*</span></label>
              <textarea name="institution_address" id="institution_address" class="form-control @error('institution_address') is-invalid @enderror" rows="3" required>{{ old('institution_address', $submission->institution_address) }}</textarea>
              @error('institution_address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="institution_website" class="form-label">Website Institusi</label>
              <input type="url" name="institution_website" id="institution_website" class="form-control @error('institution_website') is-invalid @enderror" value="{{ old('institution_website', $submission->institution_website) }}">
              @error('institution_website')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>

      <!-- Kontak PIC -->
      <div class="card mb-4">
        <div class="card-header bg-info text-white">
          <h5 class="mb-0">Kontak Penanggung Jawab</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="pic_name" class="form-label">Nama PIC <span class="text-danger">*</span></label>
              <input type="text" name="pic_name" id="pic_name" class="form-control @error('pic_name') is-invalid @enderror" value="{{ old('pic_name', $submission->pic_name) }}" required>
              @error('pic_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="pic_position" class="form-label">Jabatan PIC <span class="text-danger">*</span></label>
              <input type="text" name="pic_position" id="pic_position" class="form-control @error('pic_position') is-invalid @enderror" value="{{ old('pic_position', $submission->pic_position) }}" required>
              @error('pic_position')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="pic_phone" class="form-label">No. Telepon PIC <span class="text-danger">*</span></label>
              <input type="text" name="pic_phone" id="pic_phone" class="form-control @error('pic_phone') is-invalid @enderror" value="{{ old('pic_phone', $submission->pic_phone) }}" required>
              @error('pic_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="pic_email" class="form-label">Email PIC <span class="text-danger">*</span></label>
              <input type="email" name="pic_email" id="pic_email" class="form-control @error('pic_email') is-invalid @enderror" value="{{ old('pic_email', $submission->pic_email) }}" required>
              @error('pic_email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>

      <!-- Dokumen Pendukung -->
      <div class="card mb-4">
        <div class="card-header bg-dark text-white">
          <h5 class="mb-0">Dokumen Pendukung</h5>
        </div>
        <div class="card-body">
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
          <div class="row">
            @foreach($documents as $field => $label)
              <div class="col-md-6 mb-3">
                <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                @if($submission->$field)
                  <div class="mb-2">
                    <div class="d-flex align-items-center gap-2">
                      <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 1.2rem;"></i>
                      <a href="{{ asset('storage/'.$submission->$field) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> Lihat File
                      </a>
                      <a href="{{ asset('storage/'.$submission->$field) }}" download class="btn btn-sm btn-outline-success">
                        <i class="bi bi-download"></i> Download
                      </a>
                    </div>
                  </div>
                @else
                  <div class="mb-2">
                    <span class="badge bg-secondary">Tidak ada file</span>
                  </div>
                @endif
                <input type="file" name="{{ $field }}" id="{{ $field }}" class="form-control @error($field) is-invalid @enderror" accept=".pdf,.doc,.docx">
                <small class="text-muted">Upload file baru untuk mengganti (PDF, DOC, DOCX, max 20MB)</small>
                @error($field)
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Detail Kerja Sama -->
      <div class="card mb-4">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0">Detail Kerja Sama</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="cooperation_title" class="form-label">Judul Kerja Sama <span class="text-danger">*</span></label>
              <input type="text" name="cooperation_title" id="cooperation_title" class="form-control @error('cooperation_title') is-invalid @enderror" value="{{ old('cooperation_title', $submission->cooperation_title) }}" required>
              @error('cooperation_title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <label for="cooperation_description" class="form-label">Deskripsi Kerja Sama <span class="text-danger">*</span></label>
              <textarea name="cooperation_description" id="cooperation_description" class="form-control @error('cooperation_description') is-invalid @enderror" rows="4" required>{{ old('cooperation_description', $submission->cooperation_description) }}</textarea>
              @error('cooperation_description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <label class="form-label">Ruang Lingkup</label>
              <div>
                @php
                  $currentScope = is_string($submission->cooperation_scope) ? json_decode($submission->cooperation_scope, true) ?? [] : $submission->cooperation_scope ?? [];
                @endphp
                @foreach (['Pendidikan', 'Penelitian', 'Magang', 'Sponsor'] as $scope)
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error('cooperation_scope') is-invalid @enderror" 
                           type="checkbox" 
                           name="cooperation_scope[]" 
                           value="{{ $scope }}" 
                           id="scope_{{ $loop->index }}"
                           {{ (is_array(old('cooperation_scope')) ? in_array($scope, old('cooperation_scope')) : in_array($scope, $currentScope)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="scope_{{ $loop->index }}">{{ $scope }}</label>
                  </div>
                @endforeach
              </div>
              @error('cooperation_scope')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="target_unit" class="form-label">Unit Tujuan <span class="text-danger">*</span></label>
              <input type="text" name="target_unit" id="target_unit" class="form-control @error('target_unit') is-invalid @enderror" value="{{ old('target_unit', $submission->target_unit) }}" required>
              @error('target_unit')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="start_date" class="form-label">Tanggal Mulai</label>
              <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $submission->start_date) }}">
              @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="end_date" class="form-label">Tanggal Selesai</label>
              <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $submission->end_date) }}">
              @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <label for="planned_activities" class="form-label">Rencana Kegiatan <span class="text-danger">*</span></label>
              <textarea name="planned_activities" id="planned_activities" class="form-control @error('planned_activities') is-invalid @enderror" rows="3" required>{{ old('planned_activities', $submission->planned_activities) }}</textarea>
              @error('planned_activities')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>

      <!-- Informasi Tambahan -->
      <div class="card mb-4">
        <div class="card-header bg-warning text-white">
          <h5 class="mb-0">Informasi Tambahan</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="signing_location" class="form-label">Lokasi Penandatanganan</label>
              <input type="text" name="signing_location" id="signing_location" class="form-control @error('signing_location') is-invalid @enderror" value="{{ old('signing_location', $submission->signing_location) }}">
              @error('signing_location')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="special_request" class="form-label">Permintaan Khusus</label>
              <input type="text" name="special_request" id="special_request" class="form-control @error('special_request') is-invalid @enderror" value="{{ old('special_request', $submission->special_request) }}">
              @error('special_request')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <label for="additional_notes" class="form-label">Catatan Tambahan</label>
              <textarea name="additional_notes" id="additional_notes" class="form-control @error('additional_notes') is-invalid @enderror" rows="3">{{ old('additional_notes', $submission->additional_notes) }}</textarea>
              @error('additional_notes')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('superadmin.mou.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-check-circle"></i> Update MOU
        </button>
      </div>
    </form>
  </div>
</section>
@endsection

@push('scripts')
<script>
  setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 5000);
  </script>
@endpush