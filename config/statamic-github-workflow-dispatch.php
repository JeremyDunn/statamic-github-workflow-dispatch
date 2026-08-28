<?php

return [
    'token' => env('GITHUB_TOKEN'),
    'owner' => env('GITHUB_OWNER'),
    'repo' => env('GITHUB_REPO'),
    'ref' => env('GITHUB_REF', 'main'),
    /**
     * If multisite is true, the affected site is sent to the workflow as a
     * `site` input, using the sites map below. Unmapped sites use their
     * handle as the input value. The ref above is always used as the ref
     * and must be a real branch or tag.
     */
    'multisite' => env('GITHUB_MULTISITE', false),
    'sites' => [
        // 'default' => 'default-site-input-value',
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
