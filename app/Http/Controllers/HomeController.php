<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // return $request->user()->hasRole('admin');
        return Inertia::render('Home');
    }
}
