<?php

namespace App\Jobs\Import;

use App\Contracts\Interfaces\Import\Importable;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportExcelJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Importable $import,
        protected string $filepath
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->import->import($this->filepath);
    }
}
