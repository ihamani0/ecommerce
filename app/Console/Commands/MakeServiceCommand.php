<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name :  The name of the service} ';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service pattren';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filesystem = new Filesystem();

        $name = $this->argument('name');


        // Create the directory structure
        $pathParts = explode('/', $name);

        (count($pathParts) == 1) ? $nameClass = $pathParts[0] :  $nameClass = $pathParts[1];


        //dd($pathParts[1]);  //"VendorProfile" // app\Console\Commands\MakeServiceCommand.php:39

        $directoryPath = app_path('Services/' . implode('/', array_slice($pathParts, 0, -1)));





        if(!$filesystem->isDirectory(app_path('Services/'))){
            $filesystem->makeDirectory(app_path('Services/'), 0755, true);
        }

        if (!$filesystem->isDirectory($directoryPath)) {
            $filesystem->makeDirectory($directoryPath, 0755, true);
        }



        //$interfacePath = "app/Contracts/.$name.php";
        $servicePath = $directoryPath . "/{$nameClass}Service.php";


        //if file exists return null
        if (file_exists($servicePath)) {
            $this->error('service already exists!');
            return;
        }


        // now let move to create the content of file
        //<?php
        // namespace app/Contract
        //intrface nameIntreface{}

        $content = "<?php\n\nnamespace App\Services;\n\nclass {$nameClass}Service{\n    // Define your service methods here\n}\n";


        //put the content in the file and put it in path
        file_put_contents($servicePath, $content);

        //message successued
        $this->info("service [{$servicePath}] created successfully!");
    }
}
