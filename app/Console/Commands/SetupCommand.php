<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rule;
use App\User;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup CMS system';

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
     * Установка дефолтной темы
     *
     * @return bool
     */
    private function setDefaultTheme() : bool
    {
        return true;
    }

    /**
     * @return int|null идентификатор созданной роли
     */
    private function createMainRule()
    {
        $ruleData = [];
        $this->info('Create main rule, this rule will be have access for all modules');

        $ruleData['title']          = $this->ask('Create title');
        $ruleData['description']    = $this->ask('Create description');

        $rule = Rule::create($ruleData);

        return $rule ? $rule->id : null;
    }

    /**
     * Создание главного администратора со всеми правами
     *
     * @param int $id_rule
     * @return User|null
     */
    private function createMainAdministrator($id_rule)
    {
        $userData = [];

        $userData['name']       = $this->ask('Create name (show for users)');
        $userData['login']      = $this->ask('Create login');
        $userData['email']      = $this->ask('Input your email');
        $userData['password']   = $this->secret('Create password (hidden)');
        $userData['status']     = User::STATUS_ACTIVE;
        $userData['id_rule']    = $id_rule;

        return User::createUser($userData);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Setup CMS');
        $this->call('migrate');

        if(!$rule = $this->createMainRule())
        {
            $this->error('Can\'t create the rule');
            return;
        }
        $this->info('Created the rule');

        if(!$user = $this->createMainAdministrator($rule))
        {
            $this->error('Can\'t create the user');
            return;
        }
        $this->info('Created user');

        if(!$this->setDefaultTheme())
        {
            $this->error('Can\'t set default theme');
            return;
        }
        $this->info('Set default theme');

        $this->info('System created');
    }
}
