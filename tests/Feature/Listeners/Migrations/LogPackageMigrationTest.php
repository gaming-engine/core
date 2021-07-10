<?php

namespace GamingEngine\Core\Tests\Feature\Listeners\Migrations;

use GamingEngine\Core\Listeners\Migrations\LogPackageMigration;
use GamingEngine\Core\Migrations\CoreMigration;
use GamingEngine\Core\Migrations\IGamingEngineMigration;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Mockery\MockInterface;

class LogPackageMigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function ensures_that_it_will_only_handle_framework_migrations()
    {
        // Arrange
        DB::spy()
            ->shouldNotReceive('table');

        $migration = $this->spy(
            Migration::class,
            function(MockInterface $mock) {
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
    }

    /**
     * @test
     */
    public function ensures_that_it_will_handle_framework_migrations_when_applying_changes()
    {
        // Arrange
        $mock = DB::spy();
        $mock->shouldReceive('table')
            ->andReturnSelf();
        $mock->shouldReceive('insert')
            ->with([
                'migration' => 'foo',
                'package_name' => 'bar',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $migration = $this->spy(
            CoreMigration::class,
            function(MockInterface $mock) {
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
    }

    /**
     * @test
     */
    public function ensures_that_it_will_handle_framework_migrations_when_remove_changes_works_without_the_logging_table()
    {
        // Arrange
        $mock = DB::spy();

        $mock->shouldReceive('connection', 'getSchemaBuilder')
            ->andReturnSelf();

        $mock->shouldReceive('hasTable')
            ->with('core_migrations')
            ->andReturn(false);

        $migration = $this->spy(
            CoreMigration::class,
            function(MockInterface $mock) {
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
        $mock = DB::spy();

        $mock->shouldReceive('connection', 'getSchemaBuilder')
            ->andReturnSelf();

        $mock->shouldReceive('table')
            ->andReturnSelf();
        $mock->shouldReceive('where')
            ->with([
                'migration' => 'foo',
                'package_name' => 'bar',
            ])->andReturnSelf();
        $mock->shouldReceive('update')
            ->with([
                'deleted_at' => now(),
            ]);

        $mock->shouldReceive('hasTable')
            ->with('core_migrations')
            ->andReturn(true);

        $migration = $this->spy(
            CoreMigration::class,
            function(MockInterface $mock) {
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
            'down'
        ));

        // Assert
    }
}
