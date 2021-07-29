<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Migrations;

use GamingEngine\Core\Framework\Module\CoreModule;
use GamingEngine\Core\Tests\TestCase;

class MigrationBaseClassTest extends TestCase
{
    /**
     * @test
     */
    public function ensures_that_the_correct_package_name_is_provided()
    {
        // Arrange
        $migration = new DummyMigration();

        // Act

        // Assert
        $this->assertEquals(
            CoreModule::PACKAGE,
            $migration->package()
        );
    }

    /**
     * @test
     */
    public function ensures_that_it_is_able_to_determine_the_file_name_correctly()
    {
        // Arrange
        $migration = new DummyMigration();

        // Act

        // Assert
        $this->assertEquals(
            'DummyMigration',
            $migration->filename()
        );
    }
}
