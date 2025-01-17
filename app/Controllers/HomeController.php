<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\View;

class HomeController extends \Framework\Controller
{
  public function index(): View
  {
    $data = [
      'test' => "this is data originating from the Home controller.",
    ];

    return $this->view('index', $data);
  }

  public function about(): View
  {
    return $this->view('about', ['about' => 'about text']);
  }

  public function contact(): View
  {
    return $this->view('contact');
  }
}
