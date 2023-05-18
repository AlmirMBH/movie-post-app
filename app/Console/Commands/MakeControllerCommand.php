<?php

namespace App\Console\Commands;
use Illuminate\Routing\Console\ControllerMakeCommand;


class MakeControllerCommand extends ControllerMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('stubs/controller.plain.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers\Api';
    }

    /**
     * Get the repository class name.
     *
     * @return string
     */
    protected function getModelName()
    {
        $modelName = str_replace('Controller', '', $this->argument('name'));
        return $modelName;
    }


    /**
     * Get the repository class name.
     *
     * @return string
     */
    protected function getRepositoryClassName()
    {
        $modelName = str_replace('Controller', '', $this->argument('name'));
        return $modelName.'Repository';
    }

    /**
     * Get the repository object name.
     *
     * @return string
     */
    protected function getRepositoryObject()
    {
        $repositoryClassName = $this->getRepositoryClassName();
        return '$'.lcfirst($repositoryClassName);
    }

    /**
     * Get the repository variable name.
     *
     * @return string
     */
    protected function getRepository()
    {
        $repositoryClassName = $this->getRepositoryClassName();
        return lcfirst($repositoryClassName);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $stub = str_replace('{{ repositoryClassName }}', $this->getRepositoryClassName(), $stub);
        $stub = str_replace('{{ rootControllerNameSpace }}', 'App\Http\Controllers\Controller', $stub);
        $stub = str_replace('{{ repositoryObject }}', $this->getRepositoryObject(), $stub);
        $stub = str_replace('{{ repository }}', $this->getRepository(), $stub);
        $stub = str_replace('{{ modelName }}', $this->getModelName(), $stub);        

        return $stub;
    }
}
