@extends('statamic::layout')
@section('title', __('GitHub Workflow Dispatch'))

@php
    $sitesError = $errors->first('sites') ?: $errors->first('sites.*');
@endphp

@section('content')
    <ui-header title="{{ __('GitHub Workflow Dispatch') }}" icon="git"></ui-header>

    <form method="POST" action="{{ cp_route('utilities.statamic-github-workflow-dispatch-utility.dispatch') }}">
        @csrf

        <ui-panel
            heading="{{ __('Manual dispatch') }}"
            subheading="{{ __('Trigger the GitHub Actions workflow without saving content.') }}"
        >
            <ui-card>
                @if ($multisite)
                    <ui-field
                        label="{{ __('Sites') }}"
                        instructions="{{ __('Each selected site dispatches its own workflow run.') }}"
                        @if ($sitesError) error="{{ $sitesError }}" @endif
                    >
                        <div class="space-y-2">
                            @foreach ($sites as $site)
                                <ui-checkbox
                                    name="sites[]"
                                    value="{{ $site->handle() }}"
                                    label="{{ $site->name() }}"
                                    description="{{ __('Workflow input: :input', ['input' => $siteInputs[$site->handle()]]) }}"
                                ></ui-checkbox>
                            @endforeach
                        </div>
                    </ui-field>
                @else
                    <ui-description text="{{ __('Dispatches the workflow using the configured ref.') }}"></ui-description>
                @endif
            </ui-card>

            <ui-panel-footer>
                <ui-button type="submit" variant="primary" text="{{ __('Dispatch') }}"></ui-button>
            </ui-panel-footer>
        </ui-panel>
    </form>
@stop
