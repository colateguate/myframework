<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class FactoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // El método app_path sobreentiende que estamos dentro de app, como no es así editamos el path con str_replace
        $domainPath = str_replace("/app/", "/", app_path('my_framework/Infrastructure')); // actualiza a la ruta correcta

        $contextFolders = File::directories($domainPath);

        foreach ($contextFolders as $folder) {
            // obtén el nombre base del directorio para formar el nombre del contexto
            $contextName = pathinfo($folder, PATHINFO_FILENAME);

            // obtén todos los archivos en el directorio
            $files = File::files($folder);

            foreach ($files as $file) {
                // obtén el nombre base del archivo (sin la extensión .php)
                $baseName = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                // ----- FACTORIES MAPPING --------
                if (strpos($baseName, "Factory") !== false) {
                    $factory_interface = "my_framework\Domain\Factory";
                    $factory_implementation = "my_framework\Infrastructure\\$contextName\\$baseName";
                    $this->app->bind($factory_interface, $factory_implementation);
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