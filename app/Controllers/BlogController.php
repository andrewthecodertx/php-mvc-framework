<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Models\BlogPost;
use Framework\Controller;
use Framework\View;

class BlogController extends Controller
{
	public function index(): View
	{
		$posts = new BlogPost;

		return $this->view('blog/index', ['posts' => $posts->get()]);
	}
}
