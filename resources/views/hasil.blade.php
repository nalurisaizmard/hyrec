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
  <style>
    .center-vertical {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .container {
      margin-top: 20px;
    }
  </style>

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
          <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/rekomendasi">Rekomendasi</a>
        </li>
      </ul>
    </div>
  </nav>

  <style>
    .center-vertical {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
    }
  </style>

  <div class="container">
    <h5 class="font-weight-bold text-center">Hasil Rekomendasi Bahan Makanan</h5>
    <div class="row">
      <div class="col-sm text-center">
        <div class="center-vertical">
          <img src="icon/tensiometer.png" width="80" height="80" alt="User Icon">
          <h5>Kategori Hipertensi</h5>
          <h3>{{ $kategori }}</h3>
        </div>
      </div>
      <div class="col-sm text-center">
        <div class="center-vertical">
          <img src="icon/balanced-diet.png" width="80" height="80" alt="User Icon">
          <h5>Kalori Harian</h5>
          <h3>{{ $kalori }}</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">

      <div class="col-sm">
        <div class="card" style="width: 18rem;">
          <div class="card-body text-center">
            <h5 class="card-title">Makan Pagi</h5>
            <div class="d-flex flex-column align-items-center">
              <div>
              <img src="icon/karbo.jpeg" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[0]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[0]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[0]['energi'] }} kal</p>
              <div>
              <img src="icon/protein.jpeg" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[1]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[1]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[1]['energi'] }} kal</p>
              <div>
              <img src="icon/vegetable.png" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[2]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[2]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[2]['energi'] }} kal</p>
              <div>
              <img src="icon/fruits.png" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[3]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[3]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[3]['energi'] }} kal</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm">
        <div class="card" style="width: 18rem;">
          <div class="card-body text-center">
            <h5 class="card-title">Makan Siang</h5>
            <div class="d-flex flex-column align-items-center">
              <div>
              <img src="icon/karbo.jpeg" alt="User Icon" width="50" height="50">
            </div>
              <p>Nama Bahan: {{ $hasil_kromosom[4]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[4]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[4]['energi'] }} kal</p>
              <div>
              <img src="icon/protein.jpeg" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[5]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[5]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[5]['energi'] }} kal</p>
              <div>
              <img src="icon/vegetable.png" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[6]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[6]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[6]['energi'] }} kal</p>
              <div>
              <img src="icon/fruits.png" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[7]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[7]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[7]['energi'] }} kal</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm">
        <div class="card" style="width: 18rem;">
          <div class="card-body text-center">
            <h5 class="card-title">Makan Malam</h5>
            <div class="d-flex flex-column align-items-center">
              <div>
              <img src="icon/karbo.jpeg" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[8]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[8]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[8]['energi'] }} kal</p>
              <div>
              <img src="icon/protein.jpeg" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[9]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[9]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[9]['energi'] }} kal</p>
              <div>
              <img src="icon/vegetable.png" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[10]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[10]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[10]['energi'] }} kal</p>
              <div>
              <img src="icon/fruits.png" alt="User Icon" width="50" height="50">
              </div>
              <p>Nama Bahan: {{ $hasil_kromosom[11]['nama_bahan'] }}</p>
              <p>Berat: {{ $hasil_kromosom[11]['berat'] }} gram</p>
              <p>Kalori: {{ $hasil_kromosom[11]['energi'] }} kal</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">HyRec</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah Anda ingin mendapatkan rekomendasi bahan makanan lainnya?
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Tidak</button>
          <button class="btn btn-danger" role="button" onclick="location.reload()">Ya</button>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="col-sm text-center mb-3">
      <p class="font-weight-bold">Apakah rekomendasi bahan makanan yang diberikan sesuai dengan kebutuhan Anda?</p>
    </div>
    <div class="col-sm text-center mb-3 d-flex justify-content-center">

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-secondary mr-2" data-toggle="modal" data-target="#exampleModal">
        Tidak
      </button>

      <form action="/fix" method="post">
        @csrf
        <textarea name="hasil" style="display: none;"><?= json_encode($hasil_kromosom) ?></textarea>
        <button class="btn btn-danger" role="submit">Ya</button>
      </form>

    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>