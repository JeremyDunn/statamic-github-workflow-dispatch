@extends('statamic::layout')
@section('title', __('Github Workflow Dispatch'))

@section('content')
    <div class="flex items-center justify-between">
        <h1>{{ __('Github Workflow Dispatch') }}</h1>
    </div>

    <div class="mt-3 card">
        <p class="mb-2">Click "Dispatch" to manually dispatch the workflow.</p>

        <form method="POST" action="{{ cp_route('utilities.statamic-github-workflow-dispatch-utility.dispatch') }}">
            @csrf
            <button class="btn-primary">{{ __('Dispatch') }}</button>
        </form>
    </div>
@stop
