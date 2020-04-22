<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->prepareForTests();
    }
    private function prepareForTests()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }
    public function tearDown(): void
    {
        parent::tearDown();
    }
}
