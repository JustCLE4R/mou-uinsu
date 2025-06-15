<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Pengajuan MOU</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .step-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
    }
    .step-line {
      position: absolute;
      top: 24px;
      left: 0;
      right: 0;
      height: 4px;
      background-color: #dee2e6;
      z-index: 0;
    }
    .step-item {
      z-index: 1;
      text-align: center;
      flex: 1;
      position: relative;
    }
    .step-circle {
      width: 48px;
      height: 48px;
      line-height: 48px;
      border-radius: 50%;
      background-color: #dee2e6;
      color: white;
      font-weight: bold;
      font-size: 1.3rem;
      margin: 0 auto 10px auto;
      border: 3px solid #dee2e6;
      transition: background 0.3s, border 0.3s;
    }
    .step-circle.finished {
      background-color: #198754;
      border-color: #198754;
    }
    .step-circle.current {
      background-color: #0d6efd;
      border-color: #0d6efd;
    }
    .step-circle.next {
      background-color: #7a7a7a;
      border-color: #7a7a7a;
      /* color: #212529; */
    }
    .step-circle.rejected {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .step-label {
      font-size: 1rem;
      color: #6c757d;
      font-weight: 500;
    }
    .step-label.finished {
      color: #198754;
    }
    .step-label.current {
      color: #0d6efd;
    }
    .step-label.next {
      color: #7a7a7a;
    }
    .step-label.rejected {
      color: #dc3545;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="row justify-content-center">
      <div class="col-md-6">
      <div class="card">
        <div class="card-header">
        <h5 class="mb-0">Cek Status Pengajuan</h5>
        </div>
        <div class="card-body">
        <form method="GET" action="{{ url()->current() }}">
          <div class="mb-3">
          <label for="reference_number" class="form-label">Nomor Referensi</label>
          <input type="text" class="form-control" id="reference_number" name="reference_number" 
                placeholder="Masukkan nomor referensi pengajuan" value="{{ request('reference_number') }}" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Cek Status</button>
        </form>
        </div>
      </div>
      </div>
    </div>
    <h2 class="mb-4 text-center">Status Pengajuan MOU</h2>
    @if (!empty($submission))
      @php
        // Step: Pending -> Review -> Disetujui/Ditolak
        $steps = [
          'pending' => 'Menunggu',
          'review' => 'Ditinjau',
          'finish' => 'Disetujui/Ditolak'
        ];
        $status = $submission->status;
        // Tentukan posisi step
        $stepKeys = array_keys($steps);
        if ($status === 'pending') $currentStep = 0;
        elseif ($status === 'review') $currentStep = 1;
        else $currentStep = 2; // approved/rejected
      @endphp

      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="step-wrapper mb-5" style="min-width: 300px;">
            <div class="step-line"></div>
            @foreach($steps as $key => $label)
              @php
                $idx = $loop->index;
                // Untuk node terakhir, cek status
                if ($key === 'finish') {
                  if ($status === 'approved') {
                    $circleClass = 'finished';
                    $labelClass = 'finished';
                    $label = 'Disetujui';
                    $icon = '<i class="bi bi-check-lg"></i>';
                  } elseif ($status === 'rejected') {
                    $circleClass = 'rejected';
                    $labelClass = 'rejected';
                    $label = 'Ditolak';
                    $icon = '<i class="bi bi-x-lg"></i>';
                  } elseif ($currentStep > $idx) {
                    $circleClass = 'finished';
                    $labelClass = 'finished';
                    $icon = $loop->iteration;
                  } elseif ($currentStep == $idx) {
                    $circleClass = 'current';
                    $labelClass = 'current';
                    $icon = $loop->iteration;
                  } else {
                    $circleClass = 'next';
                    $labelClass = 'next';
                    $icon = $loop->iteration;
                  }
                } else {
                  if ($currentStep > $idx) {
                    $circleClass = 'finished';
                    $labelClass = 'finished';
                    $icon = '<i class="bi bi-check-lg"></i>';
                  } elseif ($currentStep == $idx) {
                    $circleClass = 'current';
                    $labelClass = 'current';
                    $icon = $loop->iteration;
                  } else {
                    $circleClass = 'next';
                    $labelClass = 'next';
                    $icon = $loop->iteration;
                  }
                }
              @endphp
              <div class="step-item">
                <div class="step-circle {{ $circleClass }}">
                  {!! $icon !!}
                </div>
                <div class="step-label {{ $labelClass }}">
                  {{ $label }}
                </div>
              </div>
            @endforeach
          </div>

          <div class="text-center mt-4">
            <h4>
              @switch($status)
                @case('pending')
                  Menunggu verifikasi admin.
                  @break
                @case('review')
                  Pengajuan sedang ditinjau.
                  @break
                @case('approved')
                  Pengajuan telah disetujui.
                  @break
                @case('rejected')
                  Pengajuan ditolak.
                  @break
                @default
                  Status tidak diketahui.
              @endswitch
            </h4>
            @if(!empty($submission->status_message))
              <div class="alert {{ $status === 'rejected' ? 'alert-danger' : 'alert-info' }} mt-3" role="alert">
                {{ $submission->status_message }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  @endif
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
