<?php

namespace App\Models;

use CodeIgniter\Model;

class Blt extends Model
{
  protected $table = 'blts';
  protected $primaryKey = 'id';

  // protected $returnType = 'array';
  // protected $useSoftDeletes = true;

  protected $allowedFields = ['nama', 'nik', 'alamat', 'pekerjaan', 'foto_diri', 'foto_kk', 'foto_ktp', 'foto_rumah', 'longitude', 'latitude', 'valid_count'];

  protected $useTimestamps = true;
  // protected $createdField = 'created_at';
  // protected $updatedField = 'updated_at';
  // protected $deletedField = 'deleted_at';

  // protected $validationRules = [];
  // protected $validationMessages = [];
  // protected $skipValidation = false;
  public function role()
  {
    return ['1' => 'Root', '2' => 'Admin Kementerian', '3' => 'Admin Provinsi', '4' => 'Admin Dinsos', '5' => 'Admin Kecamatan', '6' => 'Admin Desa'];
  }
}
