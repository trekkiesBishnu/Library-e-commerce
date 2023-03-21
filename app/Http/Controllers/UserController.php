<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function index(){
        $user=User::all();
        return view('admin.user.user',compact('user'));

    }
}
