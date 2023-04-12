<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Application;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{
    public function create(Application $application){
        $this->authorize('create',auth()->user());
        return view('answers.create')->with('application',$application);
    }

    public function store(Application $application,StoreAnswerRequest $request){
        $this->authorize('create',auth()->user());


        $application->answer()->create([
            'body'=> $request->body,
        ]);

        return to_route('dashboard');
    }
}
