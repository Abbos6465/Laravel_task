<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard(){
        return view('dashboard')->with(['applications'=>Application::latest()->paginate(5   )]);
    }

    public function main(){
        return to_route('dashboard');
    }
}
