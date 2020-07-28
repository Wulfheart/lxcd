<?php

namespace Wulfheart\Lxcd\Commands;

use Illuminate\Console\Command;

class LxcdCommand extends Command
{
    public $signature = 'lxcd';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
