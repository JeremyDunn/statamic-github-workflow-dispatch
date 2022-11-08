<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Http\Controllers\CP;

use Illuminate\Routing\Controller;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;

class GithubWorkflowDispatchUtilityController extends Controller
{
    public function index()
    {
        return view('statamic-github-workflow-dispatch::utility');
    }

    public function dispatch()
    {
        DispatchGithubWorkflowJob::dispatch();

        return back()->withSuccess(__('Workflow dispatched.'));
    }
}
