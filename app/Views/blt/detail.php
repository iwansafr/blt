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
          <tr>
            <td>Progress</td>
            <td>:
              <div class="progress">
                <!-- <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div> -->
                <?php
                foreach ($valid as $key => $value) {
                  if ($key <= $data['valid_count']) {
                ?>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"><?php echo $value; ?></div>
                  <?php
                  } else {
                  ?>
                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"><?php echo $value; ?></div>
                <?php
                  }
                }
                ?>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
</main>
<?php
$this->endSection();
