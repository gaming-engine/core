<?php

namespace GamingEngine\Core\Framework\Database;

use Illuminate\Support\Facades\Schema as SchemaFacade;

class Schema implements ValidatesSchema
{
    public function hasTable(string $table): bool
    {
        return SchemaFacade::hasTable($table);
    }
}
