<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class CustomMakeModel extends Command
{
    protected $signature = 'make:custom-model {name}';
    protected $description = 'Create a new Eloquent model at a custom location';

    public function handle()
    {
        $name = $this->argument('name');

        // Verifica si el path existe, crea uno si no es así
        if (!File::exists(base_path("my_framework/Domain"))) {
            File::makeDirectory(base_path("my_framework/Domain"), 0755, true);
        }

        // Ejecuta el comando Artisan original
        $this->call('make:model', ['name' => $name]);

        // Mueve y modifica el archivo
        $sourcePath = base_path("app/Models/$name.php");
        $destinationPath = base_path("my_framework/Domain/$name.php");

        $originalContent = File::get($sourcePath);

        // Reemplaza el namespace y añade cualquier uso necesario
        $newNamespace = "my_framework\\Domain";
        $replacedContent = str_replace('namespace App\\Models;', "namespace $newNamespace;", $originalContent);

        File::put($destinationPath, $replacedContent);

        // Elimina el archivo original
        File::delete($sourcePath);
    }
}
