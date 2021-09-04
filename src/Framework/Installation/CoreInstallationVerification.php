<?php

namespace GamingEngine\Core\Framework\Installation;

use GamingEngine\Core\Framework\Database\ValidatesSchema;
use GamingEngine\Core\Framework\Entities\FrameworkModule;
use Illuminate\Database\QueryException;

class CoreInstallationVerification implements InstallationVerification
{
    private ValidatesSchema $schema;

    public function __construct(ValidatesSchema $schema)
    {
        $this->schema = $schema;
    }

    public function installed(): bool
    {
        try {
            return $this->schema->hasTable((new FrameworkModule())->getTable());
        } catch (QueryException $exception) {
            return false;
        }
    }
}
