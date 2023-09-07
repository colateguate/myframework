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

        //Check if path exists, create if not.
        if (!File::exists(base_path("backend/Application/$folder/controllers"))) {
            File::makeDirectory(base_path("backend/Application/$folder/controllers"), 0755, true);
        }

        // Execute orginal artisan command
        $this->call('make:controller', ['name' => $name]);

        $sourcePath = base_path("app/Http/Controllers/$name.php");
        $destinationPath = base_path("backend/Application/$folder/controllers/$name.php");

        $originalContent = File::get(base_path("app/Http/Controllers/$name.php"));

        // Reemplazar el namespace y añadir use
        $newNamespace = "backend\\Application\\$folder\\controllers";
        $replacedContent = str_replace('namespace App\\Http\\Controllers;', "namespace $newNamespace;\n\nuse App\\Http\\Controllers\\Controller;", $originalContent);

        File::put("backend/Application/$folder/controllers/$name.php", $replacedContent);

        // Eliminar el archivo original
        File::delete(base_path("app/Http/Controllers/$name.php"));
    }
}