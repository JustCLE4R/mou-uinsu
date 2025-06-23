<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengajuan MOU - {{ config('app.name') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Form Pengajuan MOU</h3>
            <small>Silakan lengkapi formulir berikut untuk mengajukan kerja sama</small>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('mou-submission-store') }}" enctype="multipart/form-data">
              @csrf

              <!-- Informasi Mitra -->
              <h4 class="mt-4">Informasi Mitra</h4>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="institution_name" class="form-label">Nama Lembaga/Instansi</label>
                  <input type="text" class="form-control @error('institution_name') is-invalid @enderror" 
                         id="institution_name" name="institution_name" value="{{ old('institution_name') }}" required>
                  @error('institution_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="institution_type" class="form-label">Jenis Institusi</label>
                  <select class="form-select @error('institution_type') is-invalid @enderror" 
                          id="institution_type" name="institution_type" required>
                    <option selected disabled>Pilih jenis institusi...</option>
                    <option value="SMK" {{ old('institution_type') == 'SMK' ? 'selected' : '' }}>SMK</option>
                    <option value="SMA" {{ old('institution_type') == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="Perguruan Tinggi" {{ old('institution_type') == 'Perguruan Tinggi' ? 'selected' : '' }}>Perguruan Tinggi</option>
                    <option value="Vendor" {{ old('institution_type') == 'Vendor' ? 'selected' : '' }}>Vendor</option>
                    <option value="Brand" {{ old('institution_type') == 'Brand' ? 'selected' : '' }}>Brand</option>
                    <option value="Pemerintah" {{ old('institution_type') == 'Pemerintah' ? 'selected' : '' }}>Pemerintah</option>
                    <option value="Lainnya" {{ old('institution_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                  </select>
                  @error('institution_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-12 mb-3">
                  <label for="institution_address" class="form-label">Alamat Lengkap</label>
                  <textarea class="form-control @error('institution_address') is-invalid @enderror" 
                            id="institution_address" name="institution_address" rows="2" required>{{ old('institution_address') }}</textarea>
                  @error('institution_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="institution_website" class="form-label">Website (Opsional)</label>
                  <input type="url" class="form-control @error('institution_website') is-invalid @enderror" 
                         id="institution_website" name="institution_website" value="{{ old('institution_website') }}">
                  @error('institution_website')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Kontak Penanggung Jawab -->
              <h4 class="mt-4">Kontak Penanggung Jawab</h4>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="pic_name" class="form-label">Nama PIC</label>
                  <input type="text" class="form-control @error('pic_name') is-invalid @enderror" 
                         id="pic_name" name="pic_name" value="{{ old('pic_name') }}" required>
                  @error('pic_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="pic_position" class="form-label">Jabatan</label>
                  <input type="text" class="form-control @error('pic_position') is-invalid @enderror" 
                         id="pic_position" name="pic_position" value="{{ old('pic_position') }}" required>
                  @error('pic_position')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="pic_phone" class="form-label">No. Telepon / HP</label>
                  <input type="text" class="form-control @error('pic_phone') is-invalid @enderror" 
                         id="pic_phone" name="pic_phone" value="{{ old('pic_phone') }}" required>
                  @error('pic_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label for="pic_email" class="form-label">Email</label>
                  <input type="email" class="form-control @error('pic_email') is-invalid @enderror" 
                         id="pic_email" name="pic_email" value="{{ old('pic_email') }}" required>
                  @error('pic_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Dokumen Upload -->
              <h4 class="mt-4">Dokumen Pendukung</h4>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Surat Permohonan</label>
                  <input type="file" class="form-control @error('letter_file') is-invalid @enderror" 
                         name="letter_file" accept=".pdf,.doc,.docx">
                  @error('letter_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Proposal Kerja Sama</label>
                  <input type="file" class="form-control @error('proposal_file') is-invalid @enderror" 
                         name="proposal_file" accept=".pdf,.doc,.docx">
                  @error('proposal_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Profil Lembaga</label>
                  <input type="file" class="form-control @error('profile_file') is-invalid @enderror" 
                         name="profile_file" accept=".pdf,.doc,.docx">
                  @error('profile_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Draft MOU/MOA</label>
                  <input type="file" class="form-control @error('draft_mou_file') is-invalid @enderror" 
                         name="draft_mou_file" accept=".pdf,.doc,.docx">
                  @error('draft_mou_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Akta Pendirian</label>
                  <input type="file" class="form-control @error('legal_doc_akta') is-invalid @enderror" 
                         name="legal_doc_akta" accept=".pdf">
                  @error('legal_doc_akta')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">NIB / TDP / SIUP</label>
                  <input type="file" class="form-control @error('legal_doc_nib') is-invalid @enderror" 
                         name="legal_doc_nib" accept=".pdf">
                  @error('legal_doc_nib')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Izin Operasional</label>
                  <input type="file" class="form-control @error('legal_doc_operasional') is-invalid @enderror" 
                         name="legal_doc_operasional" accept=".pdf">
                  @error('legal_doc_operasional')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Informasi Kerja Sama -->
              <h4 class="mt-4">Detail Pengajuan MOU</h4>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="cooperation_title" class="form-label">Judul Kerja Sama</label>
                  <input type="text" class="form-control @error('cooperation_title') is-invalid @enderror" 
                         id="cooperation_title" name="cooperation_title" value="{{ old('cooperation_title') }}" required>
                  @error('cooperation_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-12 mb-3">
                  <label for="cooperation_description" class="form-label">Deskripsi Tujuan</label>
                  <textarea class="form-control @error('cooperation_description') is-invalid @enderror" 
                            id="cooperation_description" name="cooperation_description" rows="2" required>{{ old('cooperation_description') }}</textarea>
                  @error('cooperation_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-12 mb-3">
                  <label class="form-label">Ruang Lingkup</label>
                  <div class="form-check">
                    <input class="form-check-input @error('cooperation_scope') is-invalid @enderror" 
                           type="checkbox" name="cooperation_scope[]" value="Pendidikan" id="scope1"
                           {{ is_array(old('cooperation_scope')) && in_array('Pendidikan', old('cooperation_scope')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="scope1">Pendidikan</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input @error('cooperation_scope') is-invalid @enderror" 
                           type="checkbox" name="cooperation_scope[]" value="Penelitian" id="scope2"
                           {{ is_array(old('cooperation_scope')) && in_array('Penelitian', old('cooperation_scope')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="scope2">Penelitian</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input @error('cooperation_scope') is-invalid @enderror" 
                           type="checkbox" name="cooperation_scope[]" value="Magang" id="scope3"
                           {{ is_array(old('cooperation_scope')) && in_array('Magang', old('cooperation_scope')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="scope3">Magang</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input @error('cooperation_scope') is-invalid @enderror" 
                           type="checkbox" name="cooperation_scope[]" value="Sponsor" id="scope4"
                           {{ is_array(old('cooperation_scope')) && in_array('Sponsor', old('cooperation_scope')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="scope4">Sponsor Event</label>
                  </div>
                  @error('cooperation_scope')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-12 mb-3">
                  <label for="planned_activities" class="form-label">Rencana Kegiatan</label>
                  <textarea class="form-control @error('planned_activities') is-invalid @enderror" 
                            id="planned_activities" name="planned_activities" rows="2" required>{{ old('planned_activities') }}</textarea>
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

              <!-- Informasi Tambahan -->
              <h4 class="mt-4">Informasi Tambahan</h4>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="signing_location" class="form-label">Lokasi Penandatanganan</label>
                  <input type="text" class="form-control @error('signing_location') is-invalid @enderror" 
                         id="signing_location" name="signing_location" value="{{ old('signing_location') }}">
                  @error('signing_location')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-12 mb-3">
                  <label for="special_request" class="form-label">Permintaan Khusus</label>
                  <textarea class="form-control @error('special_request') is-invalid @enderror" 
                            id="special_request" name="special_request" rows="2">{{ old('special_request') }}</textarea>
                  @error('special_request')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-12 mb-3">
                  <label for="additional_notes" class="form-label">Catatan Tambahan</label>
                  <textarea class="form-control @error('additional_notes') is-invalid @enderror" 
                            id="additional_notes" name="additional_notes" rows="2">{{ old('additional_notes') }}</textarea>
                  @error('additional_notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Persetujuan -->
              <div class="form-check mb-4">
                <input class="form-check-input @error('agree') is-invalid @enderror" 
                       type="checkbox" value="1" id="agree" name="agree" 
                       {{ old('agree') ? 'checked' : '' }} required>
                <label class="form-check-label" for="agree">
                  Saya menyetujui semua <a href="{{ route('snk') }}" target="_blank">syarat dan ketentuan</a> pengajuan kerja sama ini.
                </label>
                @error('agree')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Submit -->
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="reset" class="btn btn-secondary me-md-2">Reset</button>
                <button type="submit" class="btn btn-primary">Ajukan MOU</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
