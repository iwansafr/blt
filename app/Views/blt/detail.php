<?php
$this->extend('layout/dashboard');

$this->section('content');
?>
<main>
  <div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">Dashboard</li>
      <li class="breadcrumb-item">BLT</li>
      <li class="breadcrumb-item active">Detail</li>
    </ol>
    <div class="card">
      <div class="card-header">
        Detail
      </div>
      <div class="card-body">
        <table class="table table-borderless">
          <tr>
            <td>Nama</td>
            <td>: <?php echo $data['nama']; ?></td>
          </tr>
          <tr>
            <td>NIK</td>
            <td>: <?php echo $data['nik']; ?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>: <?php echo $data['alamat']; ?></td>
          </tr>
          <tr>
            <td>Pekerjaan</td>
            <td>: <?php echo $data['pekerjaan']; ?></td>
          </tr>
          <tr>
            <td>Koordinat</td>
            <td>: Longitude <?php echo $data['longitude']; ?> Latitude <?php echo $data['latitude']; ?> <a target="_blank" href="https://www.google.com/maps/dir//<?php echo $data['latitude']; ?>,<?php echo $data['longitude']; ?>/@<?php echo $data['latitude']; ?>,<?php echo $data['longitude']; ?>" class="btn btn-default btn-warning"><i class="fa fa-map"></i> Lihat Map</a></td>
          </tr>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
</main>
<?php
$this->endSection();
