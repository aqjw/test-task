<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Repositories\ApplicationRepository;

class ApplicationController extends Controller
{
    public function __construct(ApplicationRepository $application_repository)
    {
        $this->application_repository = $application_repository;
    }

    /**
     * Reject application.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function to_reject(Application $application)
    {
        $this->application_repository->toReject($application);
        return back()->withMessage('Application successfully rejected');
    }
}
