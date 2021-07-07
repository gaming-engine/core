<?php

namespace GamingEngine\Core\Commands;

use Illuminate\Console\Command;

class CoreCommand extends Command
{
    public $signature = 'core';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
