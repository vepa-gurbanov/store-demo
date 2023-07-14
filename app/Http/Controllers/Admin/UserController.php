<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('id')->get();
        $data = [
            'pageName' => 'Users',
            'users' => $users,
        ];
        return view('admin.users.index')
            ->with($data);
    }
}
