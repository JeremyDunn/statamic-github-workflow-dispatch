<?php

return [
    'token' => env('GITHUB_TOKEN'),
    'owner' => env('GITHUB_OWNER'),
    'repo' => env('GITHUB_REPO'),
    'ref' => env('GITHUB_REF', 'main'),
    /**
     * If multisite is true, the affected site determines the ref value,
     * using the sites map below. Unmapped sites use their handle as the ref.
     */
    'multisite' => env('GITHUB_MULTISITE', false),
    'sites' => [
        // 'default' => 'main',
    ],
    'workflow_id' => env('GITHUB_WORKFLOW_ID'),
    'event-types' => [
        'collection' => true,
        'entry' => true,
        'form' => true,
        'global-set' => true,
        'nav' => true,
        'taxonomy' => true,
        'term' => true,
    ],
    'dispatch_workflows' => env('GITHUB_DISPATCH_WORKFLOWS', true),
];
