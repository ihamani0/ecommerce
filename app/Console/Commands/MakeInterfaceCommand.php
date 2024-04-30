<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
         $name = $this->argument('name');

         //make path for new intrface in app folder 

         //$interfacePath = "app/Contracts/.$name.php";
         $interfacePath = app_path("Contracts/{$name}.php");

         //if file exists return null 
         if (file_exists($interfacePath)) {
            $this->error('Interface already exists!');
            return;
        }


        // now let move to create the content of file 
        //<?php
        // namespace app/Contract
        //intrface nameIntreface{}

        $content = "<?php\n\nnamespace App\Contracts;\n\ninterface {$name}{\n    // Define your interface methods here\n}\n";


        //put the content in the file and put it in path
        file_put_contents($interfacePath, $content);

        //message successued
        $this->info("Interface [{$interfacePath}] created successfully!");

    }


}
