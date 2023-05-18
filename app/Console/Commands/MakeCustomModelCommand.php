<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeCustomModelCommand extends ModelMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class and repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();

        if ($this->option('repository')) {
            $repositoryName = str_replace('App\\Models', '', $this->argument('name')) . 'Repository';
            
            $this->call('make:repository', [
                'name' => $repositoryName
            ]);
        }

        if ($this->option('filter')) {
            $filterName = str_replace('App\\Models', '', $this->argument('name')) . 'Filters';
            
            $this->call('make:filter', [
                'name' => $filterName
            ]);
        }


        if ($this->option('routes')) {
            $routesName = str_replace('App\\Models', '', $this->argument('name'));
            
            $this->call('make:routes', [
                'model' => $routesName
            ]);
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {            
            return (base_path('stubs/model.pivot.stub'));
        }

        return (base_path('stubs/model.stub'));        
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        $options = parent::getOptions();
        $options[] = ['repository', 'b', InputOption::VALUE_NONE, 'Create a new repository for the model'];
        $options[] = ['filter', 'd', InputOption::VALUE_NONE, 'Create a new filter for the model'];
        $options[] = ['routes', 'e', InputOption::VALUE_NONE, 'Create new roues for the model'];
        return $options;
    }

}
