<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Database;

use GamingEngine\Core\Framework\Database\Schema;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Facades\DB;

class SchemaTest extends TestCase
{
    /**
     * @test
     */
    public function schema_test_delegates_to_the_laravel_facade()
    {
        // Arrange
        DB::shouldReceive('connection')
            ->andReturnSelf();

        DB::shouldReceive('getSchemaBuilder')
            ->andReturnSelf();

        DB::shouldReceive('hasTable')
            ->andReturn(true);

        $schema = new Schema();

        // Act
        $response = $schema->hasTable('foo');

        // Assert
        $this->assertTrue($response);
    }
}
