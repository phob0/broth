<?php


namespace Phobo\Broth\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class DemoMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broth:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new broth module';

    protected $demos = [
        'User',
        'Setting'
    ];

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
        foreach($this->demos as $demo) {
            $this->call('broth:demoController', [
                'name' => $demo.'Controller'
            ]);
            if($demo === 'Setting') {
                $this->call('broth:demoModel', [
                    'name' => $demo
                ]);
            }
            $this->call('broth:demoPolicy', [
                'name' => $demo.'Policy'
            ]);
            $this->call('broth:demoRepository', [
                'name' => $demo.'Repository'
            ]);
            $this->call('broth:demoResource', [
                'name' => $demo.'Resource'
            ]);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
