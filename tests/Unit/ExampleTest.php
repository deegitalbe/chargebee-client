<?php
namespace Deegitalbe\TrustupProAppCommon\Tests\Unit;

use Deegitalbe\ChargebeeClient\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class ExampleTest extends TestCase
{
    use InstallPackageTest;

    /**
     * @test
     */
    public function returning_true()
    {
        $this->assertTrue(true);
    }
}