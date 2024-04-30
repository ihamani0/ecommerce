<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeTraitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name :  The name of the trait}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' Create a new Trait';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $TaritPath = app_path("Traits/{$name}.php");

        if(file_exists($TaritPath)){
            $this->error('Interface already exists!');
            return;
        }

        // now let move to create the content of file 
        //<?php
        // namespace app/Contract
        //intrface nameIntreface{}

        $content = "<?php\n\nnamespace App\Traits;\n\n trait {$name}{\n    // Define your trait methods here\n}\n";


        //put the content in the file and put it in path
        file_put_contents($TaritPath, $content);

        //message successued
        $this->info("Trait [{$TaritPath}] created successfully!");

    }
}
