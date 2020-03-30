<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Jobs\Job;
use Illuminate\Support\Facades\DB;
use App\ModelJob;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Cache;

class JobController extends Controller
{

    
    public function index(){
        $jobs = Cache::remember('users', Carbon::now()->addMinutes(5), function() // adds cache
        {
            return ModelJob::all();
        });

        return $jobs;
    }

    public function store(){
        $emailJob = new Job();
        $id= app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($emailJob);
        $json['jobId']=$id;
        $json['description']= "Job created successfully";
        return response()->json( $json, 201);
    }

    public function update(Request $request,$id){
        $job= ModelJob::find($id);
        $job->update($request->all());
        $job->save();
        return response()->json(null,204);
    }

    public function show($id){
        $job=  ModelJob::find($id);
        return $job; 
    }

    public function destroy($id){
        ModelJob::destroy($id);
        return response()->json(null,204);
    }

}