<?php

namespace App\Console\Commands\CleanCommands;

use App\Contracts\Enums\Immutables\Locale\LanguageEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanLang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:lang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command removes un-default locales from lang directory';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $path = base_path('lang');
        $keep = LanguageEnum::toArray();

        $directories = array_filter(glob($path . '/*'), 'is_dir');
        $dirNames = array_map('basename', $directories);

        $dirsToDelete = array_diff($dirNames, $keep);

        foreach ($dirsToDelete as $dirName) {
            $dirPath = $path . '/' . $dirName;

            File::deleteDirectory($dirPath);

            $this->info("Removed directory: $dirName");
        }

        $this->info('Cleanup completed.');
    }
}
