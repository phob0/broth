<?php

namespace Phobo\Broth\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class DemoPolicyMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'broth:demoPolicy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new broth resource';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Policy';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $resourceClass;

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

        $this->setResourceClass();

        $path = $this->getPath($this->resourceClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->resourceClass));

        $this->info($this->type.' created successfully.');

        $this->line("<info>Created Resource :</info> $this->resourceClass");
    }

    /**
     * Set repository class name
     *
     * @return  void
     */
    private function setResourceClass()
    {
        $name = ucwords(strtolower($this->argument('name')));

        $this->model = $name;

        $resourceClass = $this->parseName($name);

        $this->resourceClass = $resourceClass;

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
        return  $this->argument('name') === 'User' ? $this->resolveStubPath('/stubs/demo/userPolicyDemo.stub') : $this->resolveStubPath('/stubs/demo/settingPolicyDemo.stub');
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
        return $rootNamespace.'\Policies';
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

}
