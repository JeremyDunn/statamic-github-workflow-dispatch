<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DispatchGithubWorkflowJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {

        if (! config('github-workflow-dispatch.dispatch_workflows')) {
            return;
        }

        if (is_null(config('github-workflow-dispatch.token'))) {
            return;
        }

        if (is_null(config('github-workflow-dispatch.owner'))) {
            return;
        }

        if (is_null(config('github-workflow-dispatch.repo'))) {
            return;
        }

        if (is_null(config('github-workflow-dispatch.workflow_id'))) {
            return;
        }

        if (is_null(config('github-workflow-dispatch.ref'))) {
            return;
        }

        Http::withToken(config('github-workflow-dispatch.token'))
            ->post('https://api.github.com/repos/'. config('github-workflow-dispatch.owner') . '/'. config('github-workflow-dispatch.repo') . '/actions/workflows/'. config('github-workflow-dispatch.workflow_id') . '/dispatches', [
                'ref' => config('github-workflow-dispatch.ref'),
            ]);
    }
}
