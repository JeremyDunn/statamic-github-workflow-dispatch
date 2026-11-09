<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Listeners;

use Statamic\Events\Event;
use Statamic\Events\EntrySaved;
use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntryListener implements ShouldQueue
{
    public function handle(Event $event): void
    {
        if (! config('statamic-github-workflow-dispatch.event-types.entry')) {
            return;
        }

        if ($this->isCascadedLocalizationSave($event)) {
            return;
        }

        DispatchGithubWorkflowJob::dispatch($event->entry->site()->handle());
    }

    /**
     * Saving an origin entry makes Statamic re-save each of its localizations,
     * firing EntrySaved for every site. Only the entry the user actually saved
     * (the initiator) should trigger a build, so the cascaded saves are skipped.
     */
    protected function isCascadedLocalizationSave(Event $event): bool
    {
        if (! $event instanceof EntrySaved || is_null($event->initiator)) {
            return false;
        }

        return ! $event->isInitial();
    }
}
