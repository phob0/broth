<?php

namespace Phobo\Broth\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class DemoControllerMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'broth:demoController';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new broth controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $controllerClass;

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $model;

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire(){
        $this->setControllerClass();

        $path = $this->getPath($this->controllerClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->controllerClass));

        $this->info($this->type.' created successfully.');

        $this->line("<info>Created Controller :</info> $this->controllerClass");
    }

    /**
     * Set repository class name
     *
     * @return  void
     */
    private function setControllerClass()
    {
        $name = ucwords(strtolower($this->argument('name')));

        $this->model = $name;

        $modelClass = $this->parseName($name);

        $this->controllerClass = $modelClass . 'Controller';

        return $this;
    }

    /**
     *
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  $this->argument('name') === 'UserController' ? $this->resolveStubPath('/stubs/demo/userControllerDemo.stub') : $this->resolveStubPath('/stubs/demo/settingControllerDemo.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
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
