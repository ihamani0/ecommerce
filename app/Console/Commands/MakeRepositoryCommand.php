<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name :  The name of the repository} ';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

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



        (count($pathParts) == 1) ? $nameClass = $pathParts[0] :  $nameClass = $pathParts[1];


        $directoryPath = app_path('Repositories/' . implode('/', array_slice($pathParts, 0, -1)));


        if (!$filesystem->isDirectory(app_path('Repositories/'))) {
            $filesystem->makeDirectory(app_path('Repositories/'), 0755, true);
        }

        if (!$filesystem->isDirectory($directoryPath)) {
            $filesystem->makeDirectory($directoryPath, 0755, true);
        }



        $classPath = $directoryPath . "/{$nameClass}Repo.php";


        //if file exists return null
        if (file_exists($classPath)) {
            $this->error('class already exists!');
            return;
        }


        // now let move to create the content of file
        //<?php
        // namespace app/Contract
        //intrface nameIntreface{}




        $content = "<?php\n\nnamespace App\Repositories;\n\nclass {$nameClass}Repo{\n    // Define your class methods here\n}\n";


        //put the content in the file and put it in path
        file_put_contents($classPath, $content);

        //message successued
        $this->info("repository [{$classPath}] created successfully!");
    }
}
