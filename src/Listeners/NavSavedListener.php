<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Statamic\Events\Event;
use Statamic\Events\NavSaved;
use Statamic\Events\NavTreeSaved;

class NavSavedListener implements ShouldQueue
{
    public function handle(Event $event): void
    {
        if (config('statamic-github-workflow-dispatch.event-types.nav')) {
            if ($event instanceof NavTreeSaved) {
                DispatchGithubWorkflowJob::dispatch($event->tree->site()->handle());
            } else {
                DispatchGithubWorkflowJob::dispatchForAllSites();
            }
        }
    }
}
