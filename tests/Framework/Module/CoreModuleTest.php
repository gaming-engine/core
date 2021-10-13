<?php

namespace GamingEngine\Core\Tests\Framework\Module;

use GamingEngine\Core\Framework\Events\License\LicenseAdded;
use GamingEngine\Core\Framework\Events\License\LicenseRemoved;
use GamingEngine\Core\Framework\Module\CoreModule;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;

class CoreModuleTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function ensures_you_are_able_to_set_the_license()
    {
        // Arrange
        Event::fake();
        $module = new CoreModule();
        $license = $this->faker->uuid();

        // Act
        $module->setLicense($license);

        // Assert
        $this->assertEquals($license, $module->license());
    }

    /**
     * @test
     */
    public function ensures_when_a_license_is_added_the_LicenseAdded_event_is_triggered()
    {
        // Arrange
        Event::fake();
        $module = new CoreModule();
        $license = $this->faker->uuid();

        // Act
        $module->setLicense($license);

        // Assert
        Event::assertDispatched(LicenseAdded::class);
    }

    /**
     * @test
     */
    public function ensures_when_a_license_is_removed_the_LicenseRemoved_is_triggered()
    {
        // Arrange
        $module = new CoreModule();
        $license = $this->faker->uuid();
        $module->setLicense($license);
        Event::fake();

        // Act
        $module->removeLicense();

        // Assert
        Event::assertDispatched(LicenseRemoved::class);
        $this->assertNull($module->license());
    }

    /**
     * @test
     */
    public function ensures_when_a_license_was_not_present_the_LicenseRemoved_is_not_triggered()
    {
        // Arrange
        $module = new CoreModule();
        Event::fake();

        // Act
        $module->removeLicense();

        // Assert
        Event::assertNotDispatched(LicenseRemoved::class);
    }

    /**
     * @test
     */
    public function ensures_that_the_module_provides_the_correct_name()
    {
        // Arrange
        $module = new CoreModule();

        // Act

        // Assert
        $this->assertEquals(
            CoreModule::PACKAGE,
            $module->name()
        );
    }

    /**
     * @test
     */
    public function ensures_that_the_module_provides_the_correct_version()
    {
        // Arrange
        $module = new CoreModule();

        // Act

        // Assert
        $this->assertEquals(
            CoreModule::VERSION,
            $module->version()
        );
    }
}
