<?php

namespace GamingEngine\Core\Tests\Framework\Listeners\Migrations;

use GamingEngine\Core\Framework\Entities\FrameworkMigration;
use GamingEngine\Core\Framework\Listeners\Migrations\LogPackageMigration;
use GamingEngine\Core\Framework\Migrations\CoreMigration;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Mockery\MockInterface;

class LogPackageMigrationTest extends TestCase
{
    /**
     * @test
     */
    public function ensures_that_it_will_only_handle_framework_migrations()
    {
        // Arrange
        $initialCount = FrameworkMigration::count();

        $migration = $this->spy(
            Migration::class,
            function (MockInterface $mock) {
                $mock->shouldNotReceive('filename');
                $mock->shouldNotReceive('package');
            }
        );
        $handler = new LogPackageMigration();

        // Act
        $handler->handle(new MigrationEnded(
            $migration,
            'up'
        ));

        // Assert
        $this->assertDatabaseCount(FrameworkMigration::class, $initialCount);
    }

    /**
     * @test
     */
    public function ensures_that_it_will_handle_framework_migrations_when_applying_changes()
    {
        // Arrange
        $migration = $this->spy(
            CoreMigration::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('filename')
                    ->andReturn('foo');
                $mock->shouldReceive('package')
                    ->andReturn('bar');
            }
        );
        $handler = new LogPackageMigration();

        // Act
        $handler->handle(new MigrationEnded(
            $migration,
            'up'
        ));

        // Assert
        $this->assertDatabaseHas(FrameworkMigration::class, [
            'migration' => 'foo',
            'module_name' => 'bar',
        ]);
    }

    /**
     * @test
     */
    public function ensures_that_it_will_handle_framework_migrations_when_remove_changes_works_without_the_logging_table(
    ) {
        // Arrange
        Schema::drop('framework_migrations');

        $migration = $this->spy(
            CoreMigration::class,
            function (MockInterface $mock) {
                $mock->shouldNotReceive('filename');
                $mock->shouldNotReceive('package');
            }
        );
        $handler = new LogPackageMigration();

        // Act
        $handler->handle(new MigrationEnded(
            $migration,
            'down'
        ));

        // Assert
    }

    /**
     * @test
     */
    public function ensures_that_it_will_handle_framework_migrations_when_remove_changes_works_with_the_logging_table()
    {
        // Arrange
        /**
         * @var FrameworkMigration
         */
        $loggedMigration = FrameworkMigration::factory()
            ->create();

        $migration = $this->spy(
            CoreMigration::class,
            function (MockInterface $mock) use ($loggedMigration) {
                $mock->shouldReceive('filename')
                    ->andReturn($loggedMigration->migration);
                $mock->shouldReceive('package')
                    ->andReturn($loggedMigration->module_name);
            }
        );
        $handler = new LogPackageMigration();

        // Act
        $handler->handle(new MigrationEnded(
            $migration,
            'down'
        ));

        // Assert
        $this->assertSoftDeleted($loggedMigration);
    }
}
