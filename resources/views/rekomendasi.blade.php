<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>HyRec</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <a class="navbar-brand" href="/">
      <img src="img/trace.svg" width="50" height="50" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/rekomendasi">Rekomendasi</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="card text-white bg-danger mb-3 mx-auto" style="max-width: 18rem;">
      <div class="card-header text-center">
        <h5>Hitung Kalori Harian</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="/hasil">
          @csrf
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="umur">Umur</label>
            <input type="number" class="form-control" id="umur" name="umur" placeholder="Umur (Tahun)" required>
          </div>
          <div class="form-group">
            <label for="berat_badan">Berat Badan</label>
            <input type="number" class="form-control" id="berat_badan" name="berat_badan" placeholder="Berat Badan (Kg)" required>
          </div>
          <div class="form-group">
            <label for="tinggi_badan">Tinggi Badan</label>
            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan (Cm)" required>
          </div>
          <div class="form-group">
            <label for="sistolik">Sistolik</label>
            <input type="number" class="form-control" id="sistolik" name="sistolik" placeholder="Sistolik (Mmhg)" required>
          </div>
          <div class="form-group">
            <label for="diastolik">Diastolik</label>
            <input type="number" class="form-control" id="diastolik" name="diastolik" placeholder="Diastolik (Mmhg)" required>
          </div>
          <div class="form-group">
            <label for="aktivitas">Seberapa Aktif Anda?</label>
            <select class="form-control" id="aktivitas" name="aktivitas">
              <option value="1">1. Menetap</option>
              <option value="2">2. Aktif Ringan</option>
              <option value="3">3. Aktif</option>
              <option value="4">4. Sangat Aktif</option>
            </select>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-success">Hasil</button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>