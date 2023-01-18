<?php

declare(strict_types = 1);

namespace App\Controllers;

use Framework\Controller;
use Framework\View;

class HomeController extends Controller
{
	public function index(): View
	{
		$data = ['test' => "some text"];

		return $this->view('index', $data);
	}

	public function about(): View
	{
		return $this->view('about');
	}

	public function contact(): View
	{
		return $this->view('contact');
	}
}
