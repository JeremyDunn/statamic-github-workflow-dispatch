<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Statamic\Events\CollectionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;

class CollectionSavedListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  CollectionSaved  $event
     * @return void
     */
    public function handle(CollectionSaved $event)
    {
        DispatchGithubWorkflowJob::dispatch();
    }
}
