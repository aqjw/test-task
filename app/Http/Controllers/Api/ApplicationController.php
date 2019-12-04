<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
     * Accept application
     * 
     * @param  \App\Models\Application  $application
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function accept(Application $application, Request $request)
    {
        $status = $this->application_repository->toAccept($application, $request);

        if ($status) {
            // send email to candidate
            SendMailAcceptApplication::dispatch($application);
        }

        // TODO: set correct status
        return response('', $status ? 200 : 400);
    }
}
