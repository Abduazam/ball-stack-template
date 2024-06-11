<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLivewireTempFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:livewire-temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear livewire\'s temp files from storage.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $path = storage_path('app/livewire-tmp');

        if (File::exists($path)) {
            File::cleanDirectory($path);

            $this->info('Livewire temp files deleted successfully.');
        } else {
            $this->info('Livewire temp directory does not exist.');
        }
    }
}
