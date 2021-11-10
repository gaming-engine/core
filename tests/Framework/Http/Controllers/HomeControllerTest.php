<?php

namespace GamingEngine\Core\Tests\Framework\Http\Controllers;

use GamingEngine\Core\Core;
use GamingEngine\Core\Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * @test
     */
    public function home_controller_you_are_able_to_see_the_homepage()
    {
        // Arrange
        $this->withoutMix();

        $installationStatus = $this->mock(Core::class);
        $installationStatus->shouldReceive('installed')
            ->andReturnTrue();

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertSuccessful();
    }
}
