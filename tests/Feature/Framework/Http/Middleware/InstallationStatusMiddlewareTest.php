<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Http\Middleware;

use GamingEngine\Core\Core;
use GamingEngine\Core\Framework\Http\Middleware\InstallationStatusMiddleware;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class InstallationStatusMiddlewareTest extends TestCase
{
    /**
     * @test
     */
    public function allows_you_through_if_the_framework_is_installed()
    {
        // Arrange
        $core = $this->mock(Core::class);
        $core->shouldReceive('installed')
            ->andReturn(true);
        $middleware = new InstallationStatusMiddleware($core);
        $executed = false;

        // Act
        $middleware->handle(
            $this->mock(Request::class),
            function () use (&$executed) {
                $executed = true;
            }
        );

        // Assert
        $this->assertTrue($executed);
    }

    /**
     * @test
     */
    public function redirects_you_to_an_internal_installation_route_if_no_route_is_provided()
    {
        // Arrange
        $core = $this->mock(Core::class);
        $core->shouldReceive('installed')
            ->andReturn(false);

        URL::shouldReceive('route')
            ->withSomeOfArgs('installation-required')
            ->andReturn('installation-required');
        URL::shouldReceive('to')
            ->withSomeOfArgs('installation-required')
            ->andReturn('bar');

        URL::shouldReceive('getRequest')
            ->andReturn($this->mock(Request::class));

        Route::shouldReceive('has')
            ->withSomeOfArgs('install.index')
            ->andReturn(false);

        $middleware = new InstallationStatusMiddleware($core);

        // Act
        $result = $middleware->handle(
            $this->mock(Request::class),
            function () {
            }
        );

        // Assert
        $this->assertEquals('bar', $result->getTargetUrl());
        $this->assertEquals(302, $result->getStatusCode());
    }

    /**
     * @test
     */
    public function redirects_you_to_an_external_installation_route_if_provided()
    {
        // Arrange
        $core = $this->mock(Core::class);
        $core->shouldReceive('installed')
            ->andReturn(false);

        URL::shouldReceive('route')
            ->withSomeOfArgs('install.index')
            ->andReturn('install-index');
        URL::shouldReceive('to')
            ->withSomeOfArgs('install-index')
            ->andReturn('foo');

        URL::shouldReceive('getRequest')
            ->andReturn($this->mock(Request::class));

        Route::shouldReceive('has')
            ->withSomeOfArgs('install.index')
            ->andReturn(true);

        $middleware = new InstallationStatusMiddleware($core);

        // Act
        /**
         * @var RedirectResponse $result
         */
        $result = $middleware->handle(
            $this->mock(Request::class),
            function () {
            }
        );

        // Assert
        $this->assertEquals('foo', $result->getTargetUrl());
        $this->assertEquals(302, $result->getStatusCode());
    }
}
