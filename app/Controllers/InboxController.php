<?php

namespace App\Controllers;

use App\Models\Inbox;

class InboxController extends BaseController
{
  public function list($tipe = 0)
  {
    $inbox = new Inbox();
    if ($tipe == 1) {
      return view('inbox/list', ['title' => 'Saran', 'data' => $inbox->where('tipe', 1)->find()]);
    } else if ($tipe = 2) {
      return view('inbox/list', ['title' => 'Masukkan', 'data' => $inbox->where('tipe', 2)->find()]);
    } else if ($tipe = 3) {
      return view('inbox/list', ['title' => 'Pertanyaan']);
    }
  }
  public function inboxin($tipe = 0)
  {
    $inbox = new Inbox();
    $post = [
      'nama' => $this->request->getPost('nama'),
      'hp' => $this->request->getPost('hp'),
      'email' => $this->request->getPost('email'),
      'pesan' => $this->request->getPost('pesan'),
      'tipe' => $tipe,
    ];
    if ($tipe == 1) {
      if ($inbox->save($post)) {
        return redirect()->to('/saran')->with('message', ['msg' => 'Saran Berhasil dikirim', 'alert' => 'success']);
      } else {
        return redirect()->to('/saran')->with('message', ['msg' => 'Saran Gagal dikirim', 'alert' => 'danger']);
      }
    } else if ($tipe = 2) {
      if ($inbox->save($post)) {
        return redirect()->to('/masukan')->with('message', ['msg' => 'Saran Berhasil dikirim', 'alert' => 'success']);
      } else {
        return redirect()->to('/masukan')->with('message', ['msg' => 'Saran Gagal dikirim', 'alert' => 'danger']);
      }
    } else if ($tipe = 3) {
      return view('inbox/list', ['title' => 'Pertanyaan']);
    }
  }
}