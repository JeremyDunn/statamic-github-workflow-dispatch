<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use Statamic\Events\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;

class TermListener implements ShouldQueue
{
    public function handle(Event $event): void
    {
        if (config('statamic-github-workflow-dispatch.event-types.term')) {
            DispatchGithubWorkflowJob::dispatch();
        }
    }
}
