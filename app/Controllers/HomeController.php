<?php namespace App\Controllers;

use Framework\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = ['test' => "some text"];

        return $this->view('index', $data);
    }

    public function about()
    {
        return $this->view('about');
    }

    public function contact()
    {
        return $this->view('contact');
    }
}