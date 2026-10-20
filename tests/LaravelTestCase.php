<?php

namespace Porro\Tests;

use Orchestra\Testbench\TestCase;
use Porro\Laravel\PorroServiceProvider;

abstract class LaravelTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [PorroServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('cache.default', 'array');
        $app['config']->set('porro.url', 'https://porro.test');
    }
}
