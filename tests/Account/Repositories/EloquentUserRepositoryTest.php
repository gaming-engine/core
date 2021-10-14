<?php

namespace GamingEngine\Core\Tests\Account\Repositories;

use GamingEngine\Core\Account\DataTransfer\UserDTO;
use GamingEngine\Core\Account\Entities\User;
use GamingEngine\Core\Account\Events\User\UserCreated;
use GamingEngine\Core\Account\Repositories\EloquentUserRepository;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;

class EloquentUserRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function eloquent_user_repository_is_able_to_find_the_user_by_id()
    {
        // Arrange
        User::factory()->create();
        $repository = app(EloquentUserRepository::class);

        // Act
        $user = $repository->find(1);

        // Assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->id);
    }

    /**
     * @test
     */
    public function eloquent_user_repository_returns_null_if_it_cannot_find_a_user()
    {
        // Arrange
        User::factory()->create();
        $repository = app(EloquentUserRepository::class);

        // Act
        $user = $repository->find(2);

        // Assert
        $this->assertNull($user);
    }

    /**
     * @test
     */
    public function eloquent_user_repository_creates_a_user()
    {
        // Arrange
        $details = new UserDTO([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ]);
        $repository = app(EloquentUserRepository::class);

        // Act
        $user = $repository->create($details);

        // Assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($details->name, $user->name);
        $this->assertEquals($details->email, $user->email);
        $this->assertNotEquals($details->password, $user->password);
    }

    /**
     * @test
     */
    public function eloquent_user_repository_firs_an_event_when_the_user_is_created()
    {
        // Arrange
        Event::fake();
        $details = new UserDTO([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ]);
        $repository = app(EloquentUserRepository::class);

        // Act
        $user = $repository->create($details);

        // Assert
        Event::assertDispatched(function (UserCreated $userCreated) use ($user) {
            return $user->id === $userCreated->user->id;
        });
    }
}
