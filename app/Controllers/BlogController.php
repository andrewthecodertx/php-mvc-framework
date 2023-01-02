<?php namespace App\Controllers;

use App\Models\BlogPost;
use Framework\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $posts = new BlogPost;
        
        return $this->view('blog/index', ['posts' => $posts->get()]);
    }
}