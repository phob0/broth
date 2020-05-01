<?php

namespace Phobo\TestPublish\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class ModelMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'broth:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new broth model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $modelClass;

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

        $this->setModelClass();

        $path = $this->getPath($this->modelClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->modelClass));

        $this->info($this->type.' created successfully.');

        $this->line("<info>Created Model :</info> $this->modelClass");
    }

    /**
     * Set repository class name
     *
     * @return  void
     */
    private function setModelClass()
    {
        $name = ucwords(strtolower($this->argument('name')));

        $this->model = $name;

        $modelClass = $this->parseName($name);

        $this->modelClass = $modelClass;

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
        return  $this->resolveStubPath('/stubs/model.stub');
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
        return $rootNamespace;
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
