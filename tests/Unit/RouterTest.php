<?php

declare(strict_types = 1);

namespace Test\Unit;

use Framework\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase 
{
    /** @test */
    public function route_can_be_registered(): void
    {
        $router = new Router(); 
    }
}
