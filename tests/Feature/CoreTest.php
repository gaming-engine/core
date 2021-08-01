<?php

namespace GamingEngine\Core\Tests\Feature;

use GamingEngine\Core\Core;
use GamingEngine\Core\Framework\Installation\CoreInstallationVerification;
use GamingEngine\Core\Framework\Models\FrameworkModule;
use GamingEngine\Core\Framework\Module\Module;
use GamingEngine\Core\Framework\Module\ModuleCollection;
use GamingEngine\Core\Tests\TestCase;

class CoreTest extends TestCase
{
    /**
     * @test
     */
    public function ensures_that_no_modules_are_added_if_the_framework_is_not_installed()
    {
        // Arrange
        $moduleCollection = $this->mock(ModuleCollection::class);
        $verification = $this->mock(CoreInstallationVerification::class);
        $verification->shouldReceive('installed')
            ->andReturn(false);

        $core = new Core($moduleCollection, $verification);

        // Act
        $core->registerPackage($this->mock(Module::class));

        // Assert
        $moduleCollection->shouldNotHaveReceived('addModule');
    }

    /**
     * @test
     */
    public function is_able_to_determine_if_a_module_is_installed()
    {
        // Arrange
        $moduleCollection = $this->mock(ModuleCollection::class);
        $moduleCollection->shouldReceive('hasModule')
            ->andReturn(true);
        $verification = $this->mock(CoreInstallationVerification::class);
        $verification->shouldReceive('installed')
            ->andReturn(true);

        $core = new Core($moduleCollection, $verification);

        // Act
        $result = $core->hasRegisteredPackage($this->mock(Module::class));

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function you_are_able_to_include_modules_that_were_already_registered()
    {
        // Arrange
        $frameworkModule = FrameworkModule::factory()->create();

        $verification = $this->mock(CoreInstallationVerification::class);
        $verification->shouldReceive('installed')
            ->andReturn(true);

        $module = $this->mock(Module::class);
        $module->shouldReceive('name')
            ->andReturn($frameworkModule->module_name);
        $module->shouldReceive('version')
            ->andReturn('x.x.x');
        $module->shouldReceive('setLicense', [$frameworkModule->license_key]);

        $moduleCollection = $this->mock(ModuleCollection::class);
        $moduleCollection->shouldReceive('addModule')
            ->andReturnTrue();
        $core = new Core($moduleCollection, $verification);

        // Act
        $core->registerPackage($module);

        // Assert
    }
}
