<?php

namespace App\Console\Commands\CleanCommands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanImportFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:import-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will clean up import files from the storage.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $path = storage_path('app/imports');

        if (File::exists($path)) {
            File::cleanDirectory($path);

            $this->info('Import files deleted successfully.');
        } else {
            $this->info('Import temp directory does not exist.');
        }
    }
}
