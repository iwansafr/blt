<?php
$this->extend('layout/dashboard');

$this->section('content');

?>
<main>
  <div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">Dashboard</li>
      <li class="breadcrumb-item active">Data User</li>
    </ol>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data User
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>password</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>password</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
              $i = 1;
              helper('system');
              foreach ($data as $key => $value) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $value['username']; ?></td>
                  <td><?php echo $value['role']; ?></td>
                  <td><?php echo $value['password']; ?></td>
                  <td><a href="/user/edit/<?php echo $value['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a> <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
              <?php
                $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
$this->endSection();
