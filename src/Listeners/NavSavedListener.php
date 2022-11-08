<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Statamic\Events\NavSaved;

class NavSavedListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \Statamic\Events\NavSaved $event
     * @return void
     */
    public function handle(NavSaved $event): void
    {
        DispatchGithubWorkflowJob::dispatch();
    }
}
