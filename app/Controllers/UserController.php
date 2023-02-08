<?php

declare(strict_types = 1);

namespace App\Controllers;

use Framework\Controller;
use Framework\View;
use App\Models\User;

class UserController extends Controller
{
	public function index(): View {
		$users = new User;

        // return json_encode($users->get());
		return $this->view('user/index', ['users' => $users->get()]);
	}
    
    public function show(): View {
        return $this->view('user/profile');
    }
}
