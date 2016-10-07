<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\HasRoles;
use App\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles.permissions')
            ->orderBy('name', 'asc')
            ->get();

        return $users;
    }

    public function roles($userId)
    {
        return User::with('roles.permissions')
            ->findOrFail($userId);
    }
}
