<?php

declare(strict_types = 1);

namespace App\Models;

use Framework\Model;

class User extends Model
{
	protected $table = 'users';
	protected array $fields = ['fname', 'lname', 'email', 'password'];
}
