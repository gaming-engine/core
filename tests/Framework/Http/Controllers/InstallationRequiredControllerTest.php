<?php

namespace GamingEngine\Core\Tests\Framework\Http\Controllers;

use GamingEngine\Core\Core;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class InstallationRequiredControllerTest extends TestCase
{
    /**
     * @test
     */
    public function you_are_able_to_see_details_that_talk_about_installing_if_not_installed()
    {
        // Arrange
        $this->mock(Core::class)
            ->shouldReceive('installed')
            ->andReturn(false);

        // Act
        $response = $this->get(route('installation-required'));

        // Assert
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function should_be_redirected_to_the_homepage_if_installed()
    {
        // Arrange
        $this->mock(Core::class)
            ->shouldReceive('installed')
            ->andReturn(true);

        // Act
        $response = $this->get(route('installation-required'));

        // Assert
        $response->assertRedirect('/');
    }

    /**
     * @test
     */
    public function should_be_redirected_to_the_installer_if_it_exists()
    {
        // Arrange
        $this->mock(Core::class)
            ->shouldReceive('installed')
            ->andReturn(false);

        Route::name('install.index')
            ->get('/install', fn () => 'Testing');

        // Act
        $response = $this->get(route('installation-required'));

        // Assert
        $response->assertRedirect('/install');
    }
}
