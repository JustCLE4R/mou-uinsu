<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengajuan Berhasil - {{ config('app.name') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow">
          <div class="card-body text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#198754" class="mb-4" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM7 10.293l4.146-4.147-.708-.707L7 8.879 5.354 7.146l-.708.708L7 10.293z"/>
            </svg>
            <h2 class="mb-3 text-success">Pengajuan Berhasil!</h2>

            <p class="mb-0">Nomor Referensi:</p>
            <strong>{{ session('data.reference_number') }}</strong>
            <p class="text-muted mt-4 mb-0">Simpan nomor referensi ini untuk pengecekan status pengajuan Anda.</p>
            <p class="text-muted mb-4">Jika ada pertanyaan, silakan hubungi kami melalui email atau nomor telepon yang tersedia di situs web.</p>

            <p class="mb-4">
              Terima kasih telah mengajukan kerja sama MOU.<br>
              Data dan dokumen Anda telah kami terima.<br>
              Silakan menunggu, tim kami akan segera menghubungi Anda melalui kontak yang telah dicantumkan.
            </p>
            <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>