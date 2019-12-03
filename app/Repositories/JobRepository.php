<?php

namespace App\Repositories;

use App\Models\Job;
use Illuminate\Http\Request;

class JobRepository
{
    /**
     * Get all jobs with pagination
     * 
     * @param  integer $per_page
     * 
     * @return collection
     */
    public function getAllPaginate($per_page = 10)
    {
        return Job::orderByDesc('created_at')
            ->withCount('applications')->paginate($per_page);
    }

    /**
     * Get all open jobs with pagination
     * 
     * @param  integer $per_page
     * 
     * @return collection
     */
    public function getOpenPaginate($per_page = 10)
    {
        return Job::orderByDesc('created_at')
            ->open()->paginate($per_page);
    }

    /**
     * Store job
     * 
     * @param  \App\Http\Requests\Job\CreateRequest  $request
     * 
     * @return void
     */
    public function store($request)
    {
        Job::create($request->all());
    }

    /**
     * Update job
     * 
     * @param  \App\Models\Job  $job
     * @param  \App\Http\Requests\Job\UpdateRequest  $request
     * 
     * @return void
     */
    public function update($job, $request)
    {
        $job->update($request->all());
    }

    /**
     * Open the job
     * 
     * @param  \App\Models\Job  $job
     * 
     * @return void
     */
    public function toOpen(Job $job)
    {
        $job->status = Job::STATUS_OPEN;
        $job->save();
    }

    /**
     * Close the job
     * 
     * @param  \App\Models\Job  $job
     * 
     * @return void
     */
    public function toClose(Job $job)
    {
        $job->status = Job::STATUS_CLOSED;
        $job->save();
    }
}