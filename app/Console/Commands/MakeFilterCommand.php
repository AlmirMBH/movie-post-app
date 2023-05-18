<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeFilterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new filter class';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $stub = file_get_contents(base_path('stubs/filters.stub'));
        $className = $this->argument('name');
        $namespace = 'App\Filters';
        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $className],
            $stub
        );
        file_put_contents(app_path("Filters/{$className}.php"), $content);
        $this->info("Filter {$className} created successfully.");
    }
}
