<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin.dashboard.admin');
    }

    public function  create()
    {
        $testtt = "Hello laravel 11";

        return view('admin.create', compact('testtt'));
    }
}
