<?php

/**
 * Vercel serverless entrypoint for the Laravel app.
 *
 * Vercel's function filesystem is read-only except for /tmp, and /tmp is
 * wiped between cold starts. So before booting Laravel we point all of its
 * writable paths (cache, sessions, compiled views, logs, uploaded files)
 * at /tmp. This lets the app boot on every request without crashing on
 * "storage/... not writable" errors. It does NOT make uploads or a
 * sqlite file persist across requests — see DEPLOY.md for why you need an
 * external database and file storage for real persistence.
 */

$tmp = '/tmp/eastaxis-storage';

$tmpBootstrap = $tmp.'/bootstrap-cache';

foreach ([
    $tmp,
    $tmp.'/app/public',
    $tmp.'/framework/cache/data',
    $tmp.'/framework/sessions',
    $tmp.'/framework/views',
    $tmp.'/logs',
    $tmpBootstrap,
] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
}

$_ENV['APP_STORAGE_PATH'] = $tmp;
putenv('APP_STORAGE_PATH='.$tmp);

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$app->useStoragePath($tmp);

// bootstrap/cache/*.php (packages.php, services.php, config.php, routes.php)
// also gets written at runtime by Laravel — that directory is read-only on
// Vercel too, so redirect it to /tmp as well.
$app->useBootstrapPath($tmpBootstrap);

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::capture();

$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);
