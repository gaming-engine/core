<?php

namespace GamingEngine\Core\Framework\Environment;

interface Environment
{
    public function name(): string;

    public function debug(): bool;

    public function cache(): bool;
}
