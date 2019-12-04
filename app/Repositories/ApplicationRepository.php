<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApplicationRepository
{
    /**
     * Accept the job
     * 
     * @param  \App\Models\Application  $application
     * @param  \Illuminate\Http\Request $request
     * 
     * @return void
     */
    public function toAccept(Application $application, Request $request)
    {
        $application->status = Application::STATUS_ACCEPTED;
        $application->location = $request->location;
        $application->appointed_time = Carbon::parse($request->appointed_time);
        return $application->save();
    }
  
    /**
     * Reject the Application
     * 
     * @param  \App\Models\Application  $application
     * 
     * @return void
     */
    public function toReject(Application $application)
    {
        $application->status = Application::STATUS_REJECTED;
        $application->save();
    }

    /**
     * Store application
     * 
     * @param  \App\Models\Job  $job
     * @param  \Illuminate\Http\Request $request
     * 
     * @return void
     */
    public function store(Job $job, Request $request)
    {
        try {
            // TODO: make service for upload file
            $file_path = $request->file->store('public/applications');
            $job->applications()->create([
                'name' => $request->name,
                'email' => $request->email,
                'file' => str_replace('public/', '', $file_path),
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}