<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Statamic\Events\BlueprintSaved;

class BlueprintSavedListener implements ShouldQueue
{
    public function handle(BlueprintSaved $event): void
    {
        if ($event->blueprint->namespace() === 'forms' && config('statamic-github-workflow-dispatch.event-types.form')) {
            DispatchGithubWorkflowJob::dispatch();
        }
    }
}
