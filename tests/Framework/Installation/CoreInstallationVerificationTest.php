<?php

namespace GamingEngine\Core\Tests\Framework\Installation;

use GamingEngine\Core\Framework\Database\ValidatesSchema;
use GamingEngine\Core\Framework\Installation\CoreInstallationVerification;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Database\QueryException;

class CoreInstallationVerificationTest extends TestCase
{
    /**
     * @test
     */
    public function returns_false_when_the_database_doesnt_exist()
    {
        // Arrange
        $schema = $this->mock(ValidatesSchema::class);
        $schema->shouldReceive('hasTable')
            ->andThrow($this->mock(QueryException::class));
        $verification = new CoreInstallationVerification($schema);

        // Act
        $result = $verification->installed();

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function returns_false_when_the_core_table_doesnt_exist()
    {
        // Arrange
        $schema = $this->mock(ValidatesSchema::class);
        $schema->shouldReceive('hasTable')
            ->andReturn(false);
        $verification = new CoreInstallationVerification($schema);

        // Act
        $result = $verification->installed();

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function returns_true_when_the_core_table_exists()
    {
        // Arrange
        $schema = $this->mock(ValidatesSchema::class);
        $schema->shouldReceive('hasTable')
            ->andReturn(true);
        $verification = new CoreInstallationVerification($schema);

        // Act
        $result = $verification->installed();

        // Assert
        $this->assertTrue($result);
    }
}
