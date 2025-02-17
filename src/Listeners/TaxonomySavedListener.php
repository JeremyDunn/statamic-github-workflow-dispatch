<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Statamic\Events\TaxonomySaved;

class TaxonomySavedListener implements ShouldQueue
{
    public function handle(TaxonomySaved $event): void
    {
        if (config('statamic-github-workflow-dispatch.event-types.taxonomy')) {
            DispatchGithubWorkflowJob::dispatch();
        }
    }
}
