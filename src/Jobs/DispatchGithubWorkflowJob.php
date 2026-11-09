<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Statamic\Facades\Site;

class DispatchGithubWorkflowJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected ?string $siteHandle = null) {}

    /**
     * For changes that aren't tied to a single site. In multisite mode
     * this dispatches one job per site, otherwise a single job.
     */
    public static function dispatchForAllSites(): void
    {
        if (! config('statamic-github-workflow-dispatch.multisite')) {
            static::dispatch();

            return;
        }

        Site::all()->each(fn ($site) => static::dispatch($site->handle()));
    }

    public function handle(): void
    {

        if (! config('statamic-github-workflow-dispatch.dispatch_workflows')) {
            return;
        }

        if (is_null(config('statamic-github-workflow-dispatch.token'))) {
            return;
        }

        if (is_null(config('statamic-github-workflow-dispatch.owner'))) {
            return;
        }

        if (is_null(config('statamic-github-workflow-dispatch.repo'))) {
            return;
        }

        if (is_null(config('statamic-github-workflow-dispatch.workflow_id'))) {
            return;
        }

        if (is_null(config('statamic-github-workflow-dispatch.ref'))) {
            return;
        }

        $payload = ['ref' => config('statamic-github-workflow-dispatch.ref')];

        if ($site = $this->siteInput()) {
            $payload['inputs'] = ['site' => $site];
        }

        Http::withToken(config('statamic-github-workflow-dispatch.token'))
            ->post('https://api.github.com/repos/'.config('statamic-github-workflow-dispatch.owner').'/'.config('statamic-github-workflow-dispatch.repo').'/actions/workflows/'.config('statamic-github-workflow-dispatch.workflow_id').'/dispatches', $payload);
    }

    /**
     * The ref must be a real branch or tag, so in multisite mode the
     * affected site is passed as a `site` workflow input instead.
     */
    protected function siteInput(): ?string
    {
        if (config('statamic-github-workflow-dispatch.multisite') && $this->siteHandle) {
            return static::inputForSite($this->siteHandle);
        }

        return null;
    }

    /**
     * The `site` input value for a site handle, using the configured sites
     * map or falling back to the handle itself.
     */
    public static function inputForSite(string $siteHandle): string
    {
        return config("statamic-github-workflow-dispatch.sites.{$siteHandle}", $siteHandle);
    }
}
