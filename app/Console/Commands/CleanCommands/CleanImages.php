<?php

namespace App\Console\Commands\CleanCommands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will clean up storage folder from images.';

    /**
     * Execute the console command.
     */
    public function handle(): bool
    {
        $this->removeImages('public');

        $this->info('All images have been removed from the public folder.');

        return true;
    }

    /**
     * Recursively remove images from a directory.
     *
     * @param string $disk
     * @return void
     */
    protected function removeImages(string $disk): void
    {
        $files = Storage::disk($disk)->allFiles();

        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'])) {
                Storage::disk($disk)->delete($file);
            }
        }
    }
}
