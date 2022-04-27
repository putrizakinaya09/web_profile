<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/carousel.css">
  <title>STMIK Mardira</title>
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">STMIK Mardira Indonesia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a id="home" class="nav-link" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile</a>
              <div class="dropdown-menu">
                <a id="sambutan" href="<?= base_url() ?>/sambutan" class="dropdown-item">Sabutan KA.Prodi</a>
                <a id="visi-misi" href="<?= base_url() ?>/visi-misi" class="dropdown-item">Visi dan Misi</a>
                <a id="struktur-organisasi" href="<?= base_url() ?>/struktur-organisasi" class="dropdown-item">Struktur Organisasi</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Kegiatan</a>
              <div class="dropdown-menu">
                <a id="pengumuman" href="<?= base_url() ?>/pengumuman" class="dropdown-item">Pengumuman</a>
                <a id="berita" href="#" class="dropdown-item">Berita</a>
                <a id="gallery" href="#" class="dropdown-item">Gallery</a>
              </div>
            </li>
            <li class="nav-item">
              <a id="kurikulum" class="nav-link" href="<?= base_url() ?>/kurikulum">Kurikulum</a>
            </li>
            <li class="nav-item">
              <a id="kontak" class="nav-link" href="<?= base_url() ?>/kontak">Kontak</a>
            </li>

          </ul>

        </div>
      </div>
    </nav>
  </header>

  <main class="min-vh-50 d-flex flex-column justify-content-between">

    <?= $this->include('layouts/carosel') ?>
    <?= $this->renderSection('content') ?>

    <!-- FOOTER -->
    <footer class="container-fluid mt-5">
      <p class="float-end"><a href="#">Back to top</a></p>
      <p>&copy; 2022 STMIK Mardira Indonesia. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    const last_segment = window.location.pathname.split('/').pop();
    if (last_segment !== '') {
      $(`#${last_segment}`).parent().siblings().addClass('active');
      $(`#${last_segment}`).addClass('active');
    } else {
      $(`#home`).addClass('active');
    }
  </script>
</body>

</html>