<?php
$this->extend('layout/dashboard');

$this->section('content');
$session = session();
?>
<main>
  <div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">Dashboard</li>
      <li class="breadcrumb-item active"><?php echo !empty($data) ? 'Edit' : 'Tambah'; ?> Peserta</li>
    </ol>
    <div class="card">
      <?php
      helper('system');
      if (!empty($session->getFlashData('message'))) {
        $message = $session->getFlashData('message');
        alert($message['msg'], $message['alert']);
      }
      ?>

      <form action="/user/edit/<?php echo !empty($data) ? $data['id'] : ''; ?>" method="post" enctype="multipart/form-data">
        <?php
        if (!empty($data)) {
        ?>
          <input type="hidden" name="_method" value="PUT">
        <?php
        }
        ?>
        <?= csrf_field() ?>
        <div class="card-header">
          <?php echo !empty($data) ? 'Edit' : 'Tambah'; ?> Peserta
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Nama</label>
            <?php $valid = !empty($validation->showError('nama')) ? 'is-invalid' : ''; ?>
            <?php $value = !empty($data['nama']) ? $data['nama'] : old('nama'); ?>
            <?php echo form_input(['name' => 'nama', 'placeholder' => 'nama', 'class' => 'form-control ' . $valid, 'value' => $value]); ?>
            <div class="invalid-feedback">
              <?php echo $validation->showError('nama'); ?>
            </div>
          </div>
          <div class="form-group">
            <label>Nik</label>
            <?php $valid = !empty($validation->showError('nik')) ? 'is-invalid' : ''; ?>
            <?php $value = !empty($data['nik']) ? $data['nik'] : old('nik'); ?>
            <?php echo form_input(['type' => 'number', 'name' => 'nik', 'placeholder' => 'nik', 'class' => 'form-control ' . $valid, 'value' => $value]); ?>
            <div class="invalid-feedback">
              <?php echo $validation->showError('nik'); ?>
            </div>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <?php $valid = !empty($validation->showError('alamat')) ? 'is-invalid' : ''; ?>
            <?php $value = !empty($data['alamat']) ? $data['alamat'] : old('alamat'); ?>
            <?php echo form_textarea(['name' => 'alamat', 'placeholder' => 'alamat', 'class' => 'form-control ' . $valid, 'value' => $value]); ?>
            <div class="invalid-feedback">
              <?php echo $validation->showError('alamat'); ?>
            </div>
          </div>
          <div class="form-group">
            <label>Pekerjaan</label>
            <?php $valid = !empty($validation->showError('pekerjaan')) ? 'is-invalid' : ''; ?>
            <?php $value = !empty($data['pekerjaan']) ? $data['pekerjaan'] : old('pekerjaan'); ?>
            <?php echo form_input(['name' => 'pekerjaan', 'placeholder' => 'pekerjaan', 'class' => 'form-control ' . $valid, 'value' => $value]); ?>
            <div class="invalid-feedback">
              <?php echo $validation->showError('pekerjaan'); ?>
            </div>
          </div>
          <div class="form-group">
            <label>Foto Diri</label>
            <?php $valid = !empty($validation->showError('foto_diri')) ? 'is-invalid' : ''; ?>
            <?php $value = !empty($data['foto_diri']) ? $data['foto_diri'] : old('foto_diri'); ?>
            <?php echo form_upload(['name' => 'foto_diri', 'placeholder' => 'foto_diri', 'class' => 'form-control ' . $valid, 'value' => $value]); ?>
            <div class="invalid-feedback">
              <?php echo $validation->showError('foto_diri'); ?>
            </div>
          </div>
          <div class="form-group">
            <label>Foto KTP</label>
            <?php $valid = !empty($validation->showError('foto_ktp')) ? 'is-invalid' : ''; ?>
            <?php $value = !empty($data['foto_ktp']) ? $data['foto_ktp'] : old('foto_ktp'); ?>
            <?php echo form_upload(['name' => 'foto_ktp', 'placeholder' => 'foto_ktp', 'class' => 'form-control ' . $valid, 'value' => $value]); ?>
            <div class="invalid-feedback">
              <?php echo $validation->showError('foto_ktp'); ?>
            </div>
          </div>
          <div class="form-group">
            <label>Foto KK</label>
            <?php $valid = !empty($validation->showError('foto_kk')) ? 'is-invalid' : ''; ?>
            <?php $value = !empty($data['foto_kk']) ? $data['foto_kk'] : old('foto_kk'); ?>
            <?php echo form_upload(['name' => 'foto_kk', 'placeholder' => 'foto_kk', 'class' => 'form-control ' . $valid, 'value' => $value]); ?>
            <div class="invalid-feedback">
              <?php echo $validation->showError('foto_kk'); ?>
            </div>
          </div>
          <div class="form-group">
            <label>Foto Rumah</label>
            <?php $valid = !empty($validation->showError('foto_rumah')) ? 'is-invalid' : ''; ?>
            <?php $value = !empty($data['foto_rumah']) ? $data['foto_rumah'] : old('foto_rumah'); ?>
            <?php echo form_upload(['name' => 'foto_rumah', 'placeholder' => 'foto_rumah', 'class' => 'form-control ' . $valid, 'value' => $value]); ?>
            <div class="invalid-feedback">
              <?php echo $validation->showError('foto_rumah'); ?>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
          <button class="btn btn-sm btn-warning" type="reset"><i class="fa fa-redo"></i> Reset</button>
        </div>
      </form>
    </div>
  </div>
</main>
<?php
$this->endSection();
