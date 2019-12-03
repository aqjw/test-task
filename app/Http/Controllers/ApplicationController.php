<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailAcceptApplication;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct(ApplicationRepository $application_repository)
    {
        $this->application_repository = $application_repository;
    }

    /**
     * Accept application.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function to_accept(Application $application)
    {
        $this->application_repository->toAccept($application);

        // send email to candidate
        SendMailAcceptApplication::dispatch($application);

        return back()->withMessage('Application successfully accepted');
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
