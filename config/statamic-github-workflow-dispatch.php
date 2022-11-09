<?php

return [
    'token' => env('GITHUB_TOKEN'),
    'owner' => env('GITHUB_OWNER'),
    'repo' => env('GITHUB_REPO'),
    'ref' => env('GITHUB_REF', 'main'),
    'workflow_id' => env('GITHUB_WORKFLOW_ID'),
    'dispatch_workflows' => env('GITHUB_DISPATCH_WORKFLOWS', true),
];
