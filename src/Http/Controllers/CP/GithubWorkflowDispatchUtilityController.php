<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch\Http\Controllers\CP;

use DoeAnderson\StatamicGithubWorkflowDispatch\Jobs\DispatchGithubWorkflowJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Statamic\Facades\Site;

class GithubWorkflowDispatchUtilityController extends Controller
{
    public function index(): View
    {
        return view('statamic-github-workflow-dispatch::utility', [
            'multisite' => $this->isMultisite(),
            'sites' => Site::all()->values(),
            'siteInputs' => Site::all()->mapWithKeys(fn ($site) => [
                $site->handle() => DispatchGithubWorkflowJob::inputForSite($site->handle()),
            ]),
        ]);
    }

    public function dispatch(Request $request): RedirectResponse
    {
        if (! $this->isMultisite()) {
            DispatchGithubWorkflowJob::dispatch();

            return back()->withSuccess(__('Workflow dispatched.'));
        }

        $validated = $request->validate([
            'sites' => ['required', 'array', 'min:1'],
            'sites.*' => ['string', Rule::in(Site::all()->map->handle()->all())],
        ], [
            'sites.required' => __('Select at least one site to dispatch.'),
            'sites.*.in' => __('One of the selected sites does not exist.'),
        ]);

        $siteHandles = collect($validated['sites'])->unique()->values();

        $siteHandles->each(fn (string $siteHandle) => DispatchGithubWorkflowJob::dispatch($siteHandle));

        $siteNames = $siteHandles->map(fn (string $siteHandle) => Site::get($siteHandle)->name())->join(', ');

        return back()->withSuccess(__('Workflow dispatched for :sites.', ['sites' => $siteNames]));
    }

    protected function isMultisite(): bool
    {
        return (bool) config('statamic-github-workflow-dispatch.multisite');
    }
}
