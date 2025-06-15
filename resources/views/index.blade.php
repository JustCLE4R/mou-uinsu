<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kerja Sama MOU – UINSU Medan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<header class="bg-primary text-white text-center py-5">
  <div class="container">
    <h1 class="display-5 fw-bold">UINSU Medan Membuka Peluang Kerja Sama (MOU)</h1>
    <p class="lead mt-3">Kami mengundang lembaga, instansi, sekolah, industri, dan mitra strategis lainnya untuk membangun kolaborasi yang berdampak.</p>
    <a href="{{ route('mou-submission') }}" class="btn btn-light btn-lg mt-4 shadow">Ajukan MOU Sekarang</a>
  </div>
</header>

<!-- Content -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('img/logo.png') }}" alt="UINSU Logo" class="img-fluid" style="max-height: 150px;">
        <h2 class="mt-4">Tentang Kerja Sama</h2>
        <p>Universitas Islam Negeri Sumatera Utara (UINSU) Medan membuka kesempatan kerja sama dalam berbagai bidang seperti pendidikan, pelatihan, riset, pengabdian masyarakat, magang, hingga kegiatan sosial dan keagamaan.</p>
        <p>Kami percaya bahwa kolaborasi yang baik akan meningkatkan mutu pendidikan dan kontribusi nyata bagi masyarakat.</p>
      </div>
      <div class="col-md-6">
        <div class="bg-white p-4 shadow rounded">
          <h5 class="mb-3">Bidang Kerja Sama yang Dibuka</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">📚 Pendidikan dan Pelatihan</li>
            <li class="list-group-item">🔬 Penelitian dan Riset Bersama</li>
            <li class="list-group-item">🏢 Magang dan Penyaluran SDM</li>
            <li class="list-group-item">📈 Peningkatan Kompetensi</li>
            <li class="list-group-item">🎓 Kegiatan Sosial, Keagamaan & Event</li>
          </ul>
          <div class="text-center mt-4">
            <a href="{{ route('mou-submission') }}" class="btn btn-outline-primary">Isi Formulir Pengajuan</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
  <small>&copy; {{ date('Y') }} UINSU Medan — Pusat Kerja Sama & Hubungan Luar Negeri</small>
</footer>

</body>
</html>
