<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\Controller;
use Framework\Request;
use Framework\View;
use App\Models\User;

class UserController extends Controller
{
	public function index(): View
	{
		$users = new User;

		// return json_encode($users->get());
		return $this->view('user/index', ['users' => $users->get()]);
	}

	/**
	 * Show user by id
	 *
	 * @param Request $request the http request object
	 * @param array $params an assoc array containing 'where' information
	 */
	public function show(Request $request, $params): View
	{
		$id = $params['id'];
		$user = new User;

		return $this->view('user/profile', ['user' => $user->get(['id', $id])]);
	}
}
