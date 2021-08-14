<?php

namespace GamingEngine\Core\Framework\Database;

interface DatabaseSchema
{
    public function hasTable(string $table): bool;
}
