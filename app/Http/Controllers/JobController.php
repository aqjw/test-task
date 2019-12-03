<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\UpdateRequest;
use App\Http\Requests\Job\CreateRequest;
use App\Models\Job;
use App\Repositories\JobRepository;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(JobRepository $job_repository)
    {
        $this->job_repository = $job_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = $this->job_repository->getAllPaginate();
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Job\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $this->job_repository->store($request);
        return redirect()->route('jobs.index')->withMessage('Job successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $job->load('applications');
        return view('admin.jobs.view', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Job\UpdateRequest  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Job $job)
    {
        $this->job_repository->update($job, $request);
        return redirect()->route('jobs.index')->withMessage('Job successfully updated');
    }

    /**
     * Open job.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function to_open(Job $job)
    {
        $this->job_repository->toOpen($job);
        return back()->withMessage('Job successfully opened');
    }

    /**
     * Close job.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function to_close(Job $job)
    {
        $this->job_repository->toClose($job);
        return back()->withMessage('Job successfully closed');
    }
}
