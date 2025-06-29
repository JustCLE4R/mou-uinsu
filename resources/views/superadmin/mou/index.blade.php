@extends('layouts.main')

@section('content')

<section class="section-padding" style="margin-top: 9vh;">
  <div class="section-header text-center">
    <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">Memorandum of Understanding</h2>
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

  {{-- make an green text alert the admin that there are approved submissions without final documents --}}
  @if ($postApproved->count() > 0)
  <div class="row justify-content-center mt-3 wow fadeInDown">
    <div class="col-12">
      <div class="bg-success text-white p-3 rounded shadow-sm border-0 position-relative" id="mouAlert">
        <button type="button" class="btn btn-sm btn-outline-light position-absolute" style="top: 10px; right: 10px;" onclick="document.getElementById('mouAlert').style.display='none'" aria-label="Close">
          <i class="bi bi-x-lg"></i>
        </button>
        <div class="col-11">
          <i class="bi bi-info-circle me-2"></i>
          <strong>Perhatian:</strong> Terdapat <span class="fw-bold">{{ $postApproved->count() }}</span> pengajuan MoU
          yang telah disetujui namun belum memiliki dokumen final. Silakan lengkapi dokumen tersebut. <a class="text-white" style="text-decoration: underline;" href="?status=postApproved">klik disini untuk menampilkan pengajuan yang belum lengkap!</a>
        </div>
      </div>
      
    </div>
  </div>
  @endif

    <a href="/superadmin" class="text-primary wow fadeInRight mb-5" ata-wow-delay="0.3s"><i
        class="bi bi-chevron-double-left"></i> Kembali</a>
    <div class="row justify-content-between pb-4">

      <div class="col-lg-4 col-md-6 col-sm-12 mb-2 mb-md-0">

        <a href="{{ route('superadmin.mou.create') }}" class="btn btn-success wow fadeInRight" data-wow-delay="0.3s"><i
            class="bi bi-plus"></i> Tambah Dokumen</a>
      </div>
      <div class="col-lg-5 col-md-8 col-sm-12">
        <form class="wow fadeInRight" data-wow-delay="0.3s" action="{{ route('superadmin.mou.index') }}" method="get">
          <div class="input-group">
            <select class="form-select p-1 bg-success text-light shadow" name="institution_type" style="width: 120px;">
              <option value="">Tipe Institusi</option>
              @foreach (['SMK', 'SMA', 'Perguruan Tinggi', 'Vendor', 'Brand', 'Pemerintah', 'Lainnya'] as $type)
              <option value="{{ $type }}" {{ request('institution_type')==$type ? 'selected' : '' }}>{{ $type }}
              </option>
              @endforeach
            </select>
            <select class="form-select p-1 bg-success text-light shadow" name="status" style="width: 110px;">
              <option value="">Status</option>
              @foreach (['pending', 'review', 'approved', 'rejected'] as $status)
              <option value="{{ $status }}" {{ request('status')==$status ? 'selected' : '' }}>{{ ucfirst($status) }}
              </option>
              @endforeach
            </select>
            <input type="text" class="form-control shadow" name="search" placeholder="Cari Institusi / Judul.."
              value="{{ request('search') }}">
            <div class="input-group-append">
              <button class="btn btn-search" id="button-addon2"><i class="bi bi-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>

    @push('scripts')
    <script>
      document.querySelector('form').addEventListener('submit', function(event) {
        const inputs = this.querySelectorAll('select, input[name="result"]');
        inputs.forEach(input => {
          if (!input.value.trim()) {
            input.disabled = true;
          }
        });
      });

      setTimeout(function() {
          $('.alert').fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
          });
      }, 5000);
    </script>
    @endpush

    <div class="col-12" style="overflow-x: auto">
      <table class="table table-hover">
        <tr>
          <th class="text-center">No</th>
          <th>Nama Institusi</th>
          <th>Tipe</th>
          <th>Penanggung Jawab</th>
          <th>Judul Kerja Sama</th>
          <th>Status</th>
          <th class="text-center" width="100">Aksi</th>
        </tr>
        @foreach ($submissions as $submission)
        <tr>
          <td class="text-center">{{ $submissions->firstItem() + $loop->index }}</td>
          <td>
            <a class="text-success" href="{{ route('superadmin.mou.show', $submission->id) }}">
              {{ $submission->institution_name }}
            </a>
          </td>
          <td>{{ $submission->institution_type }}</td>
          <td>
            {{ $submission->pic_name }}<br>
            <small>{{ $submission->pic_phone }}</small>
          </td>
          <td>{{ $submission->cooperation_title }}</td>
          <td>
            <span
              class="badge text-white bg-{{ $submission->status == 'approved' ? 'success' : ($submission->status == 'rejected' ? 'danger' : ($submission->status == 'review' ? 'primary' : 'warning')) }}">
              {{ ucfirst($submission->status) }}
            </span>
          </td>
          <td class="text-center">
            {{-- make button for adding image gallery for {{ $submission->id }} --}}
            @if($submission->status == 'approved')
            <a class="text-warning" href="{{ route('superadmin.mou.gallery.show', $submission->id) }}"><i
                class="bi bi-image"></i></a>
            @endif
            <a class="text-primary" href="{{ route('superadmin.mou.show', $submission->id) }}"><i
                class="bi bi-eye"></i></a>
            @if($submission->status == 'approved')
            <a class="text-success" href="{{ route('superadmin.mou.edit', $submission->id) }}"><i
                class="bi bi-pencil-square"></i></a>
            @endif
            <a class="text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $submission->id }}"><i class="bi bi-trash"></i></a>
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $submission->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $submission->id }}" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $submission->id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="alert-dismissible alert-warning" role="alert">
                  <i class="bi bi-exclamation-triangle me-2"></i>
                  Apakah Anda yakin ingin menghapus pengajuan MoU dari <strong>{{ $submission->institution_name }}</strong>?
                </div>
                <p class="mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form class="d-inline" action="{{ route('superadmin.mou.destroy', $submission->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                </div>
              </div>
              </div>
            </div>
        </tr>
        @endforeach
      </table>
    </div>

    <div id="pagenation">
      {{ $submissions->onEachSide(1)->links() }}
    </div>
  </div>

</section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
@endpush