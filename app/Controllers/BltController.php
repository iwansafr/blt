<?php

namespace App\Controllers;

use App\Models\Blt;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BltController extends BaseController
{
  public function __construct()
  {
    helper('form');
  }
  public function list($valid = 1)
  {
    $blt = new Blt();
    $data = $blt->where('valid_count', $valid)->find();
    return view('blt/index', ['data' => $data]);
  }
  public function index()
  {
    $blt = new Blt();
    $data = $blt->findAll();
    return view('blt/index', ['data' => $data]);
  }
  public function detail($id = 0)
  {
    $blt = new Blt();
    $data = $blt->find($id);
    if (empty($data)) {
      helper('system');
      return view('layout/forbidden', ['msg' => 'Maaf Data tidak ditemukan', 'alert' => 'danger']);
    } else {
      return view('blt/detail', ['data' => $data, 'valid' => $blt->valid()]);
    }
  }
  public function edit($id = 0)
  {
    session();
    $data = [];
    $blt = new Blt();
    if (!empty($id)) {
      $data = $blt->find($id);
    }
    return view('blt/edit', ['validation' => \Config\Services::validation(), 'data' => $data]);
  }
  public function update($id = 0)
  {
    helper('system');
    // helper('file');
    $validation = [
      'nik' => [
        'label' => 'Nik',
        'rules' => 'required|is_unique[blts.nik,id,' . $id . ']',
        'errors' => [
          'required' => '{field} Tidak Boleh Kosong',
          'is_unique' => '{field} Sudah Ada',
        ]
      ],
      'nama' => [
        'label' => 'Nama',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Tidak Boleh Kosong',
        ]
      ],
      'alamat' => [
        'label' => 'Alamat',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Tidak Boleh Kosong',
        ]
      ],
      'pekerjaan' => [
        'label' => 'Pekerjaan',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Tidak Boleh Kosong',
        ]
      ],
    ];
    $data = [
      'nama' => $this->request->getPost('nama'),
      'nik' => $this->request->getPost('nik'),
      'alamat' => $this->request->getPost('alamat'),
      'pekerjaan' => $this->request->getPost('pekerjaan'),
      'latitude' => $this->request->getPost('latitude'),
      'longitude' => $this->request->getPost('longitude'),
    ];
    if (empty($id)) {
      $blt = new Blt();
      $validation['foto_diri'] = [
        'label' => 'Foto Diri',
        'rules' => 'uploaded[foto_diri]|is_image[foto_diri]',
        'errors' => [
          'uploaded' => '{field} Tidak Boleh Kosong',
          'is_image' => 'format gambar {field} tidak sesuai'
        ]
      ];
      $validation['foto_ktp'] = [
        'label' => 'Foto KTP',
        'rules' => 'uploaded[foto_ktp]|is_image[foto_ktp]',
        'errors' => [
          'uploaded' => '{field} Tidak Boleh Kosong',
          'is_image' => 'format gambar {field} tidak sesuai'
        ]
      ];
      $validation['foto_kk'] = [
        'label' => 'Foto KK',
        'rules' => 'uploaded[foto_kk]|is_image[foto_kk]',
        'errors' => [
          'uploaded' => '{field} Tidak Boleh Kosong',
          'is_image' => 'format gambar {field} tidak sesuai'
        ]
      ];
      $validation['foto_rumah'] = [
        'label' => 'Foto Rumah',
        'rules' => 'uploaded[foto_rumah]|is_image[foto_rumah]',
        'errors' => [
          'uploaded' => '{field} Tidak Boleh Kosong',
          'is_image' => 'format gambar {field} tidak sesuai'
        ]
      ];
    } else {
      $blt = new Blt();
      $blt_data = $blt->find($id);
      $data['id'] = $blt_data['id'];
    }
    if (!$this->validate($validation)) {
      // $validation = \Config\Services::validation();
      // return redirect()->back()->withinput()->with('validation', $validation);
      return redirect()->to('/blt/edit/' . $id)->withinput();
    }

    $foto = [];
    $file = $this->request->getFile('foto_diri');
    if (!empty($file->getClientExtension())) {
      $foto['foto_diri'] = 'foto_diri-' . $data['nik'] . '.' . $file->getClientExtension();
      if (file_exists('images/blt' . $foto['foto_diri'])) {
        unlink('images/blt/' . $foto['foto_diri']);
      }
      if ($file->move('images/blt/', $foto['foto_diri'])) {
        $data['foto_diri'] = $foto['foto_diri'];
      }
    }
    $file = $this->request->getFile('foto_ktp');
    if (!empty($file->getClientExtension())) {
      $foto['foto_ktp'] = 'foto_ktp-' . $data['nik'] . '.' . $file->getClientExtension();
      if (file_exists('images/blt' . $foto['foto_ktp'])) {
        unlink('images/blt/' . $foto['foto_ktp']);
      }
      if ($file->move('images/blt/', $foto['foto_ktp'])) {
        $data['foto_ktp'] = $foto['foto_ktp'];
      }
    }
    $file = $this->request->getFile('foto_kk');
    if (!empty($file->getClientExtension())) {
      $foto['foto_kk'] = 'foto_kk-' . $data['nik'] . '.' . $file->getClientExtension();
      if (file_exists('images/blt' . $foto['foto_kk'])) {
        unlink('images/blt/' . $foto['foto_kk']);
      }
      if ($file->move('images/blt/', $foto['foto_kk'])) {
        $data['foto_kk'] = $foto['foto_kk'];
      }
    }
    $file = $this->request->getFile('foto_rumah');
    if (!empty($file->getClientExtension())) {
      $foto['foto_rumah'] = 'foto_rumah-' . $data['nik'] . '.' . $file->getClientExtension();
      if (file_exists('images/blt' . $foto['foto_rumah'])) {
        unlink('images/blt/' . $foto['foto_rumah']);
      }
      if ($file->move('images/blt/', $foto['foto_rumah'])) {
        $data['foto_rumah'] = $foto['foto_rumah'];
      }
    }
    if ($blt->save(
      $data
    )) {
      return redirect()->to('/blt/edit/' . $id)->with('message', ['msg' => 'Data Berhasil di simpan', 'alert' => 'success']);
    } else {
      return redirect()->to('/blt/edit/' . $id)->withinput()->with('message', ['msg' => 'Data Berhasil di simpan', 'alert' => 'success']);
    }
  }

  public function delete($id = 0)
  {
    if (!empty($id)) {
      $blt = new Blt();
      $data = $blt->find($id);
      if ($blt->delete($id)) {
        if (!empty($data)) {
          if (file_exists('images/blt/' . $data['foto_diri'])) {
            unlink('images/blt/' . $data['foto_diri']);
          }
          if (file_exists('images/blt/' . $data['foto_ktp'])) {
            unlink('images/blt/' . $data['foto_ktp']);
          }
          if (file_exists('images/blt/' . $data['foto_kk'])) {
            unlink('images/blt/' . $data['foto_kk']);
          }
          if (file_exists('images/blt/' . $data['foto_rumah'])) {
            unlink('images/blt/' . $data['foto_rumah']);
          }
        }
        return redirect()->to('/blt/list')->with('message', ['msg' => 'Data Berhasil di Hapus', 'alert' => 'success']);
      } else {
        return redirect()->to('/blt/list')->with('message', ['msg' => 'Data Gagal di Hapus', 'alert' => 'danger']);
      }
    }
  }
  public function excel()
  {
    $blt = new Blt();
    $dataBlt = $blt->findAll();
    $spreadsheet = new Spreadsheet();

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'NIK')
      ->setCellValue('B1', 'NAMA')
      ->setCellValue('C1', 'ALAMAT')
      ->setCellValue('D1', 'PEKERJAAN')
      ->setCellValue('E1', 'LONGITUDE')
      ->setCellValue('F1', 'LATITUDE');
    $column = 2;
    foreach ($dataBlt as $key => $value) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, $value['nik'])
        ->setCellValue('B' . $column, $value['nama'])
        ->setCellValue('C' . $column, $value['alamat'])
        ->setCellValue('D' . $column, $value['pekerjaan'])
        ->setCellValue('E' . $column, $value['longitude'])
        ->setCellValue('F' . $column, $value['latitude']);
      $column++;
    }

    $writer = new Xlsx($spreadsheet);
    $fileName = 'Data Blt';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }
}