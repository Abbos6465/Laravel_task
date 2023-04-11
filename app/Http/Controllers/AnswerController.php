<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{
    public function create(Application $application){
        $this->authorize('create',auth()->user());
        return view('answers.create')->with('application',$application);
    }

    public function store(Application $application,Request $request){
        $this->authorize('create',auth()->user());
        $request->validate(['body'=>'required|max:500']);

        $application->answer()->create([
            'body'=> $request->body,
        ]);

        return to_route('dashboard');
    }
}
