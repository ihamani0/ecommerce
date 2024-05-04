<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeInterfaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name :  The name of the interface} ';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filesystem = new Filesystem();

        $name = $this->argument('name');

        //split the file from name file using expload
        // Create the directory structure
        $pathParts = explode('/', $name);



        (count($pathParts) == 1) ? $nameClassIntrface = $pathParts[0] :  $nameClassIntrface = $pathParts[1];


        $directoryPath = app_path('Contracts/' . implode('/', array_slice($pathParts, 0, -1)));


        if (!$filesystem->isDirectory(app_path('Contracts/'))) {
            $filesystem->makeDirectory(app_path('Contracts/'), 0755, true);
        }

        if (!$filesystem->isDirectory($directoryPath)) {
            $filesystem->makeDirectory($directoryPath, 0755, true);
        }



        $interfacePath = $directoryPath . "/{$nameClassIntrface}Interface.php";


        //if file exists return null 
        if (file_exists($interfacePath)) {
            $this->error('Interface already exists!');
            return;
        }


        // now let move to create the content of file 
        //<?php
        // namespace app/Contract
        //intrface nameIntreface{}




        $content = "<?php\n\nnamespace App\Contracts;\n\ninterface {$nameClassIntrface}Interface{\n    // Define your interface methods here\n}\n";


        //put the content in the file and put it in path
        file_put_contents($interfacePath, $content);

        //message successued
        $this->info("Interface [{$interfacePath}] created successfully!");
    }
}
