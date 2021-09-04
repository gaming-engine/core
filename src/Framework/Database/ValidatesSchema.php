<?php

namespace GamingEngine\Core\Framework\Database;

interface ValidatesSchema
{
    public function hasTable(string $table): bool;
}
