<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use Statamic\Events\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;

class FormListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \Statamic\Events\FormSaved|\Statamic\Events\FormDeleted  $event
     * @return void
     */
    public function handle(Event $event): void
    {
        DispatchGithubWorkflowJob::dispatch();
    }
}
