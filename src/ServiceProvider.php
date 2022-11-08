<?php

namespace DoeAnderson\StatamicGithubWorkflowDispatch;

use Statamic\Facades\Utility;
use Statamic\Providers\AddonServiceProvider;
use DoeAnderson\StatamicGithubWorkflowDispatch\Http\Controllers\CP\GithubWorkflowDispatchUtilityController;

class ServiceProvider extends AddonServiceProvider
{
    protected $listen = [
        \Statamic\Events\CollectionSaved::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\CollectionSavedListener::class,
        ],
        \Statamic\Events\EntryDeleted::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\EntryListener::class,
        ],
        \Statamic\Events\EntrySaved::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\EntryListener::class,
        ],
        \Statamic\Events\FormDeleted::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\FormListener::class,
        ],
        \Statamic\Events\FormSaved::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\FormListener::class,
        ],
        \Statamic\Events\GlobalSetSaved::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\GlobalSetSavedListener::class,
        ],
        \Statamic\Events\NavSaved::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\NavSavedListener::class,
        ],
        \Statamic\Events\TaxonomySaved::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\TaxonomySavedListener::class,
        ],
        \Statamic\Events\TermDeleted::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\TermListener::class,
        ],
        \Statamic\Events\TermSaved::class => [
            \DoeAnderson\StatamicGithubWorkflowDispatch\Listeners\TermListener::class,
        ],
    ];

    public function bootAddon()
    {
        Utility::make('statamic-github-workflow-dispatch-utility')
            ->title('GitHub Workflow Dispatch')
            ->description('Manually dispatch the GitHub Workflow.')
            ->icon('git')
            ->routes(function ($router) {
                $router->get('/', [GithubWorkflowDispatchUtilityController::class, 'index'])->name('index');
                $router->post('/', [GithubWorkflowDispatchUtilityController::class, 'dispatch'])->name('dispatch');
            })
            ->register();
    }
}
