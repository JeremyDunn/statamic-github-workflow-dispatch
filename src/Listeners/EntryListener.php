<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use Statamic\Events\Event;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntryListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \Statamic\Events\EntrySaved|\Statamic\Events\EntryDeleted  $event
     * @return void
     */
    public function handle(Event $event): void
    {
        if (config('statamic-github-workflow-dispatch.event-types.entry')) {
            DispatchGithubWorkflowJob::dispatch();
        }
    }
}
