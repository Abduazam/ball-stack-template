<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteImportFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:import-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears import files from the storage.';

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
