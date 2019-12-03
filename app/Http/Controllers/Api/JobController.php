<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Repositories\ApplicationRepository;
use App\Repositories\JobRepository;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(JobRepository $job_repository, ApplicationRepository $application_repository)
    {
        $this->job_repository = $job_repository;
        $this->application_repository = $application_repository;
    }

    /**
     * Get open jobs
     *
     * @return \Illuminate\Http\Response
     */
    public function get_open()
    {
        $jobs = $this->job_repository->getOpenPaginate();
        return response()->json($jobs->getCollection());
    }

    /**
     * Get job by id
     * 
     * @param  \App\Models\Job    $job
     * 
     * @return \Illuminate\Http\Response
     */
    public function get_job(Job $job)
    {
        return response()->json($job);
    }

    /**
     * Send application
     * 
     * @param  \App\Models\Job    $job
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function send_application(Job $job, Request $request)
    {
        $status = $this->application_repository->store($job, $request);

        // TODO: set correct status
        return response('', $status ? 200 : 400);
    }
}
