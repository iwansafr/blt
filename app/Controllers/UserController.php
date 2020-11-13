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
    return view('user/index', ['data' => $data, 'role' => $user->role()]);
  }
  public function edit($id = 0)
  {
    session();
    $data = [];
    $user = new User();
    if (!empty($id)) {
      $data = $user->find($id);
    }
    return view('user/edit', ['validation' => \Config\Services::validation(), 'data' => $data, 'role' => $user->role()]);
  }
  public function update($id = 0)
  {
    helper('system');
    $data = [
      'username' => $this->request->getPost('username'),
      'password' => encrypt($this->request->getPost('password')),
      'role' => $this->request->getPost('role'),
    ];
    if ($this->request->getMethod() == 'post') {
      $user = new User();
    } else if ($this->request->getMethod() == 'put') {
      $user = new User();
      $user_data = $user->find($id);
      $data['id'] = $user_data['id'];
    }
    if (!$this->validate([
      // 'username' => 'required|is_unique[users.username,id,' . $id . ']',
      // 'password' => 'required'
      'username' => [
        'label' => 'Username',
        'rules' => 'required|is_unique[users.username,id,' . $id . ']',
        'errors' => [
          'required' => '{field} Tidak Boleh Kosong',
          'is_unique' => '{field} Sudah Ada',
        ]
      ],
      'password' => [
        'label' => 'Password',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Tidak Boleh Kosong',
        ]
      ],
    ])) {
      // $validation = \Config\Services::validation();
      // return redirect()->back()->withinput()->with('validation', $validation);
      return redirect()->to('user/edit')->withinput();
    }

    if ($user->save(
      $data
    )) {
      return redirect()->back('user/edit')->with('message', ['msg' => 'Data Berhasil di simpan', 'alert' => 'success']);
    } else {
      return redirect()->back('user/edit')->withinput()->with('message', ['msg' => 'Data Berhasil di simpan', 'alert' => 'success']);
    }
  }

  public function delete($id = 0)
  {
    if (!empty($id)) {
      $user = new User();
      if ($user->delete($id)) {
        return redirect()->to('user/list')->with('message', ['msg' => 'Data Berhasil di Hapus', 'alert' => 'success']);
      } else {
        return redirect()->to('user/list')->with('message', ['msg' => 'Data Gagal di Hapus', 'alert' => 'danger']);
      }
    }
  }
  public function login()
  {
    return view('user/login', ['validation' => \Config\Services::validation()]);
  }
  public function auth()
  {
    helper('system');
    if (!$this->validate([
      'username' => 'required',
      'password' => 'required'
    ])) {
      return redirect()->to('login')->withInput();
    }
    $data = $this->request->getPost();
    $user = new User();
    $user = $user->where(['username' => $data['username']])->first();
    if (!empty($user)) {
      if (decrypt($data['password'], $user['password'])) {
        $data['logged_in'] = TRUE;
        session()->set($data);
        return redirect()->to('/')->withInput()->with('message', ['msg' => 'Welcome to BLT APP', 'alert' => 'success']);
      } else {
        return redirect()->to('login')->withInput()->with('message', ['msg' => 'Password is not Valid', 'alert' => 'danger']);
      }
    } else {
      return redirect()->to('login')->withInput()->with('message', ['msg' => 'Username is not Registered', 'alert' => 'danger']);
    }
  }
}
