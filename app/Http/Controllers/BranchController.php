<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function dashboard()
    {
        return view('branch.dashboard');
    }
}
