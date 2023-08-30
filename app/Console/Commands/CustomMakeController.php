<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class CustomMakeController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:custom-controller {name} {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller at a custom location';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //EXAMPLE: php artisan make:custom-controller MiNuevoController MiCarpeta

        $name = $this->argument('name');
        $folder = $this->argument('folder');

        // Ejecutar el comando original para crear el controlador
        $this->call('make:controller', ['name' => $name]);

        // Crear el directorio si no existe
        if (!File::exists(base_path("my_framework/Application/$folder/controllers"))) {
            File::makeDirectory(base_path("my_framework/Application/$folder/controllers"), 0755, true);
        }

        $sourcePath = base_path("app/Http/Controllers/$name.php");
        $destinationPath = base_path("my_framework/Application/$folder/controllers/$name.php");

        if (File::exists($sourcePath)) {
            File::move($sourcePath, $destinationPath);
        } else {
            $this->error("El archivo fuente no existe: $sourcePath");
        }

    }
}