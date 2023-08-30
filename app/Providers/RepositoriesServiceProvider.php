<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // El método app_path sobreentiende que estamos dentro de app, como no es así editamos el path con str_replace
        $domainPath = str_replace("/app/", "/", app_path('my_framework/Domain')); // actualiza a la ruta correcta

        $contextFolders = File::directories($domainPath);

        foreach ($contextFolders as $folder) {
            // obtén el nombre base del directorio para formar el nombre del contexto
            $contextName = pathinfo($folder, PATHINFO_FILENAME);

            // obtén todos los archivos en el directorio
            $files = File::files($folder);

            foreach ($files as $file) {
                // obtén el nombre base del archivo (sin la extensión .php)
                $baseName = pathinfo($file->getFilename(), PATHINFO_FILENAME);

                // ----- REPOSITORIES MAPPING --------
                if (strpos($baseName, "Repository") !== false) {
                    // forma los nombres completos de las clases de la interfaz y la implementación
                    $repo_interface = "my_framework\Domain\\$contextName\\$baseName";
                    $repo_implementation = "my_framework\Infrastructure\\$contextName\\{$baseName}Mysql";
                    // registra la implementación en el contenedor de servicios
                    $this->app->bind($repo_interface, $repo_implementation);
                }
            }
        }
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}