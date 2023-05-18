<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $stub = file_get_contents(base_path('stubs/repository.stub'));
        $className = str_replace('Repository', '', $this->argument('name'));
        $namespace = 'App\Repositories';
        $content = str_replace(
            ['{{ namespace }}', '{{ class }}', '{{ className }}'],
            [$namespace, $this->argument('name'), $className],
            $stub
        );
        file_put_contents(app_path("Repositories/{$this->argument('name')}.php"), $content);
        $this->info("Repository {$this->argument('name')} created successfully.");
    }
}
