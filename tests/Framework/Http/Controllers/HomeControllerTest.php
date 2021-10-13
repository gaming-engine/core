<?php

namespace GamingEngine\Core\Tests\Framework\Http\Controllers;

use GamingEngine\Core\Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * @test
     */
    public function home_controller_you_are_able_to_see_the_homepage()
    {
        // Arrange

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertSuccessful();
    }
}
