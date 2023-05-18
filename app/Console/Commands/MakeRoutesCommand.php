<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRoutesCommand extends Command
{
    protected $signature = 'make:routes {model}';

    protected $description = 'Generate routes for a model';

    public function handle()
    {
        $modelName = $this->argument('model');
        $controllerName = "{$modelName}Controller";
        $modelNameLowercase = strtolower($modelName);        
        
        $apiFileContents = File::get(base_path('routes/api.php'));
        $newApiFileContents = str_replace('// {{ routesPlaceholder }}', <<<EOT
        Route::controller({$controllerName}::class)->group(function () {
            Route::prefix('/{$modelNameLowercase}s')->group(function () {
                Route::get('/index', 'index')->name('get-{$modelNameLowercase}s');
                Route::get('/show/{id}', 'show')->name('get-$modelNameLowercase');
                Route::post('/create', 'create')->name('create-$modelNameLowercase');
                Route::put('/update/{id}', 'update')->name('update-$modelNameLowercase');
                Route::delete('/delete/{id}', 'delete')->name('delete-$modelNameLowercase');
                Route::post('/filter', 'filter')->name('filter-{$modelNameLowercase}s');
            });
        });


        // {{ routesPlaceholder }}
        EOT
        , $apiFileContents);

        File::put(base_path('routes/api.php'), $newApiFileContents);

        $fileContents = File::get(base_path('routes/api.php'));
        $controllerImportPlaceholder = '// {{ controllerImportPlaceholder }}';
        $fileContents = str_replace($controllerImportPlaceholder, 
                                    'use App\Http\Controllers\API\\' . $controllerName . ';' . "\n// {{ controllerImportPlaceholder }}",
                                    $fileContents);

        // file_put_contents('routes/api.php', $fileContents);



        File::put(base_path('routes/api.php'), $fileContents);

        $this->info('Routes created successfully.');
    }
}
