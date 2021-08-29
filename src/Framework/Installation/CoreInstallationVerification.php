<?php

namespace GamingEngine\Core\Framework\Installation;

use GamingEngine\Core\Framework\Database\DatabaseSchema;
use GamingEngine\Core\Framework\Entities\FrameworkModule;
use Illuminate\Database\QueryException;

class CoreInstallationVerification implements InstallationVerification
{
    private DatabaseSchema $schema;

    public function __construct(DatabaseSchema $schema)
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
