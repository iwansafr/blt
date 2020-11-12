<?php

namespace App\Controllers;

use App\Models\Blt;

class BltController extends BaseController
{
  public function __construct()
  {
    helper('form');
  }
  public function index()
  {
    $blt = new Blt();
    $data = $blt->findAll();
    return view('blt/index', ['data' => $data]);
  }
  public function edit($id = 0)
  {
    session();
    $data = [];
    $blt = new Blt();
    if (!empty($id)) {
      $data = $blt->find($id);
    }
    return view('blt/edit', ['validation' => \Config\Services::validation()]);
  }
  public function update($id = 0)
  {
    helper('system');
    if ($this->request->getMethod() == 'post') {
      $blt = new Blt();
      $data = [
        'nama' => $this->request->getPost('nama'),
        'nik' => $this->request->getPost('nik'),
        'alamat' => $this->request->getPost('alamat'),
        'role' => $this->request->getPost('role'),
      ];
    } else if ($this->request->getMethod() == 'put') {
      $blt = new Blt();
      $blt_data = $blt->find($id);
      $data = [
        'id' => $blt_data['id'],
        'username' => $this->request->getPost('username'),
        'password' => encrypt($this->request->getPost('password')),
        'role' => $this->request->getPost('role'),
      ];
    }
    if (!$this->validate([
      'username' => 'required|is_unique[users.username,id,' . $id . ']',
      'password' => 'required'
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->back()->withinput()->with('validation', $validation);
    }

    if ($blt->save(
      $data
    )) {
      return redirect()->back()->with('message', ['msg' => 'Data Berhasil di simpan', 'alert' => 'success']);
    } else {
      return redirect()->back()->withinput()->with('message', ['msg' => 'Data Berhasil di simpan', 'alert' => 'success']);
    }
  }

  public function delete($id = 0)
  {
    if (!empty($id)) {
      $blt = new Blt();
      if ($blt->delete($id)) {
        return redirect()->back()->with('message', ['msg' => 'Data Berhasil di Hapus', 'alert' => 'success']);
      } else {
        return redirect()->back()->with('message', ['msg' => 'Data Gagal di Hapus', 'alert' => 'danger']);
      }
    }
  }
}
