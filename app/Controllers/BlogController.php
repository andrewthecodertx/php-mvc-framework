<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\Controller;
use Framework\Http\Request;
use Framework\View;
use App\Models\BlogPost;

class BlogController extends Controller
{
  public function index(): View
  {
    $posts = new BlogPost;

    // return json_encode($posts->get());
    return $this->view('blog/index', ['posts' => $posts->get()]);
  }

  /**
   * Show blog article by slug
   *
   * @param Request $request the http request object
   * @param array $params an assoc array containing 'where' information
   */
  public function show(Request $request, array $params): View
  {
    $slug = $params['slug'];
    $post = new BlogPost;

    return $this->view('blog/article', ['post' => $post->get(['slug', $slug])]);
  }
}
