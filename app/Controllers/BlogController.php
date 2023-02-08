<?php

declare(strict_types = 1);

namespace App\Controllers;

use Framework\Controller;
use Framework\View;
use App\Models\BlogPost;

class BlogController extends Controller
{
	public function index(): View {
		$posts = new BlogPost;

        // return json_encode($posts->get());
		return $this->view('blog/index', ['posts' => $posts->get()]);
	}
    
    public function show(): View {
        return $this->view('blog/article');
    }
}
