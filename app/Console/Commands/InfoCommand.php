<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'System info';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('CMS system');
        $this->info('Current version: 1.0');
    }
}
