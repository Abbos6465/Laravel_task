<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Jobs\SendEmailJob;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;


class ApplicationController extends Controller
{
    public function index(){
        $this->authorize('index',auth()->user());
        return view('applications.index',['applications'=>auth()->user()->applications()->latest()->paginate(5)]);
    }

    public function store(StoreApplicationRequest $request){
        if($this->checkDate()){
          return  redirect()->back()->with('error',"You can create only 1 application a day");
        }
        else{

        if($request->hasFile('file')){
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files',$name,'public');
        }

        $application = Application::create([
            "user_id" => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null
        ]);

        dispatch(new SendEmailJob($application));

        return to_route('application.index');
    }
    }

    public function answer(){

    }

    protected function checkDate(){
        
        $last_application = auth()->user()->applications->last();

        if($last_application==null){
            return false;
        }

        $last_app_date = Carbon::parse($last_application->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if($last_app_date == $today){
            return true;
        }
        else{
            return false;
        }
    }
}
