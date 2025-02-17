<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Statamic\Events\GlobalSetSaved;

class GlobalSetSavedListener implements ShouldQueue
{
    public function handle(GlobalSetSaved $event): void
    {
        if (config('statamic-github-workflow-dispatch.event-types.global-set')) {
            DispatchGithubWorkflowJob::dispatch();
        }
    }
}
