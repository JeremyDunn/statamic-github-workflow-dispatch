<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Statamic\Events\CollectionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;

class CollectionSavedListener implements ShouldQueue
{
    public function handle(CollectionSaved $event)
    {
        if (config('statamic-github-workflow-dispatch.event-types.collection')) {
            DispatchGithubWorkflowJob::dispatchForAllSites();
        }
    }
}
