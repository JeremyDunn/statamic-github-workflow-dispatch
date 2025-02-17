<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use Statamic\Events\Event;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntryListener implements ShouldQueue
{
    public function handle(Event $event): void
    {
        if (config('statamic-github-workflow-dispatch.event-types.entry')) {
            DispatchGithubWorkflowJob::dispatch();
        }
    }
}
