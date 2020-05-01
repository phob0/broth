<?php


namespace Phobo\TestPublish\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModuleMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broth:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new broth module';

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
        $name = $this->argument('name');

        $this->call('broth:model', [
            'name' => $name
        ]);
        $this->call('broth:resource', [
            'name' => $name.'Resource'
        ]);
        $this->call('broth:repository', [
            'name' => $name.'Repository', '--class-name' => $name
        ]);
        $this->call('broth:controller', [
            'name' => $name.'Controller', '--class-name' => $name
        ]);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['class-name', null, InputOption::VALUE_OPTIONAL, 'Name of the classes'],
        ];
    }
}
