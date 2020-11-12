<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
  public function __construct()
  {
    helper('form');
  }
  public function index()
  {
    $user = new User();
    $data = $user->findAll();
    return view('user/index', ['data' => $data]);
  }
  public function edit($id = 0)
  {
    session();
    $data = [];
    if (!empty($id)) {
      $user = new User();
      $data = $user->find($id);
    }
    return view('user/edit', ['validation' => \Config\Services::validation(), 'data' => $data]);
  }
  public function update($id = 0)
  {
    helper('system');
    if ($this->request->getMethod() == 'post') {
      $user = new User();
      $data = [
        'username' => $this->request->getPost('username'),
        'password' => encrypt($this->request->getPost('password')),
        'role' => $this->request->getPost('role'),
      ];
    } else if ($this->request->getMethod() == 'put') {
      $user = new User();
      $user_data = $user->find($id);
      $data = [
        'id' => $user_data['id'],
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

    if ($user->save(
      $data
    )) {
      return redirect()->back()->with('message', ['msg' => 'Data Berhasil di simpan', 'alert' => 'success']);
    } else {
      return redirect()->back()->withinput()->with('message', ['msg' => 'Data Berhasil di simpan', 'alert' => 'success']);
    }
  }
}
