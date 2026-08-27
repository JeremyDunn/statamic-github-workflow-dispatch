# Statamic GitHub Workflow Dispatch

Github Workflow Dispatch is a Statamic addon that makes it easy to run GitHub Actions workflows via Repository Dispatch Events.

## Features

This addon creates a [repository dispatch event](https://docs.github.com/en/rest/reference/repos#create-a-repository-dispatch-event) on GitHub to trigger a GitHub actions workflow.

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require doeanderson/statamic-github-workflow-dispatch
```

## How to Use

Configure the addon through your `.env`:

``` dotenv
GITHUB_TOKEN=your-token
GITHUB_OWNER=your-org
GITHUB_REPO=your-repo
GITHUB_WORKFLOW_ID=deploy.yml
GITHUB_REF=main
GITHUB_DISPATCH_WORKFLOWS=true
GITHUB_MULTISITE=false
```

When a configured Statamic event fires (entry, term, nav, global set, collection, taxonomy, or form changes), the addon dispatches the GitHub Actions workflow using `GITHUB_REF` as the ref. You can also trigger it manually from the GitHub Workflow Dispatch utility in the control panel.

### Multisite

Set `GITHUB_MULTISITE=true` to pass the affected site to the workflow as a `site` input. The ref is always `GITHUB_REF` and must be a real branch or tag. Map site handles to input values in the published config:

``` php
'sites' => [
    'default' => 'main-site',
    'french' => 'french-site',
],
```

Sites not in the map use their handle as the input value. Your workflow must declare the input:

``` yaml
on:
  workflow_dispatch:
    inputs:
      site:
        required: true
        type: string
``` Events that aren't tied to a single site (collections, taxonomies, terms, forms, global sets, blueprint saves, and the manual utility dispatch) dispatch the workflow once per site.

You can also publish the config file to toggle individual event types:

``` bash
php artisan vendor:publish --tag=statamic-github-workflow-dispatch-config
```
