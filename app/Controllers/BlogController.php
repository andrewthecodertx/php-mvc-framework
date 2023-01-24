<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Models\BlogPost;
use Framework\Controller;
use Framework\View;
use Framework\Request;

class BlogController extends Controller
{
	public function index(Request $request): View
	{
		$posts = new BlogPost;

        // return json_encode($posts->get());
		return $this->view('blog/index', ['posts' => $posts->get()]);
	}
    
    public function getblog(Request $request): View
    {
        return $this->view('blog/article');
        
    }

}
