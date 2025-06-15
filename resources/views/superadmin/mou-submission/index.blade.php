@extends('layouts.main')

@section('content')

<section class="section-padding" style="margin-top: 9vh;">
  <div class="section-header text-center">
    <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">Dokumen</h2>
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
    <div class="row justify-content-between pb-4">
      <div class="col-lg-4 col-md-6 col-sm-12 mb-2 mb-md-0">
        <a href="/superadmin"  class="btn btn-success wow fadeInRight" ata-wow-delay="0.3s"><i class="bi bi-chevron-double-left"></i> Kembali</a>
        <a href="/superadmin/dokumen/create" class="btn btn-success wow fadeInRight" data-wow-delay="0.3s"><i class="bi bi-plus"></i> Tambah Dokumen</a>
      </div>
      <div class="col-lg-5 col-md-8 col-sm-12">
        <form class="wow fadeInRight" data-wow-delay="0.3s" action="/superadmin/dokumen" method="get">
          <div class="input-group">
            <select class="form-select p-1 bg-success text-light shadow" name="kategori" id="" style="width: 90px;">
              <option value="" selected>Kategori</option>
              @foreach ($kategoris as $kategori)
              <option value="{{ $kategori->id }}" {{ request()->input('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->name }}</option>
              @endforeach
            </select>
            <select class="form-select p-1 bg-success text-light shadow" name="tipe" id="" style="max-width: 80px;">
              <option value="" selected>Tipe</option>
              <option value="URL" {{ request()->input('tipe') == 'URL' ? 'selected' : '' }}>URL</option>
              <option value="PDF" {{ request()->input('tipe') == 'PDF' ? 'selected' : '' }}>PDF</option>
              <option value="Image" {{ request()->input('tipe') == 'Image' ? 'selected' : '' }}>Image</option>
            </select>
            <select class="form-select p-1 bg-success text-light shadow" name="department" id="" style="max-width: 125px">
              <option value="" selected>Departemen</option>
              @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ request()->input('department') == $department->id ? 'selected' : '' }}>
                {{ $department->type == 'faculty' ? '===' . $department->name . '===' : $department->name }}
                </option>
              @endforeach
            </select>
            <input type="text" class="form-control shadow" name="result" placeholder="Cari Dokumen.." aria-describedby="button-addon2" value="{{ old('result', request()->input('result')) }}">
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
          <th>Nama</th>
          <th class="text-center">Kategori</th>
          <th>Sub Kategori</th>
          <th>Pemilik</th>
          <th class="text-center">Tipe</th>
          <th class="text-center">Aksi</th>
        </tr>
        @foreach ($dokumens as $dokumen)
          <tr>
            <td class="text-center">{{ $dokumens->firstItem() + $loop->index }}</td>
            <td><a class="text-success" href="{{ route('superadmin.dokumen.show', $dokumen->id) }}">{{ $dokumen->name }}</a></td>
            <td class="text-center">{{ $dokumen->kategori->name }}</td>
            <td>{{ $dokumen->sub_kategori }}</td>
            <td>{{ $dokumen->user->department->name }}</td>
            <td class="text-center">{{ $dokumen->tipe }}</td>
            <td class="text-center">
              <a class="text-primary" href="{{ route('superadmin.dokumen.edit', $dokumen->id) }}"><i class="bi bi-pencil-square"></i></a>

              <button type="button" class="text-danger" style="background:none; border:none; padding:0;" data-toggle="modal" data-target="#deleteModal-{{ $dokumen->id }}"><i class="bi bi-trash"></i></button>

              <div class="modal fade" id="deleteModal-{{ $dokumen->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $dokumen->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  " role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-dark" id="deleteModalLabel-{{ $dokumen->id }}">Konfirmasi Hapus Dokumen</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body d-flex justify-content-start text-dark">
                      Apakah anda yakin ingin menghapus dokumen "{{ $dokumen->name }}"?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <form class="d-inline" action="{{ route('superadmin.dokumen.destroy', $dokumen->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </td>
          </tr>
        @endforeach
      </table>
    </div>

    <div id="pagenation">
      {{ $dokumens->onEachSide(1)->links() }}
    </div>
  </div>
  <!-- Modal -->


</section>
@endsection