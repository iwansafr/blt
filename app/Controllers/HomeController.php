<?php

namespace App\Controllers;

class HomeController extends BaseController
{
	public function index()
	{
		$db = \Config\Database::connect();
		$data = $db->table('users')->get();
		return view('home/index');
	}

	//--------------------------------------------------------------------

}
